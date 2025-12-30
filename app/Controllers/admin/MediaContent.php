<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\MediaGenreModel;
use App\Models\admin\MediaCategoryModel;
use App\Models\admin\MediaContentModel;
use App\Models\admin\MediaContentSegmentModel;
use App\Models\admin\ReloadCounterModel;

class MediaContent extends BaseController
{

    protected $category;
    protected $genre;
    protected $media;
    protected $media_segment;
    protected $counter; 

    public function __construct()
    {
        $this->category = new MediaCategoryModel;
        $this->genre = new MediaGenreModel;
        $this->media = new MediaContentModel;
        $this->media_segment = new MediaContentSegmentModel;
        $this->counter = new ReloadCounterModel; 
    }


    public function index($current_page=1)
    {
        $limit = 25;
        //get params
        $get_para = '';
        
        $data['categories'] = $this->category->getMediaCategory();
        $data['genres'] = $this->genre->getMediaGenre();

        
        $total_data = $this->media->countAllMediaContent();
        $page_data = paginationLinkAndOffset($total_data, $limit, $current_page, '', $get_para); 
        $data['link'] = $page_data['link'];
        $data['mediaContents'] = $this->media->getMediaContent($limit, $page_data['offset'], ['id', 'desc']);
        $data['currentPage'] = $current_page;
        
        return view('admin/pages/media_content', $data);
    }


    /**
     *
     * media content details
     *
     */
    public function mediaContentDetails($mediaID)
    {
        $data['mediaContent'] = $this->media->mediaContentById($mediaID);
        $data['mediaContentSegments'] = $this->media_segment->mediaContentSegmentById($mediaID);
        $data['mediaID'] = $mediaID;
        return view('admin/pages/media_content_details', $data);
    }
    



    /**
     *
     * create new content
     * @return array|json
     * 
     */

    public function create()
    {
        //validate form data
        $validation = $this->_mediaContentFormValidation(null);
        $response = array();
        if ($validation===true) {

            //validate and move image file
            // $imageStatus = $this->_uploadMediaImage();
            // if ($imageStatus['status']===true) {


                $inputData = $this->_mediaContentInput('new', '');
                //connect database
                $db = \Config\Database::connect();

                $db->transStart();
                    //save media data
                    $id = $this->media->saveMediaContent($inputData);
                    if (!is_null($id)) {
                        $inputData2 = $this->_mediaContentAssocGenreInput($id);
                        $this->media->setAssociatedGenres($inputData2);

                        if ((int)$this->request->getPost('parent_media_season')>0) {
                            //link parent season
                            $this->media->setMediaParentSeason(
                                [
                                    'media_content_id' => $id, 
                                    'parent_season_id' => (int)$this->request->getPost('parent_media_season'),
                                    'created_at' => date('Y-m-d H:i:s')
                                ]
                            );
                        }
                        
                    }

                $db->transComplete();
                if ($db->transStatus()===true) {
                    $this->counter->updateCounter();
                    $response['status'] = true;
                    $response['msg'] =  'Content created successfully.';
                    $response['id'] =  $id;
                    
                }else{
                    $response['status'] = false;
                    $response['msg'] =  'Oops! something went wrong.';
                }
                
                
            // }else{
            //     //image file error
            //     $response['status'] = false;
            //     $response['msg'] =  $imageStatus['msg'];
            //     return $this->response->setJSON($response);
            // }

        }else{
             //validation error
            $response['status'] = false;
            $response['msg'] =  $validation;
        }
        return $this->response->setJSON($response);
    }


    /**
     *
     * media content form validation
     * @return boolean | array
     */
    private function _mediaContentFormValidation($id)
    {
        $validation = service('validation');
         
        $validation->setRules([
             
            'media_title' => [ 
                'label' => 'Title', 
                'rules' => 'required|max_length[255]|is_unique[media_contents.title,id,'.$id.']',
                'errors' => [
                    'is_unique' => 'The {field} is already exist.'
                ],
            ],
            'thumbnail_image_link' => [ 'label' => 'Thumbnail Image', 'rules' => 'required|valid_url'],
            'landscape_image_link' => [ 'label' => 'Landscape Image', 'rules' => 'permit_empty|valid_url'],
            'portrait_image_link' => [ 'label' => 'Portrait Image', 'rules' => 'permit_empty|valid_url'],
            'vertical_video' => [ 'label' => 'Vertical Video', 'rules' => 'required|in_list[0,1]'],
            'genre' => [ 'label' => 'Genre', 'rules' => 'required'],
            'category' => [ 'label' => 'Category', 'rules' => 'required'],
            'release_date' => [ 'label' => 'Release Date', 'rules' => 'required'],
            'duration' => [ 'label' => 'Duration', 'rules' => 'required'],
            'age_rating' => [ 'label' => 'Age Rating', 'rules' => 'required|max_length[30]'],
            'content_type' => [ 'label' => 'Content Type', 'rules' => 'required|in_list[Regular,Rent,Upcoming]'],
            'language' => [ 'label' => 'Language', 'rules' => 'required'],
            'status' => [ 'label' => 'Status', 'rules' => 'required|in_list[active,inactive]'],
            'parent_media_season' => [ 'label' => 'Parent Season', 'rules' => 'permit_empty|is_natural_no_zero'],
            'director' => [ 'label' => 'Director Name', 'rules' => 'permit_empty|alpha_dash'],
            'cast' => [ 'label' => 'Cast Name', 'rules' => 'permit_empty'],
            'cast_image' => [ 'label' => 'cast Image', 'rules' => 'permit_empty|valid_url'],
            'trailer_link' => [ 'label' => 'Trailer', 'rules' => 'permit_empty|valid_url'],
            'description' => [ 'label' => 'Description', 'rules' => 'permit_empty'],
            
            
        ]);

        if ($validation->run($this->request->getPost())) {
             //validation success
             return true;
        }else{
            //validation failed
            return $validation->getErrors();
        }
    }
    

    /**
     *
     * validate and upload image 
     * @return array
     * 
     */
    
    private function _uploadMediaImage(){
         // Set validation rules for the file upload
        $validationRules = [
            'thumbnail_image' => [
                'rules' => 'uploaded[thumbnail_image]|is_image[thumbnail_image]|max_size[thumbnail_image,2048]|mime_in[thumbnail_image,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'uploaded' => 'You must select an image to upload.',
                    'is_image' => 'The uploaded file must be an image.',
                    'max_size' => 'The image size cannot exceed 2MB.',
                    'mime_in' => 'Only JPG, JPEG, PNG, and GIF images are allowed.'
                ]
            ]
        ];

        // Validate the uploaded image
        if (!$this->validate($validationRules)) {
            // If validation fails, return to the form with error messages
            return ['status' => false, 'msg' => $this->validator->getErrors()];
        }

        $file = $this->request->getFile('thumbnail_image');
        $path = 'public/uploads/mediaFiles/';
        // Check if the file is valid
        if ($file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH  . $path, $newName);
            // Success response
            return ['status' => true, 'fileName' => base_url().$path.$newName];
        } else {
            // File error response
            return ['status' => false, 'msg' => $file->getErrorString()];
        }
    }


    /**
     *
     * input data
     * @param string $type
     * @return array
     */
    
    private function _mediaContentInput($type, $imgUrl)
    {
        $data  = array();
        //for media content
        $data['title'] = _clean($this->request->getPost('media_title'));
        $data['media_category_id'] = _clean($this->request->getPost('category'));
        $data['release_date'] = date('Y-m-d', strtotime($this->request->getPost('release_date')));
        $data['duration'] = _clean($this->request->getPost('duration'));
        $data['language'] = implode(',', $this->request->getPost('language'));
        $data['age_rating'] =  _clean($this->request->getPost('age_rating'));
        $data['content_type'] =  _clean($this->request->getPost('content_type'));
        $data['vertical_video'] =  (int)$this->request->getPost('vertical_video');
        $data['updated_at'] =  date('Y-m-d H:i:s');
        $data['status'] = _clean($this->request->getPost('status'));
        $data['description'] = _clean($this->request->getPost('description'));
        $data['thumbnail_url'] = _clean($this->request->getPost('thumbnail_image_link'));
        $data['landscape_image_url'] = _clean($this->request->getPost('landscape_image_link'));
        $data['portrait_image_url'] = _clean($this->request->getPost('portrait_image_link'));
        $data['cast_image_link'] = _clean($this->request->getPost('cast_image'));
        $data['trailer_link'] = _clean($this->request->getPost('trailer_link'));
        $data['cast'] =  _clean($this->request->getPost('cast'));
        $data['director'] =  _clean($this->request->getPost('director'));


        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
            //$data['thumbnail_url'] = $imgUrl;
        }else{
            if (!empty($imgUrl)) {
               //$data['thumbnail_url'] = $imgUrl;
            }
        }

        return $data;
    }
    


    /**
     *
     * input data
     * @param int $id
     * @return array
     */

    private function _mediaContentAssocGenreInput($id)
    {
        $data  = array();
        //for media content associated genre
        foreach ($this->request->getPost('genre') as $genId) {
            $fieldData['media_content_id'] = $id;
            $fieldData['content_genre_id'] = $genId;
            $fieldData['created_at'] = date('Y-m-d H:i:s');

            array_push($data, $fieldData);
        }
        return $data;
    }



    /**
     *
     * search media content
     *
     */

    public function searchMediaContent()
    {
        if ($this->request->isAJAX()) {
             $searchTerm = _clean($this->request->getVar('term'));
             $mediaData = array();
             $results = $this->media->searchMediaContentByName( $searchTerm );
             foreach ($results as $res) {
                 array_push($mediaData, $res->title);
             }

             return $this->response->setJSON($mediaData);
        }
    }


    /**
     *
     * get data to edit
     *
     */
    
    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = (int)$this->request->getVar('id');
            $data = $this->media->mediaContentById2($id);

            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = (int)$this->request->getPost('id');
            $response = array();
            $validation =  $this->_mediaContentFormValidation($id);
            if($validation===true){
                //get media data
                $media = $this->media->getMediaContentById($id);

                //media data error
                if (is_null($media)) {
                    return $this->response->setJSON([
                        'status' => false,
                        'msg' => 'Media content not found.'
                    ]);
                }

                $inputData = $this->_mediaContentInput('update', '');
                $status = $this->media->updateMediaContent($inputData, $id);
                if ($status===true) {
                    $this->counter->updateCounter();
                    $response['status'] = true;
                    $response['msg'] =  'Media content updated successfully.';
                }else{
                    $response['status'] = false;
                    $response['msg'] =  'Oops! something went wrong.';
                }

            }else{
                //validation error
                $response['status'] = false;
                $response['msg'] =  $validation;
            }
            return $this->response->setJSON($response);
            
        }
    }

    /**
     *
     * delete media content
     * @param int $id is unique media content id
     * @return redirect
     */
    public function delete($id)
    {
        $currentPage = $this->request->getGet('currentPage');
        $response = $this->media->deleteMediaContent($id);
        $this->counter->updateCounter();
        session()->setFlashdata($response);
        return redirect()->to('admin/media-content/' . $currentPage);
    }
    
}
