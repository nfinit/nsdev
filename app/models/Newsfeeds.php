<?php
	class Newsfeeds extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
	
		public function supported($src)
		{
			$src = preg_replace("/[^A-Za-z0-9]/", '', $src);
			$query = "SELECT arg FROM newsfeeds WHERE arg=?";
			$result = $this->db->query($query, $src);
			$result = $result->num_rows();
			if ($result > 0) return true;
			return false;
		}

		public function get_paths($src)
		{
			$src = preg_replace("/[^A-Za-z0-9]/", '', $src);
			$query = "SELECT path FROM newsfeeds WHERE arg=? ORDER BY siteorder ASC";
			$result = $this->db->query($query, $src);
			$result = $result->result_array();
			return $result;
		}

		public function get_source($src)
		{
			$src = preg_replace("/[^A-Za-z0-9]/", '', $src);
			$query = "SELECT source FROM newsfeeds WHERE arg=?";
			$result = $this->db->query($query, $src);
			$result = $result->row_array();
			return $result['source'];
		}

		public function get_logo($src)
		{
			$src = preg_replace("/[^A-Za-z0-9]/", '', $src);
			$query = "SELECT logo FROM newsfeeds WHERE arg=?";
			$result = $this->db->query($query, $src);
			$result = $result->row_array();
			return $result['logo'];
		}

		public function source_overview()
		{
			$query = "SELECT DISTINCT source, arg, logo, descr FROM newsfeeds";
			$result = $this->db->query($query);
			$result = $result->result_array();
			return $result;
		}		
	}
?>
