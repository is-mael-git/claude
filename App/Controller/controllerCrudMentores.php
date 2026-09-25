<?php

namespace Controller;

use Core\controller;
use Model\usuario;
use Model\usuarioMentor;

class controllerCrudMentores extends controller
{
    public function index()
    {
        $this->mostrarTela("crudMentores");
    }

    public function adicionar()
    {
        if (
            empty($_POST['nome']) ||
            empty($_POST['email']) ||
            empty($_POST['telefone']) ||
            empty($_POST['biografia'])
        ) {
            die('Por favor, preencha todos os campos obrigatórios.');
        }

        $dados = [
            'foto'        => $_POST['foto'],
            'banner'      => $_POST['banner'],
            'nome'        => $_POST['nome'],
            'email'       => $_POST['email'],
            'telefone'    => $_POST['telefone'],
            'biografia'   => $_POST['biografia'],
            'linkedin'    => $_POST['linkedin'] ?? '',
            'instagram'   => $_POST['instagram'] ?? '',
            'id_parceiro' => $_POST['id_parceiro'] ?? null,
            'semana'      => $_POST['semana'] ?? [],
            'horario'     => $_POST['horario'] ?? '',
            'modalidade'  => $_POST['modalidade'] ?? '',
            'competencia' => $_POST['competencia'] ?? []
        ];
    
    usuarioMentor::cadastrarMentor($dados);
    
    header("Location: " . BASE_URL . "crudMentores");
    exit();
    }
}
