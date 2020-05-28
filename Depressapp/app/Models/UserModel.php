<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'cod_user';
    protected $returnType = 'App\Entities\User';
    protected $allowedFields = ['login', 'password_user', 'last_acess', 'last_reply'];
    protected $useTimestamps = false;

}