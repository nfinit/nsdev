<br>
<div align="center">
<a name="home"></a>
<?php echo '<a href="' . base_url() . 'legacy/news/' . $src . '">' . '<img src="' . base_url() . 'nsr/img/legacy/logos/' . $logo . '" alt="' . $title . '" title="' . $title . '" /></a>'; ?>
<br>
</div>
<?php
	$target = FCPATH . 'nsr/store/legacy/news/' . $src . '/' . $cat . '/index.html';
	if (file_exists($target)) {
		$html = file_get_contents($target);
	} else {
		$html = '<h2 align="center">' . $path['title'] . '</h2>' . "\n";
		$html .= '<div align="center"><table width="550px"><tr><td><p align="center"><i>This content is currently being processed and is temporarily unavailable. Please check back soon.</i></p></td></tr></table></div>';
	}
	echo $html;
?>
