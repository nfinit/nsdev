<?php
	/* Start session and set location */
	session_start();
	$_SESSION['location'] = 'articles';
?>

<html>
	<head>
		<title>NFINIT: <?php $title = fgets(fopen("body.php", 'r')); echo " " . strip_tags($title); ?></title>
                <?php include_once($_SERVER["DOCUMENT_ROOT"] . "/nsr/util/head.php"); ?>
	</head>

	<body id="standard_page">
		
		<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/nsr/util/navbar.php"); ?>
		<a name="begin"></a>
		<div class="page-body"><?php include_once("body.php"); include_once($_SERVER["DOCUMENT_ROOT"] . "/nsr/util/articlenav.html"); ?></div>
		<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/nsr/util/footer.php"); ?>
		
	</body>

</html>
