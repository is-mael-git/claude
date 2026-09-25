<?php

namespace Model;

use Core\bancoDados;

class equipe{
    public static function cadastrarEquipe(array $dados){
        $db = bancoDados::conectar();
        $usuario = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
            'cpf' => $_POST['cpf']
        ];

        $idUsuario = usuario::cadastro($usuario);
        $stmt = $db->prepare('INSERT INTO ');
        return $idUsuario;
    }



}


