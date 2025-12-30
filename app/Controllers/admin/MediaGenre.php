<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\admin\MediaGenreModel;

class MediaGenre extends BaseController
{
    protected $genre;

    public function __construct()
    {
        $this->genre = new MediaGenreModel;
    }

    public function index()
    {   
        $data['genres'] = $this->genre->getMediaGenre();
        return view('admin/pages/media_genre', $data);
    }


    /**
     *
     * create new genre
     * @return array|json
     * 
     *
     */
    
    public function create()
    {
        $response = array();
        $validation = $this->_genreFormValidation(null);
        if ($validation===true) {

            $inputData = $this->_genreInput('new');
            $status = $this->genre->saveGenre($inputData);

            if ($status===true) {
                $response['status'] = true;
                $response['msg'] =  'Genre created successfully.';
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



    /**
     *
     * input data
     * @param string $type
     * @return array
     */
    
    private function _genreInput($type)
    {
        $data  = array();
        $data['genre_name'] = _clean($this->request->getPost('genre_name'));
        $data['description'] = _clean($this->request->getPost('description'));
        if ($type==='new') {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return $data;
    }


    /**
     *
     * genre form validation
     * @param int|null $id
     */
    private function _genreFormValidation($id)
    {
        $validation = service('validation');
         
        $validation->setRules([
            'description' => [ 'label' => 'Description', 'rules' => 'permit_empty|max_length[255]'],
            'genre_name' => [ 
                'label' => 'Genre Name', 
                'rules' => 'required|max_length[100]|is_unique[media_content_genres.genre_name,id,'.$id.']', 
                'errors' => [
                    'is_unique' => 'The {field} is already exist.'
                ],
            ],
            
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
     * edit genre 
     * @return array|json
     * 
     */
    public function edit()
    {
        if ($this->request->isAJAX()) {
            //primary id
            $id = $this->request->getVar('id');
            $data = $this->genre->genreById($id);
            $response['status'] = $data ? true : false;
            $response['data'] = $data;
            return $this->response->setJSON($response);
        }
    }
    
    
    /**
     *
     * update genre data
     *
     * @return array|json
     */
    
    public function update()
    {
        $response = array();
        $id = (int)$this->request->getPost('genre_id');
        $validation = $this->_genreFormValidation($id);
        if ($validation===true) {

            $inputData = $this->_genreInput('update');
            
            $status = $this->genre->updateGenre($inputData, $id);

            if ($status===true) {
                $response['status'] = true;
                $response['msg'] =  'Genre updated successfully.';
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

    /**
     *
     * delete genre
     * @param int $id is unique user id
     * @return session data
     */
    
    public function delete($id)
    {
        $response = $this->genre->deleteGenre($id);
        session()->setFlashdata($response);
        return redirect()->to('admin/media-genre');
    }

}
