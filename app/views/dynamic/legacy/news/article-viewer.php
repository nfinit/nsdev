<br>
<div align="center">
<?php echo '<a href="' . base_url() . 'legacy/news/' . $src . '">' . '<img src="' . base_url() . 'nsr/img/legacy/logos/' . $logo . '" alt="' . $title . '" title="' . $title . '" /></a>'; ?>
</div>
<?php
	$target = FCPATH . 'nsr/store/legacy/news/' . $src . '/' . $cat . '/articles/' . $article;
	if (file_exists($target)) {
		$html = '<div align="center"><table width="550px"><tr><td>' . "\n";
		$html .= file_get_contents($target) . "\n";
		$html .= '</td></tr></table></div>' . "\n";
	} else {
		$html .= '<div align="center"><table width="550px"><tr><td><div align="center"><p><i>This content does not exist or is currently unavailable.</i></p></div></td></tr></table></div>';
	}
	$html .= '<div align="center"><h2><strong><a href="' . base_url() . 'legacy/news/' . $src . '#' . $cat . '">Back to ' . $title . '</a></strong></h2></div>';
	echo $html;
?>
