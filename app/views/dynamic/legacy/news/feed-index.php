<br>
<div align="center">
<a name="home"></a>
<?php echo '<a href="' . base_url() . 'legacy/news/' . $src . '">' . '<img src="' . base_url() . 'nsr/img/legacy/logos/' . $logo . '" alt="' . $title . '" title="' . $title . '" /></a>'; ?>
<?php if ($this->session->mobile === 0) echo '<br>'; ?>
</div>
<div align="center">
	<table width="550px"><tr><td>
	<?php
		$target = FCPATH . 'nsr/store/legacy/news/' . $src . '/index.html';
		if (file_exists($target) && !$this->session->mobile) {
			$html = file_get_contents($target);
			$html .= '</td></tr></table></div>';
			echo $html;
		} else if ($this->session->mobile > 0) {
			//$html =  '<div align="center">';
			//$html .= '<h2>Index</h2>';
			//$html .= '</div>';
			//echo $html;
		}	
	?>
<?php
	foreach ($paths as $path)
	{
		$target = FCPATH . 'nsr/store/legacy/news/' . $path['path'] . '/index.html';
		if ($this->session->mobile > 0) {
			$html =  '<div align="center">';
			$html .= '<h2>';
			$html .= '<a href="' . base_url() . 'legacy/news/' . $path['path'] . '">';
			$html .= $path['title'];
			$html .= '</a>';
			if ($path['archive'] > 0) $html .= '*';
			$html .= '</h2>';
			$html .= '</div>';
		} else if (file_exists($target)) {
			$html = file_get_contents($target);
		} else {
			$html = '<h2 align="center">' . $path['title'] . '</h2>' . "\n";
			$html .= '<div align="center"><table width="550px"><tr><td><p align="center"><i>This content is currently being processed and is temporarily unavailable. Please check back soon.</i></p></td></tr></table></div>';
		}
		echo $html;
	}
	if ($this->session->mobile > 0) {
			$html  = '<br>';
			$html .= '<div align="center"><em>';
			$html .= 'Categories marked with an asterisk (*) '; 
			$html .= 'are archived on this website for direct viewing';
			$html .= '</em></div>';
			$html .= '</td></tr></table></div>';
			echo $html;
	}
?>
