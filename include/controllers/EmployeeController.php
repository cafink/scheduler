<?php

include_once 'models/User.php';

class EmployeeController extends ApplicationController {

	function shifts ($coords) {
		$this->shifts = UserTable()->getEmployee($coords['id'])->shifts;
		$this->renderWithoutLayout();
	}

	function coworkers ($coords) {
		$this->coworkers = UserTable()->getEmployee($coords['id'])->coworkers();
		$this->renderWithoutLayout();
	}

	function summary ($coords) {
		$this->summary = UserTable()->getEmployee($coords['id'])->summary();
		$this->renderWithoutLayout();
	}

	function managers ($coords) {
		$this->shifts = UserTable()->getEmployee($coords['id'])->shifts;
		$this->renderWithoutLayout();
	}
}

?>
