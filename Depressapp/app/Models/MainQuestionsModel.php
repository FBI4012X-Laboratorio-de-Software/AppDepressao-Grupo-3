<?php namespace App\Models;

use CodeIgniter\Model;

class MainQuestionsModel extends Model
{
    protected $table = 'MainQuestions';
    protected $primaryKey = 'cod_question';
    protected $returnType = 'App\Entities\MainQuestions';
    protected $allowedFields = ['question_desc', 'question_type', 'create_date'];
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

}