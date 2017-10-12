<?php 
	class Notfound extends CI_Controller
	{
		public function view($page = '404')
		{
			$data['title'] = ucfirst($page);
			$this->load->helper('url');
			$this->load->view('templates/header', $data);
			$this->load->view('modules/banner', $data);
			$this->load->view('templates/content-header', $data);
			$this->load->view('404/'.$page, $data);
			$this->load->view('templates/content-footer', $data);
			$this->load->view('templates/footer', $data);
		}	
	}
?>
