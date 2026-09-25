<?php

namespace Models;

use Core\bancoDados;
use Throwable;

class questao
{

    public static function listarEixos(): array
    {
        $db = bancoDados::conectar();

        $stmt = $db->query("
            SELECT
                MIN(id_competencia) AS id_competencia,
                nome
            FROM (
                SELECT
                    MIN(id_competencia) AS id_competencia,
                    MIN(nome) AS nome
                FROM eixo_cerne
                GROUP BY id_competencia
            ) eixos_por_competencia
            GROUP BY nome
            ORDER BY nome ASC
        ");

        return $stmt->fetchAll(
            \PDO::FETCH_ASSOC
        );
    }


    public static function listar(): array
    {
        $db = bancoDados::conectar();

        $sql = "
        SELECT
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

        ORDER BY q.id DESC
    ";

        $stmt = $db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(
            \PDO::FETCH_ASSOC
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CADASTRAR QUESTÃO
    |--------------------------------------------------------------------------
    */

    public static function cadastrar(
        string $pergunta,
        int $idCompetencia
    ): int {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            INSERT INTO questao (
                pergunta,
                id_competencia,
                ativo
            ) VALUES (
                :pergunta,
                :id_competencia,
                1
            )
        ");

        $stmt->execute([
            'pergunta' => $pergunta,
            'id_competencia' => $idCompetencia
        ]);

        return (int) $db->lastInsertId();
    }



    public static function cadastrarVarias(
        array $questoes
    ): array {
        $db = bancoDados::conectar();

        if (empty($questoes)) {
            throw new \InvalidArgumentException(
                'Nenhuma questão foi enviada.'
            );
        }

        $idsCriados = [];

        try {

            $db->beginTransaction();


            $stmt = $db->prepare("
            INSERT INTO questao (
                pergunta,
                id_competencia,
                ativo
            ) VALUES (
                :pergunta,
                :id_competencia,
                1
            )
        ");


            foreach ($questoes as $indice => $questao) {

                $numeroQuestao = $indice + 1;


                if (!is_array($questao)) {

                    throw new \InvalidArgumentException(
                        "Questão {$numeroQuestao} inválida."
                    );
                }


                $pergunta = trim(
                    (string) ($questao['pergunta'] ?? '')
                );


                if ($pergunta === '') {

                    throw new \InvalidArgumentException(
                        "A questão {$numeroQuestao} não possui pergunta."
                    );
                }


                if (mb_strlen($pergunta) > 500) {

                    throw new \InvalidArgumentException(
                        "A questão {$numeroQuestao} ultrapassa 500 caracteres."
                    );
                }


                $idCompetencia = filter_var(
                    $questao['id_competencia'] ?? null,
                    FILTER_VALIDATE_INT
                );


                if (
                    $idCompetencia === false ||
                    $idCompetencia <= 0
                ) {

                    throw new \InvalidArgumentException(
                        "A competência da questão {$numeroQuestao} é inválida."
                    );
                }


                $stmt->execute([
                    'pergunta' => $pergunta,
                    'id_competencia' => $idCompetencia
                ]);


                $idsCriados[] =
                    (int) $db->lastInsertId();
            }


            $db->commit();

            return $idsCriados;
        } catch (Throwable $erro) {

            if ($db->inTransaction()) {

                $db->rollBack();
            }

            throw $erro;
        }
    }


    public static function buscarPorId(
        int $id
    ): ?array {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            SELECT
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

            WHERE q.id = :id

            GROUP BY
                q.id,
                q.pergunta,
                q.id_competencia,
                q.ativo,
                c.nome

            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);


        $questao = $stmt->fetch(
            \PDO::FETCH_ASSOC
        );


        return $questao ?: null;
    }


    public static function atualizar(
        int $id,
        string $pergunta,
        int $idCompetencia
    ): bool {
        $db = bancoDados::conectar();

        $stmt = $db->prepare("
            UPDATE questao

            SET
                pergunta = :pergunta,
                id_competencia = :id_competencia

            WHERE id = :id
        ");

        return $stmt->execute([
            'pergunta' => $pergunta,
            'id_competencia' => $idCompetencia,
            'id' => $id
        ]);
    }


    public static function alterarStatus(
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
}
