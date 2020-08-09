<?php namespace App\Controllers;

include "Base.php";

use \App\Models as Models;
use \Config\Services;

class Account extends BaseController
{

	public function index()
	{
		return view('login');
	}

	public function login(){
		$result = redirect()->to('/Account/index');

		$user = new Models\UserModel();

		if($this->request->getMethod() == 'post'){
			$email = $this->request->getVar('inputEmail');
			$senha = $this->request->getVar('inputPassword');

			$logged_user = $user->RetornarUsuarioEmailSenha($email, $senha);

			if ($logged_user){
				$session = \Config\Services::session();
				$session->set('usuario',$logged_user->DES_EMAIL);
				$session->set('cod_usuario',$logged_user->COD_USER);
				$session->set('nome_usuario',$logged_user->DES_USER);
				$result = redirect()->to('/Home');
			}
		}

		return $result;
	}

	public function logout(){
		$session = session();

		$session->destroy();
		return redirect()->to('/Account');
	}

}
