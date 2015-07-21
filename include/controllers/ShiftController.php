<?php

include_once 'models/Shift.php';

class ShiftController extends ApplicationController {

	function create ($coords) {
		if ($this->requestorRole('manager')) {
			$this->shift = new Shift($_POST);
			if ($this->shift->save()) {
				// Refresh straight from the database.
				// This removes extraneous fields
				// (like dispatch_original_path)
				// and pulls in additional DB fields
				// (like created_at and updated_at).
				$this->shift->reload();
				$this->renderWithoutLayout();
			} else {
				$this->errors = $this->shift->getErrors();
				header('HTTP/1.0 400 Bad Request');
				$this->renderWithoutLayout(array('file' => 'shift/errors.php'));
			}
		}
	}

	function index ($coords) {
		if ($this->requestorRole('manager')) {
			$this->shifts = ShiftTable()->listShifts($_GET['start_time'], $_GET['end_time']);
			$this->renderWithoutLayout();
		}
	}

	function update ($coords) {
		if ($this->requestorRole('manager')) {
			parse_str(file_get_contents("php://input"), $put);
			ShiftTable()->update($put, $coords['id']);
			$this->shift = ShiftTable()->get($coords['id']);
			$this->renderWithoutLayout();
		}
	}
}

?>
