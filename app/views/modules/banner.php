<?php
	if (isset($title)) {
        	$banner_url = base_url() . 'nsr/img/title-banners';
		$directory = FCPATH . 'nsr/img/title-banners';
	} else {
        	$banner_url = base_url() . 'nsr/img/banners';
        	$directory = FCPATH . 'nsr/img/banners';
        }
	$files = array_slice(scandir($directory),2);
        $banner = '<div align="center" id="banner" style="background-image: url(';
	if (isset($page_banner)) {
		$banner .= $page_banner;
	} else {
		$banner .= $banner_url . '/' . $files[rand(0,count($files)-1)];
	}
	$banner .= ')" >';
	if (isset($title)) $banner .= $title;
	$banner .= '</div>';
	echo $banner;
?>
