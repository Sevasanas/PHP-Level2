<?php
include_once('m/M_User.php');

class C_User extends C_Base {
	private $user;

	public function __construct()
	{
		$this->login = new User();
	}

	public function action_info() {

		$user_info = $this->login->get($_SESSION['user_id']);
		$this->title .= '::' . $user_info['name'];
		$this->content = $this->Template('v/u_info.php', array('username' => $user_info['name'], 'userlogin' => $user_info['login']));
	}
	
	public function action_reg() {
		
		$this->title .= 'Регистрация';
		$this->content = $this->Template('v/v_registration.php', array());

		if($this->isPost()) {
			$result = $this->login->newR($_POST['name'], $_POST['login'], $_POST['password']);
				$this->content = $this->Template('v/v_registration.php', array('text' => $result));

		}
	}

	public function action_login() {
		$this->title .= '::Вход';
		$this->content = $this->Template('v/v_auth.php', array());

		if($this->isPost()) {
			$result = $this->login->login($_POST['login'], $_POST['password']);
			$this->content = $this->Template('v/v_auth.php', array('text' => $result));
			
		}
	}

	public function action_logout() {
		$this->login->logout();
	}
}