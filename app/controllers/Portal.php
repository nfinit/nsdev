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
		if ($this->input->post('logout')) $this->portal_engine->logout($user);
	}

	private function handle_delete()
	{
		$user = $this->session->uid;
		$password = $this->input->post('passphrase');
		if ($this->input->post('delete')) $this->portal_engine->delete($user, $password);
	}

	private function handle_create()
	{
		$user = $this->input->post('username');
		$password = $this->input->post('passphrase');
		$confirm = $this->input->post('passphrase-confirm');
		if ($password != $confirm) return false;
		$email = $this->input->post('email');
		if ($this->input->post('create')) $this->portal_engine->create($user, $password, $email);
	}

	private function user_page()
	{
		$this->load->view('forms/portal/actions');	
	}

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
		if ($this->features->isAvailable('portal')) {

			$this->load->view('static/portal/intro');

			if ($this->session->uid && !$this->session->logout) {
				$this->handle_actions();
			} else {
				$this->print_login($this->handle_login());
			}

			if ($this->session->uid && !$this->session->logout) {
				$this->user_page();
			} else {
				$this->load->view('forms/portal/login');
			}

		} else { $this->load->view('static/errors/unavailable'); }
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}

	public function delete()
	{
		$this->load->helper('url');
		$this->load->view('modules/begin-page');
		$this->load->view('modules/head');
		$this->load->view('modules/navbar');
		$this->load->view('modules/banner');
		$this->load->view('modules/begin-content');
                // BEGIN CONTENT // BEGIN CONTENT //
		if ($this->features->isAvailable('portal')) {

			$this->load->view('static/portal/delete');

			if ($this->session->uid && !$this->session->logout) {
				$this->handle_delete();
				$this->load->view('forms/portal/delete');
			} else {
				$this->load->view('static/portal/invalid');
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

			$this->handle_create();
			$this->load->view('static/portal/create');
			$this->load->view('forms/portal/create');

		} else { $this->load->view('static/errors/unavailable'); }
                //  END CONTENT  //  END CONTENT  //
		$this->load->view('modules/end-content');
		$this->load->view('modules/footer');
		$this->load->view('modules/end-page');
	}
}
?>
