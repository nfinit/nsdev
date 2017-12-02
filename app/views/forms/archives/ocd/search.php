<h2 align="center">Database search</h2>
<div class="form_std_container" align="center">
        <form method="GET" align="center" class="form_std"><fieldset>
			<label for="key"><strong>Keyphrase: </strong></label><input type="text" name="key" size="40" value="<?php if (isset($last_key)) echo $last_key; ?>">
			<hr>
                        <label for="vendor">Vendor: </label>
                        <select name="vendor">
                                <?php 
					if (isset($last_vendor) && $last_vendor != '') {
						echo '<option value="' . $last_vendor . '">(' . $last_vendor . ')</option>' . "\n";
						echo '<option value="">(All vendors)</option>' . "\n";
                                	} else {
						echo '<option value="">(All vendors)</option>' . "\n";
					}
					
					echo $vendor_menu; 
				?>
                        </select>
                <input type="submit" name="search" value="Search">
        </fieldset></form>
</div><hr>
