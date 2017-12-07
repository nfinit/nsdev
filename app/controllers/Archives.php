<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archives extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('features');
		$this->load->model('nsocd');
		$this->load->helper('url');
		$this->load->library('session');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['pagetitle'] = 'Archives';
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head', $data);
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
                // BEGIN CONTENT // BEGIN CONTENT //
		$this->load->view('static/archives/intro');
		if ($this->features->isAvailable('ocd'))
		{
			$data['ocd_home'] = $this->features->getHome('ocd');
			$this->load->view('static/archives/ocd/gate', $data);
		}
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}

	/**
	 * OEM Configuration Database page
	 */
	public function ocd()
	{
		$data['pagetitle'] = 'OEM Configuration Database';
		$data['vendor_menu'] = $this->nsocd->vendor_options();
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head', $data);
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
		// HANDLE INPUT  // HANDLE INPUT  //
		$data = $this->ocd_handle_query($data);
                // BEGIN CONTENT // BEGIN CONTENT //
		$data['configs'] = $this->nsocd->countAllConfigs();
		$data['systems'] = $this->nsocd->countSystems();
		$data['vendors'] = $this->nsocd->countVendors();
		$this->load->view('dynamic/archives/ocd/summary', $data);
		$this->load->view('forms/archives/ocd/search', $data);
		if (isset($data['out'])) {
			$data['rescount'] = count($data['out']);
			if ($data['rescount'] > 0) {
				$this->load->view('dynamic/archives/ocd/results', $data);
				$this->load->view('dynamic/archives/ocd/success', $data);
			} else {
				$this->load->view('static/errors/archives/ocd/noresults');
			}
		}
		$this->load->view('static/archives/ocd/tips');
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}

	/**
	 * Handles queries to the OCD
	 */
	private function ocd_handle_query($data)
	{

		// Save the user's last vendor option if it isn't blank	
		if ($this->input->get('vendor') || $this->input->get('vendor') === '') {
			$this->session->last_vendor = $this->input->get('vendor');
		}

		// Put the last vendor option in the data
		$data['last_vendor'] = $this->session->last_vendor;

		// Save the user's last vendor option if it isn't blank	
		if ($this->input->get('key') || $this->input->get('key') === '') {
			$this->session->last_key = htmlspecialchars($this->input->get('key'));
		}
		// Put the last vendor option in the data
		$data['last_key'] = $this->session->last_key;
	
		if ($this->input->get('vendor') && $this->input->get('vendor') != '') {
			if ($this->input->get('key') && $this->input->get('key') != '') {
				$data['out'] = $this->nsocd->search('vendor:"' . $this->input->get('vendor') . '" ' . $this->input->get('key'));
			} else {
				$data['out'] = $this->nsocd->systems($this->input->get('vendor'));
				return $data;
			}
		} else {
			if ($this->input->get('key') && $this->input->get('key') != '') {
				$data['out'] = $this->nsocd->search($this->input->get('key'));
				return $data;
			}
		}

		return $data;
	}
}
?>
