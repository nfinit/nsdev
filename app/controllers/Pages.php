<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_engine');
                $this->load->library('session');
	}
	
	/**
	 * View a page
	 */
	public function view($category = '', $page = '')
	{
		$this->load->helper('url');
		// LOAD DATA // LOAD DATA //
		$data['page'] = $this->page_engine->getPage($page);
		$data['category'] = $this->page_engine->getCategory($category);
		$data['page_banner'] = $this->page_engine->getBanner($category, $page);
		if ($data['page_banner'] == false) unset($data['page_banner']);	
		$data['page_body'] = $this->page_engine->getBody($category, $page);
		if ($data['page_body'] == false) unset($data['page_body']);	
		$data['pagetitle'] = $data['page']['title'];
		// END LOAD // END LOAD //
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head', $data);
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner', $data);
		$this->load->view('modules/begin-content');
		// BEGIN CONTENT // BEGIN CONTENT //
		$this->load->view('dynamic/pages/title', $data);
		$this->load->view('dynamic/pages/viewer', $data);
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['pagetitle'] = 'Pages';
		$this->load->helper('url');
		// LOAD DATA // LOAD DATA //
		$data['index'] = $this->page_engine->getIndex();		
		// END LOAD // END LOAD //
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head', $data);
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
		// BEGIN CONTENT // BEGIN CONTENT //
		$this->load->view('static/pages/intro');
		$this->load->view('static/messages/construction');
		$this->load->view('dynamic/pages/index', $data);
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}
	

}
?>
