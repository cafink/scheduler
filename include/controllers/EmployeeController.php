<?php

include_once 'models/User.php';

class EmployeeController extends ApplicationController {

	function shifts ($coords) {
		if ($this->requestorRole('employee')) {
			$this->shifts = UserTable()->getEmployee($coords['id'])->shifts;
			$this->renderWithoutLayout();
		}
	}

	function coworkers ($coords) {
		if ($this->requestorRole('employee')) {
			$this->coworkers = UserTable()->getEmployee($coords['id'])->coworkers();
			$this->renderWithoutLayout();
		}
	}

	function summary ($coords) {
		if ($this->requestorRole('employee')) {
			$this->summary = UserTable()->getEmployee($coords['id'])->summary();
			$this->renderWithoutLayout();
		}
	}

	function managers ($coords) {
		if ($this->requestorRole('employee')) {
			$this->shifts = UserTable()->getEmployee($coords['id'])->shifts;
			$this->renderWithoutLayout();
		}
	}
}

?>
