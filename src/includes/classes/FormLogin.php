<?php

use \libAllure\Form;
use \libAllure\ElementHidden;
use \libAllure\ElementPassword;

class FormLogin extends Form {
	public function __construct() {
		parent::__construct('login', 'Login');
		$this->addElement(new ElementPassword('password', 'password', 'Password'));

		$this->addDefaultButtons();
	}

	public function process() {
		if ($this->getElementValue('password') != ADMIN_PASSWORD) {
			throw new Exception('Wrong password.');
		}

		$_SESSION['admin'] = true;
	}
}

?>
