<?php

$router->adicionar(
    "POST",
    "/notificacoes/visualizar",
    "controllerMenuLateral@marcarTodasComoVisualizadas"
);

// rota pra resetar o valor do visualizado no banco
$router->adicionar(
    "POST",
    "/notificacoes/resetar",
    "controllerMenuLateral@resetarVisualizacao"
);


//rotas crud parceiros

$router->adicionar("POST", "/parceiros/adicionar", "controllerParceiros@adicionar");
$router->adicionar("POST", "/parceiros/atualizar", "controllerParceiros@atualizar");
$router->adicionar("POST", "/parceiros/status", "controllerParceiros@status");
$router->adicionar("GET", "/parceiros/index", "controllerParceiros@index");
$router->adicionar("GET", "/parceiros/cards", "controllerParceiros@cards");
$router->adicionar("GET", "/parceiros/tabela", "controllerParceiros@tabela");
$router->adicionar("GET", "/parceiros/buscar", "controllerParceiros@buscar");

//rotas crud mentores

$router->adicionar("GET", "/mentores/index", "controllerCrudMentores@index");

//rotas crud startups

$router->adicionar("GET", "/startups/index", "controllerStartups@index");
$router->adicionar("POST", "/startups/adicionar", "controllerStartups@adicionar");
$router->adicionar("GET", "/startups/buscar", "controllerStartups@buscar");
$router->adicionar("POST", "/startups/atualizar", "controllerStartups@atualizar");
$router->adicionar("POST", "/startups/deletar", "controllerStartups@deletar");
$router->adicionar("GET", "/startups/listar", "controllerStartups@listar");

//rotas area trabalho adm

$router->adicionar("GET", "/areaTrabalho/adm", "controllerAreaTrabalhoAdm@index");

//rota area de trabalho mentor

$router->adicionar("GET", "/areaTrabalhoMentor/index", "controllerAreaTrabalhoMentor@index");
$router->adicionar("GET", "/areaTrabalhoMentor/tabela", "controllerAreaTrabalhoMentor@tabela");

//rota equipe + novo perfil

$router->adicionar("GET", "/equipe/index", "controllerEquipe@index");


//teste

$router->adicionar("GET", "/componentes/botao", "controllerTesteComponentes@botao");

// ------------------ Login ------------------
$router->adicionar('GET', '/', 'controllerAuth@loginForm');
$router->adicionar('GET', '/login', 'controllerAuth@loginForm');
$router->adicionar('POST', '/login', 'controllerAuth@login');
$router->adicionar('POST', '/logout', 'controllerAuth@logout');

//rotas Questionario
$router->adicionar("GET", "/questionario/index", "controllerQuestionario@index");
$router->adicionar("GET", "/questionario/tabela", "controllerQuestionario@tabela");
$router->adicionar("POST", "/questionario/adicionar", "controllerQuestionario@cadastrar");
$router->adicionar("GET", "/questionario/buscar", "controllerQuestionario@buscar");
$router->adicionar("GET", "/questionario/fazer", "controllerQuestionario@fazer");
$router->adicionar("POST", "/questionario/atualizar", "controllerQuestionario@atualizar");
$router->adicionar("POST", "/questionario/status", "controllerQuestionario@alterarStatus");

//rotas Questao
$router->adicionar("GET", "/questao/index", "controllerQuestao@index");
$router->adicionar("GET", "/questao/listar", "controllerQuestao@listar");
$router->adicionar("GET", "/questao/tabela", "controllerQuestao@listar");
$router->adicionar("POST", "/questao/adicionar", "controllerQuestao@cadastrar");
$router->adicionar("GET", "/questao/buscar", "controllerQuestao@buscar");
$router->adicionar("POST", "/questao/atualizar", "controllerQuestao@atualizar");
$router->adicionar("POST", "/questao/status", "controllerQuestao@alterarStatus");
