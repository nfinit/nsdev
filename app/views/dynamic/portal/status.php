<?php

	function printHTML($text, $level)
	{
		$color = 'green';
		if ($level == 1) $color = 'red';
		echo "<h2 align=\"center\"><font color=\"" . $color . "\">";
		echo $text;
		echo "</font></h2><hr>";
	}

	foreach ($status as $code)
	{
		switch ($code)
		{
			case 0:
				$text = 'Account creation successful. Click <a href="http://nfinit.systems/portal">here</a> to return to the login page.';
				printHTML($text, 0);
				break;
			case 1:
				$text = "Account creation failed.";
				printHTML($text, 1);
				break;
			case 2:
				$text = "Submission did not include a valid username. Please use only alphanumeric characters, underscores and dashes.";
				printHTML($text, 1);
				break;
			case 3:
				$text = "Passwords did not match. Please confirm your password to ensure that it is properly entered.";
				printHTML($text, 1);
				break;
			case 4:
				$text = "E-mail address provided is invalid. Please enter a valid address for account verification.";
				printHTML($text, 1);
				break;
			case 5:
				$text = "Submission did not include a username.";
				printHTML($text, 1);
				break;
			case 6:
				$text = "Submission did not include an e-mail address.";
				printHTML($text, 1);
				break;
			case 7:
				$text = "Submission did not include a password.";
				printHTML($text, 1);
				break;
			case 8:
				$text = "Submission did not include a password confirmation.";
				printHTML($text, 1);
				break;
			case 9:
				$text = "Provided password is too long, please enter a password under 50 characters in length.";
				printHTML($text, 1);
				break;
		}
	}

?>
