<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_controller extends CI_Controller {
	public function index()
	{
		$this->load->view('admin/adminview');
	}

	public function home() {
		if(isset($this->session->userdata['username'])) {
			$data['session'] = $this->session->userdata;
			$this->load->view('admin/adminview', $data);
		} else {
			redirect('login');
		}
		
	}

	public function insert() {
		
		if(isset($this->session->userdata['username'])) {
			$data['session'] = $this->session->userdata;
			$this->load->view('product/insert_product', $data);
		} else {
			redirect('login');
		}
	}

	public function show() {
		$this->load->model('product_models');
		$productView= $this->product_models->getAllproduct();
		$data['productView'] = $productView;

		if(isset($this->session->userdata['username'])) {
			$data['session'] = $this->session->userdata;
			$this->load->view('product/product_view', $data);
		} else {
			redirect('login');
		}
	}

	public function addProduct() {
		$this->load->model('product_models');

		  $config['upload_path']          = './upload/';
          $config['allowed_types']        = 'gif|jpg|png';
		  $config['max_size']             = 1000000;
          $config['max_width']            = 1024;
          $config['max_height']           = 768;

          $this->load->library('upload', $config);
          		$product = array(
				'name' => $_POST['name'],
				'price' => $_POST['price'],
				'description' => $_POST['description']
				
			);
                if ( ! $this->upload->do_upload('image')){
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('insert_product', $error);
                }
                else {
                      $data = array('upload_data' => $this->upload->data());
                      $product['image'] = $data['upload_data']['file_name'];
                }
        $this->product_models->addProduct($product);

       
		redirect('product_controller/show');
	}


	public function delete($id) {
		$this->load->model('product_models');
		$this->product_models->delete($id);

		redirect('product_controller/show');
	}

	public function edit($id) {
		$this->load->model('product_models');
		$product = $this->product_models->getProduct($id);
		$data['product'] = $product[0];
		$this->load->view('product/edit_product', $data);
	}

	public function editProduct($id) {
		$this->load->model('product_models');

		  $config['upload_path']          = './upload/';
          $config['allowed_types']        = 'gif|jpg|png';
		  $config['max_size']             = 1000000;
          $config['max_width']            = 1024;
          $config['max_height']           = 768;


          $this->load->library('upload', $config);
		$product = array('name' => $_POST['name'],
						'price' => $_POST['price'],
						'description' => $_POST['description'] 
						);

		 if ( ! $this->upload->do_upload('image')){
                }
                else {
                        $data = array('upload_data' => $this->upload->data());
                      $product['image'] = $data['upload_data']['file_name'];
                }

		$product = $this->product_models->update($id, $product);
		
		redirect('product_controller/show');
	}

	
}

?>