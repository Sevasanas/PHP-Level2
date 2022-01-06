<?php
//
// ����������� �������� ������.
//
include_once('m/M_User.php');

class C_User extends C_Base
{
	//
	// �����������.
	//
	
	public function action_auth(){
		$this-'>title .= '::�����������;
        $user = new M_User();
		$info = "������������ �� �����������";
        if($_POST){
            $login = $_POST['login'];
            $info = $user->auth("log","past"));
		    $this->content = $this->Template('v_auth.php', array('text' => $info));
		}
		else{
		   $this->content = $this->Template('v/v_auth.php');
		}


			
	}
	

}
