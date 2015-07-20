<?php

include_once 'models/User.php';

class ApplicationController extends BaseController {

	function requestorProvided () {
		if (!isset($_REQUEST['requestor_id'])) {
			$this->message = 'requestor_id not provided';
			header('HTTP/1.0 401 Unauthorized');
			$this->renderWithoutLayout(array('file' => 'error/message.php'));
			return false;
		}

		return true;
	}

	function requestorRole ($role) {
		if ($this->requestorProvided()) {

			if (UserTable()->isUserInRole($_REQUEST['requestor_id'], $role))
				return true;

			$this->message = $role . ' role required';
			header('HTTP/1.0 401 Unauthorized');
			$this->renderWithoutLayout(array('file' => 'error/message.php'));
			return false;
		}
	}

	function renderWithoutLayout ($options = array()) {
		$this->page['layout'] = false;
		$this->render($options);
	}
}

?>
