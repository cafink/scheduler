<?php

class ApplicationController extends BaseController {

	function renderWithoutLayout($options = array()) {
		$this->page['layout'] = false;
		$this->render($options);
	}
}

?>
