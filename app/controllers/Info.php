<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['pagetitle'] = 'Info';
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head', $data);
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
                // BEGIN CONTENT // BEGIN CONTENT //
		$this->load->view('static/info/intro');
		$this->load->view('dynamic/info/team');
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}
}
?>
