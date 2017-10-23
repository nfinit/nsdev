<h2 align="center">Database search</h2>
<div class="form_std_container">
        <form method="GET" align="center" class="form_std">
                <span style="width:40%;">
                        <label for="vendor">Vendor: </label>
                        <select name="vendor" style="width:60%;">
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
                </span>
                <span style="width:40%;"><label for="key">Keyphrase: </label><input type="text" name="key" style="width:60%;" value="<?php if (isset($last_key)) echo $last_key; ?>" align="left"></span>
                <span style="width:5%;"><input type="submit" name="search" value="Search"></span>
        </form>
</div><hr>
