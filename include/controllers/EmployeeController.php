<?php

include_once 'models/User.php';

class EmployeeController extends ApplicationController {

	function shifts ($coords) {
		$this->shifts = UserTable()->getEmployee($coords['id'])->shifts;
		$this->page['layout'] = false;
		$this->render();
	}

	function coworkers ($coords) {
		$this->coworkers = UserTable()->getEmployee($coords['id'])->coworkers();
		$this->page['layout'] = false;
		$this->render();
	}

	function summary ($coords) {
		$this->summary = UserTable()->getEmployee($coords['id'])->summary();
		$this->page['layout'] = false;
		$this->render();
	}
}

?>
