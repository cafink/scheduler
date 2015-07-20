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
}

function UserTable () {
	return new User();
}

?>
