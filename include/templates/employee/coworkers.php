{
	"users":

	<?php
		foreach($coworkers as $coworker)
			echo json_encode($coworker->toArray());
	?>
}
