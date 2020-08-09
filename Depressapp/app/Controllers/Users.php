<?php namespace App\Controllers;

include "Base.php";

use \App\Models as Models;
// use \Config\Services;

class Users extends BaseController
{

	public function index()
	{

		$usuarios = new Models\UserModel();

		$lista['usuarios'] = $usuarios->ListaUsuarios();

		return view('Users/users', $lista);

	}

  public function add_user(){

		$user = new Models\UserModel();


		if($this->request->getMethod() == 'post'){
			$usuario['DES_USER'] = $this->request->getVar('des_user');
			$usuario['DES_EMAIL'] = $this->request->getVar('des_email');
			$usuario['DES_PASSWORD'] = md5($this->request->getVar('des_password'));
			$usuario['TIP_MASTER'] = $this->request->getVar('tip_master');
			$usuario['TIP_STATUS'] = 1;

			if (strpos($usuario['DES_EMAIL'], '@ucs.br') !== false) {
			    $user->Salvar($usuario);
			}
			
			return redirect()->to('/Users');
		}

    return view('Users/cadastro');
  }

	public function edit_user($cod_user){

		$user = new Models\UserModel();

		$usuario_sel['usuario'] = $user->RetornarUsuarioCodigo($cod_user);

		if($this->request->getMethod() == 'post'){
			$usuario['COD_USER'] = $this->request->getVar('cod_user');
			$usuario['DES_USER'] = $this->request->getVar('des_user');
			$usuario['DES_EMAIL'] = $this->request->getVar('des_email');
			$usuario['DES_PASSWORD'] = md5($this->request->getVar('des_password'));
			$usuario['TIP_MASTER'] = $this->request->getVar('tip_master');
			$usuario['TIP_STATUS'] = 1;

			$user->Salvar($usuario);

			return redirect()->to('/Users');
		}

		return view('Users/cadastro', $usuario_sel);
	}

	public function delete_user($cod_user){
		$user = new Models\UserModel();

		$user->Remover($cod_user);

		return redirect()->to('/Users');
	}
}
