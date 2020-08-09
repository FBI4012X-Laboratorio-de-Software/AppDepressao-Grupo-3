<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $table = 'User';
    protected $primaryKey = 'COD_USER';
    protected $returnType = 'App\Entities\User';
    protected $allowedFields = ['DES_EMAIL', 'DES_PASSWORD', 'last_acess', 'last_reply'];
    protected $useTimestamps = false;

	  public function RetornarUsuarioEmailSenha($email, $senha){

        return $this->where("DES_EMAIL", $email)
		                ->where("DES_PASSWORD", md5($senha))
                    ->first();
    }

    public function RetornarUsuarioCodigo($codigo){

        return $this->where('COD_USER',$codigo)->first();

    }

    public function ListaUsuarios(){

        $query = $this->db->table("User")->getWhere('TIP_STATUS = 1');

        return $query->getResultArray();
     }

    public function Salvar($usuario){

      $query = $this->where("TIP_STATUS", $usuario["TIP_STATUS"])->where("DES_EMAIL",$usuario['DES_EMAIL'])->first();
      $result = false;

		    if(!$query){
               $result = $this->db->table('User')->insert($usuario);
        }else{
               $result = $this->db->table("User")->set($usuario)->where('COD_USER', $usuario['COD_USER'])->update();
        }

        return $result;

	  }

    public function Remover($cod_user){
      $teste["TIP_STATUS"]=0;
      return $this->db->table('User')->where("COD_USER", intval($cod_user))->update($teste);
    }

}
