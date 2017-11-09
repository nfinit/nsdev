<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legacy extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('static/legacy/head');
		//$this->load->view('modules/navbar');
		//$this->load->view('modules/banner');
		//$this->load->view('modules/begin-content');
		// BEGIN CONTENT // BEGIN CONTENT //
		$this->load->view('static/legacy/intro');
		$this->load->view('static/legacy/nav');
		$this->load->view('static/legacy/news');
		//  END CONTENT  //  END CONTENT  //
		//$this->load->view('modules/end-content');
		//$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}
}
?>
