<?php
	class Nsocd extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		
		/* Returns all unique vendors present in the database */
		public function vendors()
		{
			$query = $this->db->query('SELECT DISTINCT(vendor) FROM ocd ORDER BY vendor ASC');
			return $query->result_array();
		}	

		/* Generates HTML options for drop-downs */
		public function vendor_options()
		{
			$vendors = $this->vendors();
			$opts = '';
			foreach ($vendors as $vendor)
			{
				$opts .= "<option value=\"" . $vendor['vendor'] . "\">" . $vendor['vendor'] . "</option>\n";
			}
			return $opts;
		}

		/* Returns all unique systems present in the database */
		public function systems($vendor)
		{
			$query = $this->db->query('SELECT * FROM ocd WHERE vendor=' . $this->db->escape($vendor) . ' ORDER BY system ASC, date DESC');
			return $query->result_array();
		}

		/* Search all records in the database */
		public function search($keyphrase)
		{
			/* Break input into tokens and create base query string */
			$tokens = explode(' ', $keyphrase);
                        
			/* Variables to be manipulated during the iteration */
			$flag = 0;
			$directive = '';
			$j = -1;
			$currentString = '';
			$query = "SELECT * FROM ocd WHERE ";

			/* Iterate over each token */
			for ($i = 0; $i < count($tokens); $i++)
			{                           
                                /* Continue if this token is part of a quoted string */
				if ($j >= $i) continue;
                                $j = -1;
                                
				/* Detect 'vendor:' directive */
				if ($flag == 0 && substr($tokens[$i],0,7) == 'vendor:')
				{
					$flag = 1;
					$directive = substr($tokens[$i],0,6);
				}

				/* Detect 'system:' directive */
				if ($flag == 0 && substr($tokens[$i],0,7) == 'system:')
				{
					$flag = 1;
					$directive = substr($tokens[$i],0,6);
				}

				/* Detect 'config:' directive */
				if ($flag == 0 && substr($tokens[$i],0,7) == 'config:')
				{
					$flag = 1;
					$directive = substr($tokens[$i],0,6);
				}

				/* Detect 'extras:' directive */
				if ($flag == 0 && substr($tokens[$i],0,7) == 'extras:')
				{
					$flag = 1;
					$directive = substr($tokens[$i],0,6);
				}

				/* Check for a quoted string if no directives were detected */
				if ($flag == 0 && substr($tokens[$i],0,1) == '"')
				{
					$j = $i+1;
                                        $currentString .= $tokens[$i];

					//Determine how many tokens are part of the quoted string and build the keyphrase
					while ($j < count($tokens) && substr($tokens[$j],-1) != '"')
					{
						if (substr($tokens[$j-1],-1) == '"') break;
                                                $currentString .= ' ' . $tokens[$j];
						$j++;
					}

					//Append the last token onto the keyphrase if applicable
					if ($j < count($tokens) && substr($tokens[$j],-1) == '"' && substr($tokens[$j-1],-1) != '"') {
						$currentString .= ' ' . $tokens[$j];
					} else {
						//So we don't skip over a token that isn't supposed to be skipped
						$j--;
					}

					//Shave quotes off of the keyphrase
					$currentString = substr($currentString, 1, -1);

					//Build subquery and add to final string
					if ($i == 0) {
						$query .= "(vendor LIKE '%{$currentString}%' OR system LIKE '%{$currentString}%' OR config LIKE '%{$currentString}%' OR extras LIKE '%{$currentString}%')";
					} else {
						$query .= " AND (vendor LIKE '%{$currentString}%' OR system LIKE '%{$currentString}%' OR config LIKE '%{$currentString}%' OR extras LIKE '%{$currentString}%')";
					}
					
					$flag = 0;
					$directive = '';
					$currentString = '';
					continue;
				}

				/* Check for a quoted string if directives were detected */
				if ($flag > 0 && substr($tokens[$i],7,1) == '"')
				{
					$j = $i+1;
					$currentString .= substr($tokens[$i],7);
                                        
					while ($j < count($tokens) && substr($tokens[$j],-1) != '"')
					{
						if (substr($tokens[$j-1],-1) == '"') break;
                                                $currentString .= ' ' . $tokens[$j];
						$j++;
					}

					if ($j < count($tokens) && substr($tokens[$j],-1) == '"' && substr($tokens[$j-1],-1) != '"') {
						$currentString .= ' ' . $tokens[$j];
					} else {
						//So we don't skip over a token that isn't supposed to be skipped
						$j--;
					}
					
					$currentString = substr($currentString, 1, -1);

					if ($i == 0) {
						$query .= "({$directive} LIKE '%{$currentString}%')";
					} else {
						$query .= " AND ({$directive} LIKE '%{$currentString}%')";
					}

					$flag = 0;
					$directive = '';
					$currentString = '';
					continue;
				}

				/* Parse a single token with a directive otherwise */
				if ($flag > 0)
				{
					$currentString = substr($tokens[$i],7);	
					if ($i == 0) {
						$query .= "({$directive} LIKE '%{$currentString}%')";
					} else {
						$query .= " AND ({$directive} LIKE '%{$currentString}%')";
					}
                                        
                                        $flag = 0;
					$directive = '';
					$currentString = '';
					
                                        continue;
				}

				/* Or parse a single token with no directive */
				if ($flag == 0)
				{
					$currentString = $tokens[$i];	
					if ($i == 0) {
						$query .= "(vendor LIKE '%{$currentString}%' OR system LIKE '%{$currentString}%' OR config LIKE '%{$currentString}%' OR extras LIKE '%{$currentString}%')";
					} else {
						$query .= " AND (vendor LIKE '%{$currentString}%' OR system LIKE '%{$currentString}%' OR config LIKE '%{$currentString}%' OR extras LIKE '%{$currentString}%')";
					}
                                        
                                        $flag = 0;
					$directive = '';
					$currentString = '';
					
                                        continue;
				}

			}                
                       
                        // append order-by statement
                        $query .= " ORDER BY vendor, system, date, price ASC";
                        /* Execute the newly built query */
			$q = $this->db->query($query);
			return $q->result_array();	
		}

	}
?>
