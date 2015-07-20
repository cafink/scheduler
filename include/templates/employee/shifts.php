{
	"shifts":

	<?php
		foreach($shifts as $shift)
			echo json_encode($shift->toArray());
	?>
}
