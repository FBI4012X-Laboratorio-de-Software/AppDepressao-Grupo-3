<?php namespace App\Controllers;

include "Base.php";

use \App\Models as Models;
class Perguntas extends BaseController{

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
		$cod_question = $this->request->getVar('cod_question');
		if($cod_question != NULL){
			$questionModel = new \App\Models\MainQuestionsModel();
			$question = $questionModel->find($cod_question);
			$data['question'] = $question;

			$questionItemModel = new \App\Models\QuestionItensModel();
			$questionItemList = $questionItemModel->where('cod_question', $cod_question)->findColumn('question_item_desc');
			$data['questionItemList'] = \json_encode($questionItemList);

			return view('Perguntas/_novaPerguntaModal',$data);

		}


		return view('Perguntas/_novaPerguntaModal');
	}

	public function Create(){
		$var = $this->request->getVar('item');
		$item = json_decode($var, true);


		$question = new \App\Entities\MainQuestions();
		$question->question_desc = $item['question_desc'];
		$question->question_type = $item['question_type'];
		$question->question_mode = $item['question_mode'];
		$question->question_symp = isset($item['question_symp'])? $item['question_symp'] : NULL;
		$question->create_date = date('Y-m-d H:i:s');

		$has_justification = $item['has_justi'];
		$question->has_justification = $has_justification;

		if($has_justification){
			$question->justification = $item['justi'];
		}


		$questionModel = new \App\Models\MainQuestionsModel();

		if ($questionModel->save($question)) {
			$cod_question = $questionModel->insertID();
			$questionItemModel = new \App\Models\QuestionItensModel();

			switch($question->question_mode){
				case \App\Models\QuestionMode::descritiva:
					$questionItem = new \App\Entities\QuestionItens();
					$questionItem->cod_question = $cod_question;
					$questionItem->question_item_desc = "";
					$questionItem->create_date = date('Y-m-d H:i:s');
					if($questionItemModel->save($questionItem)){

					}
					else{
						return serialize($questionItemModel->errors());
					}
				break;

				default:
					$lista_opcoes = $item['question_options'];
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
				break;

			}




			return "true";
		} else {
			return serialize($questionModel->errors());
		 }

	}


	public function Update(){
		$var = $this->request->getVar('item');
		$cod_question = $this->request->getVar('cod_question');

		$item = $decoded = json_decode($var, true);


		$questionModel = new \App\Models\MainQuestionsModel();


		$question = $questionModel->find($cod_question);
		$question->question_desc = $item['question_desc'];
		$question->question_type = $item['question_type'];
		$question->question_mode = $item['question_mode'];
		$question->question_symp = isset($item['question_symp']) ? $item['question_symp'] : NULL;
		$question->create_date = date('Y-m-d H:i:s');


		$question->justification = NULL;
		$has_justification = $item['has_justi'];
		$question->has_justification = $has_justification;

		if($has_justification){
			$question->justification = $item['justi'];
		}

		if ($questionModel->save($question)) {

			//AO SALVAR AS OPÇÃO, ESTÁ SENDO REMOVIDO TODAS AS OPÇÕES DA PERGUNTA, E RE-INSERINDO-AS NO BANCO,
			//ALTERAR ISSO PARA EVITAR PERDA DE DADOS!
			$questionHistoryModel = new \App\Models\QuestionHistoryModel();
			$questionHistoryModel->where('cod_question', $cod_question)->delete();

			$questionItemModel = new \App\Models\QuestionItensModel();
			$questionItemModel->where('cod_question', $cod_question)->delete();

			switch($question->question_mode){
				case \App\Models\QuestionMode::descritiva:
					$questionItem = new \App\Entities\QuestionItens();
					$questionItem->cod_question = $cod_question;
					$questionItem->question_item_desc = "";
					$questionItem->create_date = date('Y-m-d H:i:s');
					if($questionItemModel->save($questionItem)){

					}
					else{
						return serialize($questionItemModel->errors());
					}
				break;

				default:
					$lista_opcoes = $item['question_options'];
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
				break;

			}

			return "true";
		} else {
			return serialize($questionModel->errors());
		 }

	}

	public function Delete(){

		$cod_question = $this->request->getVar('cod_question');

		$questionHistoryModel = new \App\Models\QuestionHistoryModel();
		$questionHistoryModel->where('cod_question', $cod_question)->delete();

		$questionItemModel = new \App\Models\QuestionItensModel();
		$questionItemModel->where('cod_question', $cod_question)->delete();

		$questionModel = new \App\Models\MainQuestionsModel();
		$questionModel->where('cod_question', $cod_question)->delete();

		return \json_encode("true");


	}

}
