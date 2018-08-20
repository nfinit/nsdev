<?php
	class Page_engine extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function categoryAvailable($category)
		{
			$category = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $category);
			$query = "select sum(available) from pages where category=?";
			$result = $this->db->query($query, $category);
			$result = $result->row_array();
			$result = $result['sum(available)'];
			if ($result > 0) return true;
			return false;
		}
	
		/* Gets a list of page categories */
		public function getCategories()
		{
			$query = "SELECT * FROM categories";
			$result = $this->db->query($query);
			return $result->result_array();
		}
		
		/* Gets a list of pages for a given category */
		public function getPages($id = '')
		{
			$query = "SELECT * FROM pages WHERE category=? AND available=1";
			$result = $this->db->query($query, $id);
			return $result->result_array();
		}

		/* Get all data for a given page */
		public function getPage($id = '')
		{
			$id = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $id);
			$query = "SELECT * FROM pages WHERE id=?";
			$result = $this->db->query($query, $id);
			return $result->row_array();
		}

		/* Get all data for a given page */
		public function getCategory($id = '')
		{
			$id = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $id);
			$query = "SELECT * FROM categories WHERE id=?";
			$result = $this->db->query($query, $id);
			return $result->row_array();
		}

		public function getHome($category, $page)
		{
			$category = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $category);
			$page = preg_replace("/^[^a-zA-Z0-9-_]+$/", '', $page);
			return 'nsr/store/pages/' . $category . '/' . $page . '/';
		}

		public function getBanner($category, $page)
		{
			$target = self::getHome($category, $page) . 'img/banner.gif';
			if (file_exists(FCPATH . $target)) return '/' . $target;
			return false;
		}
		
		public function getBody($category, $page)
		{
			$target = self::getHome($category, $page) . 'text/body.php';
			if (file_exists(FCPATH . $target)) return FCPATH . $target;
			return false;
		}

		/* Generates an index of categories and pages */
		public function getIndex()
		{
			$categories = $this->getCategories();
			for ($i = 0; $i < count($categories); $i++)
			{
				if (self::categoryAvailable($categories[$i]['id'])) $categories[$i]['available'] = true;
				$categories[$i]['pages'] = $this->getPages($categories[$i]['id']);
				$categories[$i]['home'] = 'pages/' . $categories[$i]['id'] . '/';
			}
			return $categories;
		}

	}
?>
