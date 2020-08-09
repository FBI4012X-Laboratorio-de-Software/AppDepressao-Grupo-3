<?php namespace App\Controllers;

include "Base.php";

use \App\Models as Models;

class Home extends BaseController{

	public function index()
	{
		$session = session();
		if($session->get('cod_usuario') == NULL){
			return redirect()->to('/Account');
		}
		return view('Home/index');
	}

	public function novoQuestionarioModal(){
		return view('Home/_novoQuestionarioModal');
	}

	public function termosModal(){
		$consent_form = new Models\ConsentFormModel();

		$consent_text_db['consent_text'] = $consent_form->RetornarTexto();

		return view('Home/_termosModal', $consent_text_db);
	}

	public function info(){
		return view('Home/info');
	}

}
