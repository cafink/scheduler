<?php

include_once 'models/Shift.php';

class UserException extends Exception { }
class EmployeeException extends UserException { }

class User extends BaseRow {

	public $table_name = 'users';

	function setup () {
		$this->associations = array(
			'shifts' => new HasMany(array(
				'class' => 'Shift',
				'key'   => 'employee_id'
			))
		);
	}

	function validate () {
		$errors = array();
		if (empty($this->email) && empty($this->phone)) {
			$errors['email'] = 'Either e-mail address or phone number must be specified.';
			$errors['phone'] = 'Either e-mail address or phone number must be specified.';
		}
		return $errors;
	}

	function getEmployee ($id) {
		$user = $this->get($id);
		if ($user->role != 'employee')
			throw new EmployeeException(get_class($this) . ' record #' . $id . ' is not an employee');
		return $user;
	}

	function coworkers () {

		// For each shift, find all concurrent shifts,
		// then add the IDs of those shifts' employees
		// to the $coworker_ids array (if they haven't
		// already been added).
		$coworker_ids = array();
		foreach ($this->shifts as $shift) {
			foreach ($shift->concurrentShifts() as $concurrent_shift) {
				if (!empty($concurrent_shift->employee_id) && !in_array($concurrent_shift->employee_id, $coworker_ids))
					$coworker_ids[] = $concurrent_shift->employee_id;
			}
		}

		// Get the actual User object for each ID.
		$coworkers = array();
		foreach ($coworker_ids as $id)
			$coworkers[] = $this->getEmployee($id);

		return $coworkers;
	}
}

function UserTable () {
	return new User();
}

?>
