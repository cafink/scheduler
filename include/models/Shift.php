<?php

class Shift extends BaseRow {

	public $table_name = 'shifts';

	function validate () {
		$errors = array();
		if (empty($this->start_time))
			$errors['start_time'] = 'Start time must be specified.';
		if (empty($this->end_time))
			$errors['end'] = 'End time must be specified.';
		return $errors;
	}
}

function ShiftTable () {
	return new Shift();
}

?>
