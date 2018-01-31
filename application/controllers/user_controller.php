<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_controller extends CI_Controller {
	public function index()
	{
		$this->load->view('admin/adminview');
	}

	public function home() {
		
		$this->load->view('admin/adminview');
	}

	public function insert() {
		$this->load->view('user/insert_user');
	}

	public function show() {
		$this->load->model('user_models');
		$userView= $this->user_models->getAlluser();
		$data['userView'] = $userView;
		$this->load->view('user/user_view', $data);
	}

	public function adduser() {
		$this->load->model('user_models');

		  $config['upload_path']          = './upload/';
          $config['allowed_types']        = 'gif|jpg|png';
		  $config['max_size']             = 1000000;
          $config['max_width']            = 1024;
          $config['max_height']           = 768;

          $this->load->library('upload', $config);
          		$user = array(
				'name' => $_POST['name'],
				'price' => $_POST['price'],
				'description' => $_POST['description']
				
			);
                if ( ! $this->upload->do_upload('image')){
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('insert_user', $error);
                }
                else {
                      $data = array('upload_data' => $this->upload->data());
                      $user['image'] = $data['upload_data']['file_name'];
                }
        $this->user_models->adduser($user);

       
		redirect('user_controller/show');
	}


	public function delete($id) {
		$this->load->model('user_models');
		$this->user_models->delete($id);

		redirect('user_controller/show');
	}

	public function edit($id) {
		$this->load->model('user_models');
		$user = $this->user_models->getuser($id);
		$data['user'] = $user[0];
		$this->load->view('user/edit_user', $data);
	}

	public function edituser($id) {
		$this->load->model('user_models');

		  $config['upload_path']          = './upload/';
          $config['allowed_types']        = 'gif|jpg|png';
		  $config['max_size']             = 1000000;
          $config['max_width']            = 1024;
          $config['max_height']           = 768;


          $this->load->library('upload', $config);
		$user = array('name' => $_POST['name'],
						'price' => $_POST['price'],
						'description' => $_POST['description'] 
						);

		 if ( ! $this->upload->do_upload('image')){
                }
                else {
                        $data = array('upload_data' => $this->upload->data());
                      $user['image'] = $data['upload_data']['file_name'];
                }

		$user = $this->user_models->update($id, $user);
		
		redirect('user_controller/show');
	}

	
}

?>