<?php

namespace Models;

use Core\model;
use PDO;

class notificacoes extends model
{
    public static function buscarPorUsuario(int $usuarioId): array
    {
        $stmt = parent::pegarBanco()->prepare("
        SELECT
            n.id,
            n.mentoria_id,
            n.titulo,
            n.mensagem,
            n.tipo,
            n.criado_em,
            nu.visualizada,
            nu.visualizada_em
        FROM notificacoes_usuario nu
        INNER JOIN notificacoes n
            ON n.id = nu.notificacao_id
        WHERE nu.usuario_id = :usuario_id
        ORDER BY n.criado_em DESC
        ");

        $stmt->execute([
            'usuario_id' => $usuarioId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function marcarTodasComoVisualizadas(int $usuarioId): bool
    {
        $stmt = parent::pegarBanco()->prepare("
        UPDATE notificacoes_usuario
        SET
            visualizada = 1,
            visualizada_em = NOW()
        WHERE usuario_id = :usuario_id
        AND visualizada = 0
    ");

        return $stmt->execute([
            'usuario_id' => $usuarioId
        ]);
    }



// provisório vibe codada ela só reseta a visualizada de 1 pra = 0
    public static function resetarVisualizacao(int $usuarioId): bool
    {
        $stmt = parent::pegarBanco()->prepare("
        UPDATE notificacoes_usuario
        SET
            visualizada = 0,
            visualizada_em = NULL
        WHERE usuario_id = :usuario_id
    ");

        return $stmt->execute([
            'usuario_id' => $usuarioId
        ]);
    }
}
