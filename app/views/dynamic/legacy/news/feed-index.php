<h1 align="center"><?php echo '<img src="' . base_url() . 'nsr/img/legacy/logos/' . $logo . '" />'; ?></h1>
<h1 align="center"><?php echo $title; ?></h1><hr width="500px">
<?php
	foreach ($paths as $path)
	{
		$html = file_get_contents(FCPATH . 'nsr/store/legacy/news/' . $path['path'] . '/index.html');
		echo $html;
	}
?>
