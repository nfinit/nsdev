<?php
	class Portal_engine extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		private function userExists($user)
		{
			$user = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $user);
			$query = "SELECT uid FROM users WHERE uid=?";
			$result = $this->db->query($query, $user);
			if ($result->num_rows() != 0) return true;
			return false;
		}

		private function verifyLogin($user, $password)
		{
			$validated = false;
			$user = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $user);
			if (!$this->userExists($user)) return false;
			$query = "SELECT passphrase FROM users WHERE uid=?";
			$result = $this->db->query($query, $user);
			$result = $result->row_array();
			$hash = $result['passphrase'];	
			if (password_verify($password,$hash)) $validated = true;
			return $validated; 
		}

		public function login($user, $password)
		{
			$valid = $this->verifyLogin($user,$password);
			if ($valid === false) return false;
			$this->session->state = 'valid';
			$this->session->uid = $user;
			return $valid;
		}

		public function logout($user)
		{
			if (!$this->session->uid) return true;
			$this->session->logout = true;
			$this->session->sess_destroy();
			return true;
		}

		public function create($user, $password, $email)
		{
			$user = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $user);
			if ($user === '') return false;
			if ($password === '') return false;
			if ($email === '') return false;
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
			$password = password_hash($password, PASSWORD_DEFAULT);
			$data = array(
					'uid' => $user,
					'passphrase' => $password,
					'name' => $user,
					'email' => $email,
					'level' => 0 
				     );		
			$this->db->insert('users', $data);
		}

		public function delete($user, $password)
		{
			$user = preg_replace("/^[a-zA-Z0-9-_]+$/", '', $user);
			if (!verifyLogin($user, $password)) return false;
			$this->db->delete('users', array('uid' => $user));
		}

	}
?>
