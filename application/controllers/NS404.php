<?php 
	class NS404 extends CI_Controller
	{
		public function view($page = 'ns404')
		{
			$data['title'] = ucfirst($page);
			$this->load->helper('url');
			$this->load->view('templates/header', $data);
			$this->load->view('errors/'.$page, $data);
			$this->load->view('templates/footer', $data);
		}	
	}
?>
