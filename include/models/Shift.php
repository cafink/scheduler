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

	function concurrentShifts () {

		// Two time periods overlap if the first
		// starts before the second ends, and ends
		// after the second starts.
		return $this->find(array(
			'where' => 'ID <> ? AND start_time < ? AND end_time > ?',
			'params' => array($this->id, $this->end_time, $this->start_time)
		));
	}
}

function ShiftTable () {
	return new Shift();
}

?>
