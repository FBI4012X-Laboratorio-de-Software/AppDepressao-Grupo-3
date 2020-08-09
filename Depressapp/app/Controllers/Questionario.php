<?php namespace App\Controllers;

include "Base.php";

use \App\Models as Models;
use \App\Classes as Classes;
class Questionario extends BaseController{

	public function index()
	{

		return view('Questionario/index');
	}

	public function Resultados(){

		//$cod_user = $this->request->getVar('cod_user');

		$questionHistoryModel = new \App\Models\QuestionHistoryModel();


		$perguntas_respondidas = $questionHistoryModel->join('QuestionItens','QuestionHistory.cod_question_item = QuestionItens.cod_question_item', 'inner')->join('MainQuestions','QuestionHistory.cod_question=MainQuestions.cod_question', 'inner')->where('MainQuestions.question_type',1)->findAll();


		$total_depressao = 0;
		$total_ansiedade = 0;
		$total_stress = 0;

		$lista_depressao = array_filter($perguntas_respondidas, function($item){
			$return_list = [];
			if($item->question_symp == 0)
				array_push($return_list,$item);
			return $return_list;

		 });


		foreach ($lista_depressao as $item) {
			if(isset($item) && is_numeric($item->question_item_desc))
				$total_depressao += $item->question_item_desc;
		}

/////////////////////////////////////////////////////////////////////////////


		$lista_ansiedade= array_filter($perguntas_respondidas, function($item){
			$return_list = [];
			if($item->question_symp == 1)
				array_push($return_list,$item);
			return $return_list;

		 });


		foreach ($lista_ansiedade as $item) {
			if(isset($item) && is_numeric($item->question_item_desc))
				$total_ansiedade += $item->question_item_desc;
		}

////////////////////////////////////////////////////////////////////////////

		$lista_stress= array_filter($perguntas_respondidas, function($item){
			$return_list = [];
			if($item->question_symp == 2)
				array_push($return_list,$item);
			return $return_list;

		 });


		foreach ($lista_stress as $item) {
			if(isset($item) && is_numeric($item->question_item_desc))
				$total_stress += $item->question_item_desc;
		}


		$data["total_depressao"]= $total_depressao;
		$data["total_ansiedade"]= $total_ansiedade;
		$data["total_stress"]= $total_stress;



		return view('Questionario/Resultados',$data);

	}


	public function QuestionarioContextoAcademico(){

		$perguntas = new Models\MainQuestionsModel();
		$list = $perguntas->where('question_type', \App\Models\QuestionType::contexto_academico)->findAll();
		$array = [];
		$index = 0;
		foreach ($list as $pergunta) {
		   $item = new Classes\ArrayQuestion();
		   $item->key = $pergunta->cod_question;
		   $item->index = $index;
		   $item->reply_text = NULL;
		   $item->justification = NULL;
		   $index += 1;
		   array_push($array,$item);
		}
	   $data["arrayPerguntas"] = \json_encode($array);

	   return view('Questionario/QuestionarioContextoAcademico',$data);
   }

	public function QuestionarioSocio(){

		 $perguntas = new Models\MainQuestionsModel();
		 $list = $perguntas->where('question_type', \App\Models\QuestionType::socio_demografico)->findAll();
		 $array = [];
		 $index = 0;
		 foreach ($list as $pergunta) {
			$item = new Classes\ArrayQuestion();
			$item->key = $pergunta->cod_question;
			$item->index = $index;
			$item->reply_text = NULL;
			$item->justification = NULL;
			$index += 1;
			array_push($array,$item);
		 }
		$data["arrayPerguntas"] = \json_encode($array);

		return view('Questionario/QuestionarioSocio',$data);
	}

	public function QuestionarioAutoAvaliativo(){

		$perguntas = new Models\MainQuestionsModel();
		$list = $perguntas->where('question_type', \App\Models\QuestionType::auto_avaliacao)->findAll();
		$array = [];
		$index = 0;
		foreach ($list as $pergunta) {
		   $item = new Classes\ArrayQuestion();
		   $item->key = $pergunta->cod_question;
		   $item->reply_text = NULL;
		   $item->justification = NULL;
		   $item->index = $index;
		   $index += 1;
		   array_push($array,$item);
		}
	   $data["arrayPerguntas"] = \json_encode($array);

	   return view('Questionario/QuestionarioAutoAvaliativo',$data);
   }



	public function loadPergunta(){

		$cod_question = $this->request->getVar('cod_question');
		$questionModel = new Models\MainQuestionsModel();

		$question = $questionModel->find($cod_question);


		$data["question"]= $question;


		$questionItemModel = new \App\Models\QuestionItensModel();
		$data["ListaOpcoes"] = $questionItemModel->where('cod_question', $cod_question)->findAll();



		return view('Questionario/_pergunta',$data);

	}

	public function SubmitQuestionario(){

		$var = $this->request->getVar('ListaRespostas');

		$ListaRespostas = json_decode($var, true);
		$questionHistoryModel = new \App\Models\QuestionHistoryModel();

			foreach ($ListaRespostas as $resposta) {
				$cod_question = $resposta['cod_question'];

				$questionHistory= new \App\Entities\QuestionHistory();

				$questionModel = new Models\MainQuestionsModel();


				$question = $questionModel->find($cod_question);

				$session = session();
				switch($question->question_mode){
					case \App\Models\QuestionMode::multipla_escolha:
						$respostas_selecionadas = $resposta['cod_question_item'];
						foreach($respostas_selecionadas as $cod_question_item){
							$questionHistory->cod_question = $cod_question;
							$questionHistory->cod_question_item = $cod_question_item;
							$questionHistory->justification = $resposta['justification'];
							$questionHistory->reply_date = date('Y-m-d H:i:s');
							$questionHistory->COD_USER = $session->get('cod_usuario');
							$questionHistory->replay_score = 0;
							$questionHistoryModel->save($questionHistory);
						}
					break;

					case \App\Models\QuestionMode::descritiva:
						$questionHistory->cod_question = $cod_question;
						$questionHistory->cod_question_item = $resposta['cod_question_item'];
						$questionHistory->justification = $resposta['justification'];
						$questionHistory->reply_date = date('Y-m-d H:i:s');
						$questionHistory->COD_USER = $session->get('cod_usuario');
						$questionHistory->replay_score = 0;
						$questionHistory->reply_text = $resposta['reply_text'];
						$questionHistoryModel->save($questionHistory);

					break;
					case \App\Models\QuestionMode::unica_escolha:
						$questionHistory->cod_question = $cod_question;
						$questionHistory->cod_question_item = $resposta['cod_question_item'];
						$questionHistory->reply_date = date('Y-m-d H:i:s');
						$questionHistory->justification = $resposta['justification'];
						$questionHistory->COD_USER = $session->get('cod_usuario');
						$questionHistory->replay_score = 0;
						$questionHistoryModel->save($questionHistory);

					break;

				}



			}
		return "true";


	}


}
