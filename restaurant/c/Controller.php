<?php

session_start();

abstract class Controller {
	
	public function request($method) {
		$this->before();
		$this->$method();
		$this->render();
	}

	protected abstract function before();
	protected abstract function render();
	protected function isPost() {
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}
}