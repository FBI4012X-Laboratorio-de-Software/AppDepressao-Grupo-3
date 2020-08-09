<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsentFormModel extends Model {

    protected $table = 'ConsentForm';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\ConsentForm';
    protected $allowedFields = ['text'];
    protected $useTimestamps = false;

	  public function RetornarTexto(){

        return $this->where('id',1)->first();

    }

    public function Salvar($consent_text){

        return $this->db->table("ConsentForm")->set($consent_text)->where('id',1)->update();

	  }

}
