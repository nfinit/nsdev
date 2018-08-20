<div align="center">
<p><font size="5"><strong>Hypertext news feeds</strong> (updated hourly)</font></p><br>
<div align="center">
<table width="550px">
	<?php
		$counter = 1;
		$tr_closed = 0;
		$html = '';
		foreach ($sources as $source)
		{
			$tr_closed = 0;
			if ($source['arg'] == '') continue;
			if ($counter%4 == 1) $html .= '<tr align="center">' . "\n";
			$html .= '<td><a href="' . base_url() . 'legacy/news/' . $source['arg'] . '"><img src="' . base_url() . 'nsr/img/legacy/logos/' . $source['logo'] . '" alt="[' . $source['source'] . ']" width="100px" /></td>' . "\n";
			if ($counter%4 == 0)
			{
				$html .= '</tr>' . "\n";
				$tr_closed = 1;
			}
			$counter++;
		}
		if ($tr_closed == 0)
		{
			for ($i = 0; $i <= $counter%4; $i++) {
				$html .= "<td></td>\n";
			}
			$html .='</tr>' . "\n";
		}
		echo($html);
	?>
</table>
</div>
</div><br>
