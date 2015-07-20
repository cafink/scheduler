<?php

class User extends BaseRow {

	public $table_name = 'users';

	function validate () {
		$errors = array();
		if (empty($this->email) && empty($this->phone)) {
			$errors['email'] = 'Either e-mail address or phone number must be specified.';
			$errors['phone'] = 'Either e-mail address or phone number must be specified.';
		}
		return $errors;
	}
}

function UserTable () {
	return new User();
}

?>
