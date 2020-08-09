<?php namespace App\Controllers;

include "Base.php";

use \App\Models as Models;

class Admin extends BaseController{

	public function index()
	{
		return view('Admin/index');
	}

	public function editar_termo(){

		$consent_form = new Models\ConsentFormModel();

		$consent_text_db['consent_text'] = $consent_form->RetornarTexto();

		if($this->request->getMethod() == 'post'){
			$consent_text['text'] = $this->request->getVar('text');

			$consent_form->Salvar($consent_text);

			return redirect()->to('/Admin/editar_termo');
		}

		return view('Admin/termo_consentimento', $consent_text_db);
	}

}
