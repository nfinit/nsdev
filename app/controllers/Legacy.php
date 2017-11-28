<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Legacy extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->library('session');
                $this->load->model('features');
                $this->load->model('newsfeeds');
        }


	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('static/legacy/head');
		$this->load->view('static/legacy/intro');
		$this->load->view('static/legacy/nav');
		// BEGIN CONTENT // BEGIN CONTENT //
		
		$data['sources'] = $this->newsfeeds->source_overview(); 
		$this->load->view('dynamic/legacy/news/news', $data);
		
		//  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-page');
	}

	public function news($src = '')
	{
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('static/legacy/head');
		$this->load->view('static/legacy/intro');
		$this->load->view('static/legacy/nav');
		// BEGIN CONTENT // BEGIN CONTENT //
		
		$src = strtolower($src);
		if ($this->newsfeeds->supported($src))
		{
			$data['title'] = $this->newsfeeds->get_source($src);
			$data['logo'] = $this->newsfeeds->get_logo($src);
			$data['paths'] = $this->newsfeeds->get_paths($src);
			$this->load->view('dynamic/legacy/news/feed-index', $data);
		} else {

		}		
	
		//  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-page');
	}
}
?>
