<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\MediaContentSegmentModel;
use App\Models\admin\ReloadCounterModel;

class MediaContentSegment extends BaseController
{

    protected $media_segment;
    protected $counter;

    public function __construct()
    {
        $this->media_segment = new MediaContentSegmentModel;
        $this->counter = new ReloadCounterModel; 
         
    }



    /**
     *
     * create new content
     * @return array|json
     * 
     */

    public function create()
    {
        $response = array();
        //validate form data
        $validation = $this->_mediaContentSegmentFormValidation();
  
        if ($validation===true) {

            //validate and move media file
            // $imageStatus = $this->_uploadMediaFile();
            // if ($imageStatus['status']===true) {


                $inputData = $this->_mediaContentSegmentInput('new', '');
                 
                //save media data
                $status = $this->media_segment->saveMediaContentSegment($inputData);
                     

                 
                if ($status===true) {
                    $this->counter->updateCounter();
                    $response['status'] = true;
                    $response['msg'] =  'Segment created successfully.';
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
     * media content segment form validation
     * @return boolean | array
     */
    private function _mediaContentSegmentFormValidation()
    {
        $validation = service('validation');
         
        $validation->setRules([
             
            'segment_title' => [ 'label' => 'Title', 'rules' => 'required|max_length[255]'],
            'segment_number' => [ 'label' => 'Segment Number', 'rules' => 'required'],
            'resolution' => [ 'label' => 'Resolution', 'rules' => 'required|max_length[30]'],
            'release_date' => [ 'label' => 'Release Date', 'rules' => 'required'],
            'duration' => [ 'label' => 'Duration', 'rules' => 'required'],
            'language' => [ 'label' => 'Language', 'rules' => 'required'],
            'description' => [ 'label' => 'Description', 'rules' => 'permit_empty'],
            'media_video' => [ 'label' => 'Video Link', 'rules' => 'required|valid_url'],
            'cover_image_link' => [ 'label' => 'Cover Image', 'rules' => 'permit_empty|valid_url'],
            'vertical_video' => [ 'label' => 'Vertical Video', 'rules' => 'required|in_list[0,1]'],
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
     * validate and upload media file 
     * @return array
     * 
     */
    
    private function _uploadMediaFile(){
         // Set validation rules for the file upload
        $validationRules = [
            'media_video' => [
                'rules' => 'uploaded[media_video]|max_size[media_video,102400]|mime_in[media_video,video/mp4,video/mpeg,video/ogg]',
                'errors' => [
                    'uploaded' => 'You must select a video to upload.',
                    'is_video' => 'The uploaded file must be a valid video.',
                    'max_size' => 'The video size cannot exceed 100MB.',
                    'mime_in' => 'Only MP4, MPEG, and OGG video formats are allowed.'
                ]
            ]
        ];

        // Validate the uploaded image
        if (!$this->validate($validationRules)) {
            // If validation fails, return to the form with error messages
            return ['status' => false, 'msg' => $this->validator->getErrors()];
        }

        $file = $this->request->getFile('media_video');
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
    
    private function _mediaContentSegmentInput($type, $imgUrl)
    {
        $data  = array();
        //for media content
        
        $data['segment_title'] = _clean($this->request->getPost('segment_title'));
        $data['segment_number'] = (int)$this->request->getPost('segment_number');
        $data['release_date'] = date('Y-m-d', strtotime($this->request->getPost('release_date')));
        $data['duration'] = _clean($this->request->getPost('duration'));
        $data['media_language'] = _clean($this->request->getPost('language'));
        $data['resolution'] =  _clean($this->request->getPost('resolution'));
        $data['description'] = _clean($this->request->getPost('description'));
        $data['media_url'] = _clean($this->request->getPost('media_video'));
        $data['cover_image_link'] = _clean($this->request->getPost('cover_image_link'));
        $data['vertical_video'] = (int)$this->request->getPost('vertical_video');
        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['media_content_id'] = (int)$this->request->getPost('media_content_id');
            //$data['media_url'] = $imgUrl;
        }else{
            if (!empty($imgUrl)) {
              // $data['media_url'] = $imgUrl;
            }
        }

        return $data;
    }


        /**
     * Edit segment
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = (int)$this->request->getVar('id');
            $data = $this->media_segment->getSegmentById($id);

            return $this->response->setJSON([
                'status' => $data ? true : false,
                'data' => $data
            ]);
        }
    }

    /**
     * Update segment
     */
    public function update()
    {
        if ($this->request->isAJAX()) {
            $response = array();
            $id = (int) $this->request->getPost('segment_id');
            $validation = $this->_mediaContentSegmentFormValidation();
            if ($validation===true) {

                $segment = $this->media_segment->getSegmentById($id);

                if (!$segment) {
                    return $this->response->setJSON([
                        'status' => false,
                        'msg' => 'Media segment not found.'
                    ]);
                }


                $inputData = $this->_mediaContentSegmentInput('update', '');
                $status = $this->media_segment->updateMediaContentSegment($inputData, $id);
                if ($status===true) {
                    $this->counter->updateCounter();
                    $response['status'] = true;
                    $response['msg'] =  'Segment updated successfully.';
                }else{
                    $response['status'] = false;
                    $response['msg'] =  'Oops! something went wrong.';
                }
                 
            }else{
                $response['status'] = false;
                $response['msg'] =  $validation;
            }
            return $this->response->setJSON($response);
                
        }
    }


     /**
     *
     * delete media content segment
     * @param int $id is unique media content id
     * @return redirect
     */
    public function delete($id)
    {
        $mediaId = $this->request->getGet('mediaId');
        $response = $this->media_segment->deleteMediaContentSegment($id);
        $this->counter->updateCounter();
        session()->setFlashdata($response);
        return redirect()->to('admin/media-content-details/' . $mediaId);
    }

}
