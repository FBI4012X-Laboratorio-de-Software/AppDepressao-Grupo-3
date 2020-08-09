<?php namespace App\Models;

use CodeIgniter\Model;

class QuestionHistoryModel extends Model
{
    protected $table = 'QuestionHistory';
    protected $primaryKey = 'cod_history';
    protected $returnType = 'App\Entities\QuestionHistory';
    protected $allowedFields = ['cod_question','cod_question_item','COD_USER','reply_date', 'replay_score','reply_text','justification'];
    protected $useTimestamps = false;

    public function getLastAnswerData($cod_user){
      return $this->where('cod_user',$cod_user)->orderBy('reply_date','desc')->limit(1)->first();
    }

}
