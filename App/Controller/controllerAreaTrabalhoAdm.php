<?php
namespace Controller;

use Core\auth;
use Core\controller;

class controllerAreaTrabalhoAdm extends controller{
    public function index() : void{
        $this->mostrarTela("/areaTrabalhoAdm", [
            'usuario' => auth::usuario(),
            'sucesso' => auth::pegarFlash('sucesso')
        ]);
    }
}