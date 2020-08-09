<?php namespace App\Models;

use CodeIgniter\Model;

class MainQuestionsModel extends Model
{
    protected $table = 'MainQuestions';
    protected $primaryKey = 'cod_question';
    protected $returnType = 'App\Entities\MainQuestions';
    protected $allowedFields = ['cod_question','question_desc', 'question_type', 'create_date', 'question_mode', 'question_symp', 'has_justification', 'justification'];
    protected $useTimestamps = false;
    


    public function getQuestion($cod_question = false)
    {
        if ($cod_question === false)
        {
            return $this->findAll();
        }
    
        return $this->find(cod_question);
    }
}

abstract class QuestionType
{
    const socio_demografico = 0;
    const auto_avaliacao = 1;
    const contexto_academico = 2;

}

abstract class QuestionMode
{
    const unica_escolha = 0;
    const multipla_escolha = 1;
    const descritiva = 2;

}

abstract class QuestionSymp
{
    const depressao = 0;
    const ansiedade = 1;
    const stress = 2;

}