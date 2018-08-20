<?php
	$categories = 0;
	foreach($index as $category)
	{
		if (!isset($category['available'])) continue;
		echo '<h2>' . $category['name'] . '</h2>';
		foreach ($category['pages'] as $page)
		{
			echo '<p>';
			echo '<a href="' . base_url() . $category['home'] . $page['id'] . '">';
			echo $page['title'];
			echo '</a>';
			echo '</p>';
		}
		$categories += 1;
	}

	if (!isset($categories))
	{
		echo '<p>' . "There are currently no pages available to display at this time." . '</p>';
	}
?>
