<?php

include_once 'models/User.php';

class EmployeeController extends ApplicationController {

	function shifts ($coords) {
		$this->shifts = UserTable()->getEmployee($coords['id'])->shifts;
		$this->page['layout'] = false;
		$this->render();
	}
}

?>
