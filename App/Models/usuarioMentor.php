<?php

namespace Model;

use Core\bancoDados;

use PDO;

class usuarioMentor
{
    public static function cadastrarMentor($dados)
    {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            INSERT INTO mentor (
                foto,
                banner,
                nome,
                email,
                telefone,
                linkedin,
                instagram,
                id_parceiro,
                biografia
            ) VALUES (
                :foto,
                :banner,
                :nome,
                :email,
                :telefone,
                :linkedin,
                :instagram,
                :id_parceiro,
                :biografia
            )
        ");

        $stmt->execute([
            'foto'        => $dados['foto'],
            'banner'      => $dados['banner'],
            'nome'        => $dados['nome'],
            'email'       => $dados['email'],
            'telefone'    => $dados['telefone'],
            'linkedin'    => $dados['linkedin'],
            'instagram'   => $dados['instagram'],
            'id_parceiro' => $dados['id_parceiro'],
            'biografia'   => $dados['biografia']
        ]);

        $idMentor = $db->lastInsertId();

        return $idMentor;
    }
}
