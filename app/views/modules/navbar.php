<?php $section = $this->uri->segment(1); ?>
<!-- Navbar -->
<div align="center">
<table id="navbar" align="center" cellspacing="0" cellpadding="0" ><tr>
		
<td class="nav-title">

	<!-- /// Back to site home /// -->
	<a href="<?php echo base_url(); ?>main"
		   title="Back to site index"><b>
			NFINIT.
		</b></a>
		<span id="invisible"> | </span>
	</td>

	<!-- /// To articles page /// -->	
	<td class="nav-object">
		<a href="<?php echo base_url(); ?>pages"
		   title="Pages">
		<?php if ($section == 'pages') echo '<b>'; ?>
			PAGES	
		<?php if ($section == 'pages') echo '</b>'; ?>
		</a>
		<span id="invisible"> | </span>
	</td>
	
	<!-- /// To archives page /// -->
	<td class="nav-object">
		<a href="<?php echo base_url(); ?>archives"
		   title="Archives portal">
		<?php if ($section == 'archives') echo '<b>'; ?>
			ARCHIVES
		<?php if ($section == 'archives') echo '</b>'; ?>
		</a>
		<span id="invisible"> | </span>
	</td>

	<!-- /// To legacy portal /// -->
	<td class="nav-object">
		<a href="<?php echo base_url(); ?>legacy"
		   title="Legacy Portal">
		<?php if ($section == 'legacy') echo '<b>'; ?>
			LEGACY	
		<?php if ($section == 'legacy') echo '</b>'; ?>
		</a>
		<span id="invisible"> | </span>
	</td>
		
	<!-- /// To user portal /// -->
	<td class="nav-object">
		<a href="<?php echo base_url(); ?>portal"
		   title="User Portal">
		<?php if ($section == 'portal') echo '<b>'; ?>
			PORTAL
		<?php if ($section == 'portal') echo '</b>'; ?>
		</a>
		<span id="invisible"> | </span>
	</td>
	
	<!-- /// To site information /// -->
	<td class="nav-object">
		<a href="<?php echo base_url(); ?>info"
		   title="Site information">
		<?php if ($section == 'info') echo '<b>'; ?>
			INFO
		<?php if ($section == 'info') echo '</b>'; ?>
		</a>
	</td>
		
</tr></table>
</div>
<hr id="invisible">
