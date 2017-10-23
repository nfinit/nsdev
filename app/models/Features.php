<?php
	class Features extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
	
		/* Checks the availability of a given site feature in the database, 
		   Returns 1 if the feature is available, returns 0 if unavailable. */	
		public function isAvailable($feature = '')
		{
			$feature = preg_replace("/[^A-Za-z0-9]/", '', $feature);
			$query = "SELECT available FROM features WHERE name=?";
			$result = $this->db->query($query, $feature);
			$return = $result->row_array();
			return $return['available'];
		}

		/* Returns the "home" location of a feature, for building URLs */
		public function getHome($feature = '')
		{
			$feature = preg_replace("/[^A-Za-z0-9]/", '', $feature);
			$query = "SELECT home FROM features WHERE name=?";
			$result = $this->db->query($query, $feature);
			$return = $result->row_array();
			return $return['home'];
		}

		/* Allows for quick disabling of access points to site features for maintenance/security purposes */	
		public function toggleAvailability($feature = '')
		{
			$feature = preg_replace("/[^A-Za-z0-9]/", '', $feature);
			if ($this->isAvailable($feature)) {
				$query = "UPDATE features SET available=0 WHERE name=?";
				$this->db->query($query, $feature);
			} else {
				$query = "UPDATE features SET available=0 WHERE name=?";
				$this->db->query($query, $feature);
			}			
		}
	}
?>
