<?php namespace App\Controllers;

use \App\Models as Models;
class Perguntas extends BaseController
{
	public function index()
	{
		return view('Perguntas/index');
	}

	public function CarregarLista(){
		$perguntas = new Models\MainQuestionsModel();
		$data['ListaPerguntas'] = $perguntas->getQuestion();

		return view('Perguntas/_lista_perguntas',$data);
	}

	public function novaPerguntaModal(){
		return view('Perguntas/_novaPerguntaModal');
	} 

	public function Create(){
		$var = $this->request->getVar('item');
		$item = $decoded = json_decode($var, true);
		$lista_opcoes = $item['question_options'];




		$question = new \App\Entities\MainQuestions();
		$question->question_desc = $item['question_desc'];
		$question->question_type = $item['question_type'];
		$question->create_date = date('Y-m-d H:i:s');
		
		$questionModel = new \App\Models\MainQuestionsModel();

		if ($questionModel->save($question)) {
			$cod_question = $questionModel->insertID();
			$questionItemModel = new \App\Models\QuestionItensModel();
			foreach ($lista_opcoes as $opcao) {
				$questionItem = new \App\Entities\QuestionItens();
				$questionItem->cod_question = $cod_question;
				$questionItem->question_item_desc = $opcao['question_item_desc'];
				$questionItem->create_date = date('Y-m-d H:i:s');
				if($questionItemModel->save($questionItem)){

				}
				else{
					return serialize($questionItemModel->errors());
				}

			}

			return "true";
		} else {
			return serialize($questionModel->errors());
		 }


	





		
	}

}
