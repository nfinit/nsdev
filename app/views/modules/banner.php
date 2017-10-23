<?php
        $banner_url = base_url() . 'nsr/img/banners';
        $directory = FCPATH . 'nsr/img/banners';
        $files = array_slice(scandir($directory),2);
        echo '<div id="banner" style="background-image: url(' . $banner_url . '/' . $files[rand(0,count($files)-1)] . ')" ></div>';
?>
