<div align="center"><a href="<?php echo base_url(); ?>legacy">
<?php
	if ($this->session->mobile > 0) {
		echo '<img src="' . base_url() . 'nsr/img/legacy/logo-mini.gif" alt="NFINIT Legacy" title="NFINIT Legacy" />';
	} else if ($this->session->wide > 0) {
		echo '<img src="' . base_url() . 'nsr/img/legacy/logo-large.gif" alt="NFINIT Legacy" title="NFINIT Legacy" style="width: 75%; max-width: 1100px;" />';
	} else {
		echo '<img src="' . base_url() . 'nsr/img/legacy/logo.gif" alt="NFINIT Legacy" title="NFINIT Legacy" />';
	}
?>
</a></div>
