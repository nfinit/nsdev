<h1 align="center">Article view</h1><hr width="500px">
<h1 align="center"><?php echo '<img src="' . base_url() . 'nsr/img/legacy/logos/' . $logo . '" />'; ?></h1>
<h2 align="center"><?php echo '<a href="' . base_url() . 'legacy/news/' . $src . '">' . $title . '</a>'; ?></h2><hr width="500px">
<?php
	$target = FCPATH . 'nsr/store/legacy/news/' . $src . '/' . $cat . '/articles/' . $article;
	if (file_exists($target)) {
		$html = '<div align="center"><table width="500px"><tr><td>' . "\n";
		$html .= file_get_contents($target) . "\n";
		$html .= '</td></tr></table></div><hr width="500px">' . "\n";
	} else {
		$html = '<h2 align="center">' . $path['title'] . '</h2>' . "\n";
		$html .= '<div align="center"><table width="500px"><tr><td><p align="center"><i>This content does not exist or is currently unavailable.</i></p></td></tr></table><hr width="500px"></div>';
	}
	$html .= '<h2 align="center"><strong><a href="' . base_url() . 'legacy/news/' . $src . '">Back to ' . $title . '</a></strong></h2>';
	echo $html;
?>
