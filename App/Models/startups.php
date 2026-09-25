<?php

namespace Models;

use Core\bancoDados;

class startups
{
    public static function listar(): array
    {
        $pdo  = bancoDados::conectar();
        $stmt = $pdo->query('SELECT * FROM startups ORDER BY nome_startup ASC');

        return $stmt->fetchAll();
    }

    public static function buscarPorId(int $id): ?array
    {
        $pdo  = bancoDados::conectar();
        $stmt = $pdo->prepare('SELECT * FROM startups WHERE id_startup = :id');
        $stmt->execute(['id' => $id]);

        $startup = $stmt->fetch();

        return $startup ?: null;
    }

    public static function cadastrar(array $dados): int
    {
        $pdo = bancoDados::conectar();

        $stmt = $pdo->prepare('
            INSERT INTO startups (
                nome_startup, email_startup, telefone_startup, cnpj, endereco,
                participacao_programas, setor_atuacao, data_fundacao,
                estagio_atual, foto_startup, id_questionario
            ) VALUES (
                :nome_startup, :email_startup, :telefone_startup, :cnpj, :endereco,
                :participacao_programas, :setor_atuacao, :data_fundacao,
                :estagio_atual, :foto_startup, :id_questionario
            )
        ');

        $stmt->execute([
            'nome_startup'           => $dados['nome_startup'],
            'email_startup'          => $dados['email_startup'],
            'telefone_startup'       => $dados['telefone_startup'],
            'cnpj'                   => $dados['cnpj'],
            'endereco'               => $dados['endereco'] ?? null,
            'participacao_programas' => $dados['participacao_programas'] ?? null,
            'setor_atuacao'          => $dados['setor_atuacao'],
            'data_fundacao'          => $dados['data_fundacao'],
            'estagio_atual'          => $dados['estagio_atual'],
            'foto_startup'           => $dados['foto_startup'] ?? null,
            'id_questionario'        => $dados['id_questionario'] ?? null,
        ]);

        return (int) $pdo->lastInsertId();
    }

    public static function atualizar(int $id, array $dados): bool
    {
        $pdo = bancoDados::conectar();

        $stmt = $pdo->prepare('
            UPDATE startups SET
                nome_startup            = :nome_startup,
                email_startup           = :email_startup,
                telefone_startup        = :telefone_startup,
                cnpj                    = :cnpj,
                endereco                = :endereco,
                participacao_programas  = :participacao_programas,
                setor_atuacao           = :setor_atuacao,
                data_fundacao           = :data_fundacao,
                estagio_atual           = :estagio_atual,
                foto_startup            = :foto_startup,
                id_questionario         = :id_questionario
            WHERE id_startup = :id
        ');

        return $stmt->execute([
            'nome_startup'           => $dados['nome_startup'],
            'email_startup'          => $dados['email_startup'],
            'telefone_startup'       => $dados['telefone_startup'],
            'cnpj'                   => $dados['cnpj'],
            'endereco'               => $dados['endereco'] ?? null,
            'participacao_programas' => $dados['participacao_programas'] ?? null,
            'setor_atuacao'          => $dados['setor_atuacao'],
            'data_fundacao'          => $dados['data_fundacao'],
            'estagio_atual'          => $dados['estagio_atual'],
            'foto_startup'           => $dados['foto_startup'],
            'id_questionario'        => $dados['id_questionario'] ?? null,
            'id'                     => $id,
        ]);
    }

    public static function deletar(int $id): bool
    {
        $pdo  = bancoDados::conectar();
        $stmt = $pdo->prepare('DELETE FROM startups WHERE id_startup = :id');

        return $stmt->execute(['id' => $id]);
    }
}