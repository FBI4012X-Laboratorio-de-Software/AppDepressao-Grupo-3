<?php namespace App\Models;

use CodeIgniter\Model;

class QuestionItensModel extends Model
{
    protected $table = 'QuestionItens';
    protected $primaryKey = 'cod_question_item';
    protected $returnType = 'App\Entities\QuestionItens';
    protected $allowedFields = ['cod_question','question_item_desc', 'create_date'];
    protected $useTimestamps = false;

}