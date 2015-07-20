{
	"shifts":

	<?php
		$first = true;
		foreach($shifts as $shift) {
			if (!$first)
				echo ', ';
			echo '{ "id": "' . $shift->id . '", "manager": { ';
			echo '"name": "' . $shift->manager->name . '"';
			if (!empty($shift->manager->email))
				echo ', "email": "' . $shift->manager->email . '"';
			if (!empty($shift->manager->phone))
				echo ', "phone": "' . $shift->manager->phone . '"';

			echo ' } }';
			$first = false;
		}
	?>

}
