<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
                $this->load->model('features');
                $this->load->model('portal_engine');
	}

	private function handle_login()
	{
		if (!$this->input->post('login')) return -1;
		$user = $this->input->post('username');
		$password = $this->input->post('passphrase');
		return $this->portal_engine->login($user,$password);
	}

	private function print_login($status)
	{
		if ($status === -1) return;
		if ($status > 0) {
			$this->load->view('static/errors/portal/login_success');
		} else {
			$this->load->view('static/errors/portal/login_failure');
		}
	}

	private function handle_actions()
	{
		$user = $this->session->uid;
		if ($this->input->post('passphrase')) $passphrase = $this->input->post('passphrase');
		if ($this->input->post('logout')) $this->portal_engine->logout($user);
		if ($this->input->post('confirm-delete')) 
		{
			$this->portal_engine->logout($user);
			$this->portal_engine->delete($user, $passphrase);
		}
	}

	private function handle_create()
	{
		if (!$this->input->post('create')) return;
		$status = array();

		$user = $this->input->post('username');
		if (empty($user)) array_push($status, 5);
		if (!preg_match('/^[a-zA-Z0-9-_]+$/',$user)) {
			array_push($status, 2);
		}

		$email = $this->input->post('email');
		if (empty($email)) array_push($status, 6);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($status, 4);

		$password = $this->input->post('passphrase');
		$confirm = $this->input->post('passphrase-confirm');
		if (empty($password)) array_push($status, 7);
		if (empty($confirm)) array_push($status, 8);
		if (strlen($password) > 50) array_push($status, 9);
		if ($password != $confirm) array_push($status, 3);
		
		if (empty($status)) {
			array_push($status, 0);
			$this->portal_engine->create($user, $password, $email);
		}

		return $status;
	}

	private function user_page()
	{
		$this->load->view('dynamic/portal/welcome');	
		$this->load->view('forms/portal/actions');	
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['pagetitle'] = 'User Portal';
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head', $data);
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
                // BEGIN CONTENT // BEGIN CONTENT //
		if ($this->features->isAvailable('portal')) {

			$this->load->view('static/portal/intro');

			if ($this->session->uid && !$this->session->logout) {
				$this->handle_actions();
			} else {
				$this->print_login($this->handle_login());
			}

			if ($this->session->uid && !$this->session->logout) {
				if ($this->input->post('delete')) {
					$this->load->view('forms/portal/delete');
				} else {
					$this->user_page();
				}
			} else {
				$this->load->view('forms/portal/login');
			}

		} else { $this->load->view('static/errors/unavailable'); }
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}

	public function create()
	{
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head');
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
                // BEGIN CONTENT // BEGIN CONTENT //
		if ($this->features->isAvailable('portal')) {

			$data['status'] = $this->handle_create();
			$this->load->view('static/portal/create');
			if (!empty($data['status'])) $this->load->view('dynamic/portal/status', $data);
			$this->load->view('forms/portal/create');

		} else { $this->load->view('static/errors/unavailable'); }
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}
}
?>
