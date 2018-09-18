<html>

<head>
	<title>System icons</title>
</head>
<body bgcolor="#BBBBBB">

<p>These icons are intended for use in forum signatures. Filenames and directory structure may change at any time, so it's recommended to mirror these on your own site or image host if you can.</p>
<hr>

<?php
	$basedir='/var/www/html/nsr/img/sysico/';
	$baselist=scandir($basedir);
	$folders=array_slice($baselist,2);
	foreach ($folders as $folder)
	{
		if (!is_dir($folder)) continue;
		$baseimgs = scandir($basedir . $folder . '/');
		$imgs = array_slice($baseimgs, 2);
		echo('<h1>' . $folder . '</h1>' . "\n");
		foreach ($imgs as $img)
		{
			echo('<img src="/nsr/img/sysico/' . $folder . '/' . $img . '"> &nbsp;' . "\n");
		}
	}
?>

</body>
</html>
