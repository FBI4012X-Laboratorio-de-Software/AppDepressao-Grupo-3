<?php namespace App\Controllers;
use \App\Models as Models;
use \App\Classes as Classes;
class Questionario extends BaseController
{
	public function index()
	{
		
		return view('Questionario/index');
	}

	public function Resultados(){

		return view('Questionario/Resultados');

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
		$data["Descricao"]= $questionModel->find($cod_question)->question_desc; 

		
		$questionItemModel = new \App\Models\QuestionItensModel();
		$data["ListaOpcoes"] = $questionItemModel->where('cod_question', $cod_question)->findAll();
		

		return view('Questionario/_pergunta',$data);

	}

	public function SubmitQuestionario(){

		$var = $this->request->getVar('ListaRespostas');
		$ListaRespostas = json_decode($var, true);
		$questionHistoryModel = new \App\Models\QuestionHistoryModel();
		
			foreach ($ListaRespostas as $resposta) {
				$questionHistory= new \App\Entities\QuestionHistory();
				$questionHistory->cod_question = $resposta['cod_question'];
				$questionHistory->cod_question_item = $resposta['cod_question_item'];
				$questionHistory->reply_date = date('Y-m-d H:i:s');
				$questionHistory->cod_user = 1;
				$questionHistory->replay_score = 6;
				$questionHistoryModel->save($questionHistory);
				
			}
		return "true";


	}


}
