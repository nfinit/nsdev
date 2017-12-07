<head>
	<?php
		if (isset($pagetitle)) {
			echo '<title>NFINIT: ' . $pagetitle . '</title>';
		} else {
			echo '<title>NFINIT: Legacy</title>';
		}
	?>
	<link rel="shortcut icon" href="http://nfinit.systems/nsr/img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="57x57" href="http://nfinit.systems/nsr/img/legacy/appico/apple-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="http://nfinit.systems/nsr/img/legacy/appico/apple-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="http://nfinit.systems/nsr/img/legacy/appico/apple-114x114.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="http://nfinit.systems/nsr/img/legacy/appico/apple-144x144.png" />
	<style>
		html {font-family: Arial;}	
		body {background-color: #FFFFFF;}
		a img { border: 0; }
		a:hover img {border: 0; }
		a:visited img {border: 0; }
		<?php if ($this->session->mobile === 1) echo 'table { width: 80%; max-width: 1100px; font-size: 125%; }'; ?>
	</style>
</head>
<body bgcolor="#FFFFFF">
<font face="arial,sans-serif">
