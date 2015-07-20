<?php

include_once 'models/User.php';

class Shift extends BaseRow {

	public $table_name = 'shifts';
	protected $default_order_by = 'start_time ASC';

	function setup () {
		$this->associations = array(
			'manager' => new BelongsTo(array(
				'class' => 'User',
				'key'   => 'manager_id'
			))
		);
	}

	function validate () {
		$errors = array();
		if (isset($this->manager_id) && !UserTable()->isUserInRole($this->manager_id, 'manager'))
			$errors['manager_id'] = 'Manager ID must belong to a user in the manager role.';
		if (isset($this->employee_id) && !UserTable()->isUserInRole($this->employee_id, 'employee'))
			$errors['employee_id'] = 'Employee ID must belong to a user in the employee role.';
		if (empty($this->start_time))
			$errors['start_time'] = 'Start time must be specified.';
		if (empty($this->end_time))
			$errors['end_time'] = 'End time must be specified.';
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

	// Return shift length as a Unix timestamp,
	// to more easily perform arithmetic on it.
	function length () {
		return strtotime($this->end_time) - strtotime($this->start_time);
	}
}

function ShiftTable () {
	return new Shift();
}

?>
