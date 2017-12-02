<h1 align="center">Feed view</h1><hr width="500px">
<h1 align="center"><?php echo '<img src="' . base_url() . 'nsr/img/legacy/logos/' . $logo . '" />'; ?></h1>
<h2 align="center"><?php echo $title; ?></h2><hr width="500px">
<?php
	foreach ($paths as $path)
	{
		$target = FCPATH . 'nsr/store/legacy/news/' . $path['path'] . '/index.html';
		if (file_exists($target)) {
			$html = file_get_contents($target);
		} else {
			$html = '<h2 align="center">' . $path['title'] . '</h2>' . "\n";
			$html .= '<div align="center"><table width="500px"><tr><td><p align="center"><i>This content is currently being processed and is temporarily unavailable. Please check back soon.</i></p></td></tr></table><hr width="500px"></div>';
		}
		echo $html;
	}
?>
