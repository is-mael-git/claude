<?php

namespace Models;

use Core\bancoDados;
use Throwable;

class questionario
{
    public static function listar(): array
    {
        $db = bancoDados::conectar();

        $sql = "SELECT
            q.id,
            q.nome,
            q.descricao,
            q.ativo,
            COUNT(qq.id_questao) AS quantidade_questoes
        FROM questionario q

        LEFT JOIN questionario_questao qq
            ON qq.id_questionario = q.id

        GROUP BY
            q.id,
            q.nome,
            q.descricao,
            q.ativo

        ORDER BY q.id DESC";

        $stmt = $db->query($sql);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function listarQuestoes(): array
    {
        $db = bancoDados::conectar();

        $sql = "SELECT
            q.id,
            q.pergunta,
            q.id_competencia,
            q.ativo,
            c.nome AS competencia,

            MIN(ec.nome) AS eixos

        FROM questao q

        INNER JOIN competencia c
            ON c.id = q.id_competencia

        LEFT JOIN eixo_cerne ec
            ON ec.id_competencia = c.id

        GROUP BY
            q.id,
            q.pergunta,
            q.id_competencia,
            q.ativo,
            c.nome

        ORDER BY q.id ASC";

        $stmt = $db->query($sql);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function cadastrar(
        string $nome,
        string $descricao,
        array $questoes
    ): int {
        $db = bancoDados::conectar();

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("
                INSERT INTO questionario (
                    nome,
                    descricao,
                    ativo
                ) VALUES (
                    :nome,
                    :descricao,
                    0
                )
            ");

            $stmt->execute([
                'nome' => $nome,
                'descricao' => $descricao
            ]);

            $questionarioId = (int) $db->lastInsertId();

            $stmtRelacao = $db->prepare("
                INSERT INTO questionario_questao (
                    id_questionario,
                    id_questao,
                    ordem
                ) VALUES (
                    :id_questionario,
                    :id_questao,
                    :ordem
                )
            ");

            foreach ($questoes as $indice => $questaoId) {

                $stmtRelacao->execute([
                    'id_questionario' => $questionarioId,
                    'id_questao' => (int) $questaoId,
                    'ordem' => $indice + 1
                ]);
            }

            $db->commit();

            return $questionarioId;

        } catch (Throwable $erro) {

            if ($db->inTransaction()) {
                $db->rollBack();
            }

            throw $erro;
        }
    }


    public static function buscarPorId(int $id): ?array
    {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            SELECT
                id,
                nome,
                descricao,
                ativo
            FROM questionario
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $questionario = $stmt->fetch(
            \PDO::FETCH_ASSOC
        );

        if (!$questionario) {
            return null;
        }


        $stmtQuestoes = $db->prepare("
            SELECT
                id_questao
            FROM questionario_questao
            WHERE id_questionario = :id
            ORDER BY ordem ASC
        ");

        $stmtQuestoes->execute([
            'id' => $id
        ]);

        $questionario['questoes'] =
            $stmtQuestoes->fetchAll(
                \PDO::FETCH_COLUMN
            );

        return $questionario;
    }


    public static function buscarParaResponder(int $id): ?array
    {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            SELECT
                id,
                nome,
                descricao,
                ativo
            FROM questionario
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $questionario = $stmt->fetch(
            \PDO::FETCH_ASSOC
        );

        if (!$questionario) {
            return null;
        }

        $stmtQuestoes = $db->prepare("
            SELECT
                q.id,
                q.pergunta,
                q.id_competencia,
                c.nome AS competencia,
                MIN(ec.nome) AS eixos
            FROM questionario_questao qq

            INNER JOIN questao q
                ON q.id = qq.id_questao

            INNER JOIN competencia c
                ON c.id = q.id_competencia

            LEFT JOIN eixo_cerne ec
                ON ec.id_competencia = c.id

            WHERE qq.id_questionario = :id

            GROUP BY
                q.id,
                q.pergunta,
                q.id_competencia,
                c.nome,
                qq.ordem

            ORDER BY qq.ordem ASC
        ");

        $stmtQuestoes->execute([
            'id' => $id
        ]);

        $questionario['questoes'] =
            $stmtQuestoes->fetchAll(
                \PDO::FETCH_ASSOC
            );

        return $questionario;
    }


    public static function atualizar(
        int $id,
        string $nome,
        string $descricao,
        array $questoes
    ): bool {
        $db = bancoDados::conectar();

        try {

            $db->beginTransaction();


            $stmt = $db->prepare("
                UPDATE questionario
                SET
                    nome = :nome,
                    descricao = :descricao
                WHERE id = :id
            ");

            $stmt->execute([
                'nome' => $nome,
                'descricao' => $descricao,
                'id' => $id
            ]);


            $stmtExcluir = $db->prepare("
                DELETE FROM questionario_questao
                WHERE id_questionario = :id
            ");

            $stmtExcluir->execute([
                'id' => $id
            ]);


            $stmtRelacao = $db->prepare("
                INSERT INTO questionario_questao (
                    id_questionario,
                    id_questao,
                    ordem
                ) VALUES (
                    :id_questionario,
                    :id_questao,
                    :ordem
                )
            ");


            foreach ($questoes as $indice => $questaoId) {

                $stmtRelacao->execute([
                    'id_questionario' => $id,
                    'id_questao' => (int) $questaoId,
                    'ordem' => $indice + 1
                ]);
            }


            $db->commit();

            return true;

        } catch (Throwable $erro) {

            if ($db->inTransaction()) {
                $db->rollBack();
            }

            throw $erro;
        }
    }


    public static function alterarStatusQuestao(
        int $id,
        int $ativo
    ): bool {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            UPDATE questao
            SET ativo = :ativo
            WHERE id = :id
        ");

        return $stmt->execute([
            'ativo' => $ativo,
            'id' => $id
        ]);
    }


    public static function alterarStatus(
        int $id,
        int $ativo
    ): bool {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            UPDATE questionario
            SET ativo = :ativo
            WHERE id = :id
        ");

        return $stmt->execute([
            'ativo' => $ativo,
            'id' => $id
        ]);
    }
}
