<head>
	<?php 
		if (isset($pagetitle)) {
			echo '<title>NFINIT: ' . $pagetitle . '</title>';
		} else {
			echo '<title>NFINIT systems</title>';
		}
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>nsr/css/base.css" >
	<link rel="shortcut icon" href="<?php echo base_url(); ?>nsr/img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>nsr/img/appico/apple-57x57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>nsr/img/appico/apple-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>nsr/img/appico/apple-114x114.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>nsr/img/appico/apple-144x144.png" />
</head>
<body><div id="frame">
