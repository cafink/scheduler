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

		$shifts = $this->find(array(
			'where' => 'ID <> ?',
			'params' => array($this->id)
		));

		$concurrent_shifts = array();
		foreach ($shifts as $shift) {

			// Two time periods overlap if the first
			// starts before the second ends, and ends
			// after the second starts.
			if (($shift->start_time < $this->end_time) && ($shift->end_time > $this->start_time))
				$concurrent_shifts[] = $shift;
		}

		return $concurrent_shifts;
	}
}

function ShiftTable () {
	return new Shift();
}

?>
