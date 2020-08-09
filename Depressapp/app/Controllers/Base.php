<?php namespace App\Controllers;

use \App\Models as Models;
use \App\Classes as Classes;

abstract class Base extends BaseController{

	protected $usuarioMaster;

	function __construct(){
	    parent::__construct();
	    if(!isset($_SESSION['usuarioLogado'])){
	        redirect("public/Account");
	    }else{
	        if($_SESSION['usuarioLogado']->TIP_ADMIN){
				$usuario = $this->usuarioMaster = true;
				$tip = $_SESSION['usuarioLogado']->TIP_ADMIN;
	        }else{
				$usuario = $this->usuarioMaster = false;
				$tip = $_SESSION['usuarioLogado']->TIP_ADMIN;
			}
		}

	}

}
