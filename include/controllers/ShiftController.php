<?php

include_once 'models/Shift.php';

class ShiftController extends ApplicationController {

	function create ($coords) {
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

?>
