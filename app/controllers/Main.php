<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head');
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
		// BEGIN CONTENT // BEGIN CONTENT //
		$this->load->view('static/main/intro');
		//  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}
}
?>
