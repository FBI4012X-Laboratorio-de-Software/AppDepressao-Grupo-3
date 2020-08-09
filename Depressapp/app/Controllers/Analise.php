<?php namespace App\Controllers;

include "Base.php";

class PerguntaAnalise{

}
class OpcoesAnalise{

}

class Analise extends BaseController{

	public function index()
	{
		return view('Analise/index');
    }
    
    public function View()
	{
        $questionHistoryModel = new \App\Models\QuestionHistoryModel();
        $questionModel = new \App\Models\MainQuestionsModel();
        $questionItensModel = new \App\Models\QuestionItensModel();
        // $perguntas = $questionModel->join('QuestionItens', 'MainQuestions.cod_question = QuestionItens.cod_question','inner')->findAll(); 
        $perguntas = $questionModel->orderBy('question_type','ASC')->findAll(); 
        $lista = [];


        foreach ($perguntas as $pergunta) {
            $item = new PerguntaAnalise();
            $item->question_desc = $pergunta->question_desc;
            $item->question_symp = $pergunta->question_symp;
            $item->options = [];

            $questionItens = $questionItensModel->where('cod_question',$pergunta->cod_question)->findAll();

            foreach ($questionItens as $qItem) {
                $option = new OpcoesAnalise();

                $option->question_item_desc = $qItem->question_item_desc;
                $history = $questionHistoryModel->where('cod_question_item',$qItem->cod_question_item);
                try {
                    $option->reply_total = $history->countAllResults();
                    $option->justification_list = $history->asArray()->where('cod_question_item',$qItem->cod_question_item)->where('justification !=', null)->select('justification')->findAll();
                    $option->reply_list = $history->asArray()->where('cod_question_item',$qItem->cod_question_item)->where('reply_text !=', null)->select('reply_text')->findAll();
    
                } catch (\Throwable $th) {
                    $option->reply_total = 0;
                    $option->justification_list = null;
                    $option->reply_list = null;
                }
              
                array_push($item->options, $option);
            }

           
            
            array_push($lista, $item);
        }

        $data["lista"]= $lista;

		return view('Analise/View',$data);
    }
    


    public function ExportExcel(){

        $filename = "Analise_de_dados.xls";



        $questionModel = new \App\Models\MainQuestionsModel();

        $perguntas = $questionModel->join('QuestionItens', 'MainQuestions.cod_question = QuestionItens.cod_question', 'inner')
                                          ->join('QuestionHistory', 'QuestionItens.cod_question_item = QuestionHistory.cod_question_item','left')
                                          ->groupBy("QuestionItens.cod_question_item, QuestionHistory.reply_text, QuestionHistory.justification")
                                          ->select('QuestionItens.cod_question_item, 
                                                    QuestionItens.cod_question,
                                                    QuestionHistory.reply_text,
                                                    QuestionHistory.justification,
                                                    QuestionItens.question_item_desc,
                                                    MainQuestions.question_desc,
                                                    MainQuestions.question_type,
                                                    MainQuestions.question_symp,
                                                    count(QuestionHistory.cod_question_item) as Total
                                                   '
                                                  )
                                          ->orderBy('MainQuestions.question_type, MainQuestions.cod_question, MainQuestions.question_desc ', 'asc')
                                          ->asArray()
                                          ->findAll(); 

        $data = [];


        foreach ($perguntas as $item) {

            $sintoma_pergunta = "";
            $tipo_pergunta = "";

            switch ($item['question_symp']) {
                case null:
                    $sintoma_pergunta = "";
                break;
                case \App\Models\QuestionSymp::depressao:
                    $sintoma_pergunta = 'Depressão';
                break;
                case \App\Models\QuestionSymp::ansiedade:
                    $sintoma_pergunta = 'Ansiedade';
                break;
                case \App\Models\QuestionSymp::stress:
                    $sintoma_pergunta = 'Stress';
                break;
            }


           

            switch ($item['question_type']) {
                case null:
                    $tipo_pergunta = "";
                break;
                case \App\Models\QuestionType::socio_demografico:
                    $tipo_pergunta = 'Socio-Demografico';
                break;
                case \App\Models\QuestionType::auto_avaliacao:
                    $tipo_pergunta = 'Auto-Avaliacao';
                break;
                case \App\Models\QuestionType::contexto_academico:
                    $tipo_pergunta = 'Contexto Academico';
                break;
            }

            array_push($data, 
                [
                    "Pergunta" => $item['question_desc'],
                    "Tipo de Pergunta" => $tipo_pergunta,
                    "Sintoma da Pergunta" => $sintoma_pergunta,
                    "Opção" => $item['question_item_desc'],
                    "Resposta Descritiva" => $item['reply_text'],
                    "Justificativa" => $item['reply_text'],
                    "Total de Respotas" => $item['Total'],

                ]
            );
        }

        $Export = new \App\Classes\ExportExcel();
        $response = $Export->to_xls($data, $filename);


        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile($filename);
        unlink($filename);
        
        
    }

   

	
}
