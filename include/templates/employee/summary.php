{
	<?php
		$first = true;
		foreach($summary as $week => $hours) {
			if (!$first)
				echo ', ';
			echo '"Week of ' . $week . '": "' . $hours . '"';
			$first = false;
		}
	?>

}
