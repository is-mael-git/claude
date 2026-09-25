<?php

namespace Controller;

use Core\controller;
use Core\validador;
use Models\startups;
use PDOException;
// teste
class controllerStartups extends controller
{
    private const MAPA_ESTAGIO = [
        'ideacao'      => 1,
        'mvp'          => 2,
        'tracao'       => 3,
        'escala'       => 4,
        'consolidacao' => 5,
    ];

    public function index()
    {
        $startups = startups::listar();

        $this->mostrarTela("crudStartups", [
            'startups' => $startups,
        ]);
    }

    public function adicionar()
    {
        if (!validador::required($_POST['startupName'] ?? null)
            || !validador::email($_POST['email'] ?? null)
            || !validador::required($_POST['cnpj'] ?? null)
        ) {
            http_response_code(422);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['sucesso' => false, 'erro' => 'Preencha nome, e-mail e CNPJ corretamente.']);
            return;
        }

        $dados = $this->prepararDados($_POST);
        $dados['foto_startup'] = $this->processarUploadFoto();

        $id = startups::cadastrar($dados);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['sucesso' => true, 'id_startup' => $id]);
    }

    public function atualizar()
    {
        $id = (int) ($_POST['id_startup'] ?? 0);

        if ($id <= 0
            || !validador::required($_POST['startupName'] ?? null)
            || !validador::email($_POST['email'] ?? null)
            || !validador::required($_POST['cnpj'] ?? null)
        ) {
            http_response_code(422);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos.']);
            return;
        }

        $dados = $this->prepararDados($_POST);

        // Sem upload novo, mantém a foto que a startup já tinha em vez de
        // zerar (mesmo comportamento de antes, só que centralizado aqui).
        $novaFoto = $this->processarUploadFoto();
        $dados['foto_startup'] = $novaFoto ?? (startups::buscarPorId($id)['foto_startup'] ?? null);

        $ok = startups::atualizar($id, $dados);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['sucesso' => $ok]);
    }

    public function buscar()
    {
        $id = (int) ($_GET['id'] ?? 0);

        header('Content-Type: application/json; charset=utf-8');

        if ($id <= 0) {
            http_response_code(422);
            echo json_encode(['sucesso' => false, 'erro' => 'ID inválido.']);
            return;
        }

        $startup = startups::buscarPorId($id);

        if (!$startup) {
            http_response_code(404);
            echo json_encode(['sucesso' => false, 'erro' => 'Startup não encontrada.']);
            return;
        }

        echo json_encode(['sucesso' => true, 'startup' => $startup]);
    }

    public function deletar()
    {
        $id = (int) ($_POST['id'] ?? $_GET['id'] ?? 0);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['sucesso' => startups::deletar($id)]);
    }

    private function prepararDados(array $post): array
    {
        return [
            'nome_startup'           => trim($post['startupName']),
            'email_startup'          => trim($post['email']),
            'cnpj'                   => preg_replace('/\D/', '', $post['cnpj']),
            'telefone_startup'       => preg_replace('/\D/', '', $post['phone'] ?? ''),
            'endereco'               => trim($post['address'] ?? '') ?: null,
            'participacao_programas' => trim($post['programs'] ?? '') ?: null,
            'setor_atuacao'          => $post['sector'] ?? '',
            'data_fundacao'          => (!empty($post['foundDay']) && !empty($post['foundMonth']) && !empty($post['foundYear']))
                ? sprintf('%04d-%02d-%02d', $post['foundYear'], $post['foundMonth'], $post['foundDay'])
                : null,
            'estagio_atual'          => self::MAPA_ESTAGIO[$post['stage'] ?? ''] ?? self::MAPA_ESTAGIO['ideacao'],
            'id_questionario'        => trim($post['questionnaire'] ?? '') ?: null,
        ];
    }

    private function processarUploadFoto(): ?string
    {
        if (empty($_FILES['foto_startup']['tmp_name'])) {
            return null;
        }

        $pasta = __DIR__ . '/../Public/Assets/startups/';
        if (!is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }

        $nomeArquivo = uniqid('startup_') . '_' . basename($_FILES['foto_startup']['name']);

        return move_uploaded_file($_FILES['foto_startup']['tmp_name'], $pasta . $nomeArquivo)
            ? 'Assets/startups/' . $nomeArquivo
            : null;
    }
}