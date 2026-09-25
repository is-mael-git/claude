<?php

namespace Models;

use Core\bancoDados;
use PDO;

class usuarioParceiros
{
    public static function cadastrarParceiro($dados)
    {
        $db = bancoDados::conectar();
        $stmt = $db->prepare('INSERT INTO parceiros (foto, nome, cnpj, telefone, site, id_area_atuacao, instagram, linkedin, nome_representante, telefone_representante, cargo_representante, email_representante)
        VALUES (:f, :n, :cnpj, :t, :s, :aa, :i, :l, :nr, :tr, :cr, :er) ');
        $stmt->execute([
            'f'     => $dados['foto'],
            'n'     => $dados['nome'],
            'cnpj'  => $dados['cnpj'],
            't'     => $dados['telefone'],
            's'     => $dados['site'],
            'aa'    => $dados['id_area_atuacao'],
            'i'     => $dados['instagram'],
            'l'     => $dados['linkedin'],
            'nr'    => $dados['nome_representante'],
            'tr'    => $dados['telefone_representante'],
            'cr'    => $dados['cargo_representante'],
            'er'    => $dados['email_representante']
            ]);
        return $db->lastInsertId();
    }
    public static function atualizarParceiro($dados, $id)
    {
        $db = bancoDados::conectar();
        $sql = "UPDATE parceiros SET
        foto = :f,
        nome = :n,
        cnpj = :cnpj,
        telefone = :t,
        site = :s,
        id_area_atuacao = :aa,
        instagram = :i,
        linkedin = :l,
        nome_representante = :nr,
        telefone_representante = :tr,
        cargo_representante = :cr,
        email_representante = :er
        WHERE id = :id";
        $parametros = [
            'id'    => $id,
            'f'     => $dados['foto'],
            'n'     => $dados['nome'],
            'cnpj'  => $dados['cnpj'],
            't'     => $dados['telefone'],
            's'     => $dados['site'],
            'aa'    => $dados['id_area_atuacao'],
            'i'     => $dados['instagram'],
            'l'     => $dados['linkedin'],
            'nr'    => $dados['nome_representante'],
            'tr'    => $dados['telefone_representante'],
            'cr'    => $dados['cargo_representante'],
            'er'    => $dados['email_representante']
        ];
        $stmt = $db->prepare($sql);
        return $stmt->execute($parametros);
    }

    public static function alterarStatus(int $id, bool $ativo): bool
    {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("UPDATE parceiros SET ativo = :ativo WHERE id = :id");

        return $stmt->execute([
            'ativo' => $ativo ? 1 : 0,
            'id'    => $id
        ]);
    }

    public static function buscarPorId($id): ?array
    {
        $db = bancoDados::conectar();

        $sql = "SELECT * FROM parceiros WHERE id = :id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $parceiro = $stmt->fetch();

        return $parceiro ?: null;
    }

    public static function listar(): array
    {
        $db = bancoDados::conectar();

        $sql = "SELECT
        p.*,
        a.nome AS area_nome
        FROM parceiros p
        INNER JOIN area_atuacao a ON a.id = p.id_area_atuacao";

        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }


    public static function cadastrarArea(string $nome): int
    {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("SELECT id FROM area_atuacao WHERE nome = :nome");
        $stmt->execute(['nome' => $nome]);
        $area = $stmt->fetch();

        if ($area) {
            return (int) $area['id'];
        }

        $stmt = $db->prepare("INSERT INTO area_atuacao (nome) VALUES (:nome)");
        $stmt->execute(['nome' => $nome]);

        return (int) $db->lastInsertId();
    }

    public static function listarAreas(): array
    {
        $db = bancoDados::conectar();

        $stmt = $db->query("SELECT id, nome FROM area_atuacao ORDER BY nome");

        return $stmt->fetchAll();
    }
}
