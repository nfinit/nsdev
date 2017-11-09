<?php
		setlocale(LC_MONETARY, 'en_US.UTF-8');
		echo('<table align="center" width=100%>' . "\n");
		echo('<tr><th>System</th><th>Configuration</th><th>Extras</th><th>Price</th><th>Date</th></tr>' . "\n");
		foreach ($out as $idx=>$system)
		{
			if ($idx % 2 === 0) {	
				echo('<tr class="tr_std_alt" align="center"><td>' . $system['vendor'] . ' ' . $system['system'] . '</td><td>' . $system['config'] . '</td><td>' . $system['extras'] . '</td><td>' . money_format('%.2n',$system['price']) . '</td><td>' . date("n/j/Y", strtotime($system['date'])) . '</td></tr>' . "\n");
			} else {
				echo('<tr align="center"><td>' . $system['vendor'] . ' ' . $system['system'] . '</td><td>' . $system['config'] . '</td><td>' . $system['extras'] . '</td><td>' . money_format('%.2n',$system['price']) . '</td><td>' . date("n/j/Y", strtotime($system['date'])) . '</td></tr>' . "\n");
			}
		}
		echo('</table><hr>' . "\n");
?>
