<?php
	if ($this->session->state == 'valid')
	{
		$user  = $this->session->uid;
		$level = $this->session->level;
		echo('<p align="center">Welcome, ' . $user . '.</p>' . "\n");
		if ($level == 0)
		{
			echo('<p align="center">You are currently registered as a guest. Please contact the administration team to fully verify your account.</p>' . "\n");
		}
		echo('<hr>');
	}
?>
