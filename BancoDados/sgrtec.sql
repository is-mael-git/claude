CREATE DATABASE sgrtec;
USE sgrtec;

CREATE TABLE IF NOT EXISTS `usuario_termo` (
	`id_usuario` INTEGER NOT NULL,
    `id_termo` INTEGER NOT NULL,
     PRIMARY KEY (`id_usuario`, `id_termo`)
);

CREATE TABLE IF NOT EXISTS `mentor_competencia` (
    `id_mentor` INTEGER NOT NULL,
    `id_competencia` INTEGER NOT NULL,
     PRIMARY KEY (`id_mentor`, `id_competencia`)
);

CREATE TABLE IF NOT EXISTS `termo` (
	`id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`nome` VARCHAR(50) NOT NULL UNIQUE,
    `local` VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS `area_atuacao` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS `parceiros` (
	`id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`foto` VARCHAR(255) NOT NULL,
	`nome` VARCHAR(100) NOT NULL UNIQUE,
	`cnpj` VARCHAR(14) NOT NULL UNIQUE,
	`telefone` VARCHAR(20) NOT NULL,
	`site` VARCHAR(255),
    `id_area_atuacao` INTEGER NOT NULL,
	`instagram` VARCHAR(255),
	`linkedin` VARCHAR(255),
    `ativo` BOOLEAN NOT NULL DEFAULT TRUE,


    `nome_representante` VARCHAR(100) NOT NULL,
    `telefone_representante` VARCHAR(20) NOT NULL,
    `cargo_representante` VARCHAR(100) NOT NULL,
    `email_representante` VARCHAR(320) NOT NULL,
    FOREIGN KEY (`id_area_atuacao`) REFERENCES `area_atuacao` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE IF NOT EXISTS `startups` (
    `id_startup`              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nome_startup`            VARCHAR(150)      NOT NULL,
    `email_startup`           VARCHAR(150)      NOT NULL,
    `telefone_startup`        VARCHAR(20)       NULL,
    `cnpj`                    VARCHAR(14)       NOT NULL,
    `endereco`                VARCHAR(255)      NULL,
    `site`                    VARCHAR(255)      NULL,
    `instagram`               VARCHAR(100)      NULL,
    `linkedin`                VARCHAR(255)      NULL,
    `participacao_programas`  VARCHAR(255)      NULL,
    `setor_atuacao`           VARCHAR(50)       NULL,
    `data_fundacao`           DATE              NULL,
    `estagio_atual`           TINYINT UNSIGNED  NOT NULL DEFAULT 1,
    `foto_startup`             VARCHAR(255)      NULL,
    `ativo`                    TINYINT(1)        NOT NULL DEFAULT 1,
    `id_questionario`          VARCHAR(50)       NULL,
    `criado_em`                TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_startups_cnpj (cnpj)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `fundadores` (
    `id_fundador`            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `id_startup`             INT UNSIGNED NOT NULL,
    `ordem`                  TINYINT UNSIGNED NOT NULL DEFAULT 1,
    `nome_fundador`          VARCHAR(150) NOT NULL,
    `cpf_fundador`           VARCHAR(11)  NULL,
    `cargo_fundador`        VARCHAR(100) NULL,
    `email_fundador`        VARCHAR(150) NULL,
    `telefone_fundador`     VARCHAR(20)  NULL,
    `participacao_fundador` VARCHAR(50)  NULL,
    FOREIGN KEY (`id_startup`) REFERENCES `startups`(`id_startup`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `fundador` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `telefone` VARCHAR(20) NOT NULL,
    `cargo` VARCHAR(100) NOT NULL,
    `id_usuario` INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS `mentor` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `foto` VARCHAR(255) NOT NULL,
    `banner` VARCHAR(255),
    `telefone` VARCHAR(20) NOT NULL,
    `linkedin` VARCHAR(255) NOT NULL,
    `instagram` VARCHAR(255) NOT NULL,
    `biografia` VARCHAR(500) NOT NULL,
    `id_usuario` INTEGER NOT NULL,
    `ativo` BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE IF NOT EXISTS `mentor_mentora_startup` (
    `id_mentor` INTEGER NOT NULL,
    `id_startup` INTEGER NOT NULL,
    PRIMARY KEY (`id_mentor`, `id_startup`)
);

CREATE TABLE IF NOT EXISTS `disponibilidade` (
    `id_mentor` INTEGER NOT NULL,
    `id_semana` INTEGER NOT NULL,
    `id_horario` INTEGER NOT NULL,
    `id_modalidade` INTEGER NOT NULL,
     PRIMARY KEY (`id_mentor`, `id_semana`, `id_horario`, `id_modalidade`)
);

CREATE TABLE IF NOT EXISTS `semana` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `domingo` BOOLEAN NOT NULL DEFAULT FALSE,
    `segunda` BOOLEAN NOT NULL DEFAULT FALSE,
    `terca` BOOLEAN NOT NULL DEFAULT FALSE,
    `quarta` BOOLEAN NOT NULL DEFAULT FALSE,
    `quinta` BOOLEAN NOT NULL DEFAULT FALSE,
    `sexta` BOOLEAN NOT NULL DEFAULT FALSE,
    `sabado` BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS `horario` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `matutino` BOOLEAN NOT NULL DEFAULT FALSE,
    `vespertino` BOOLEAN NOT NULL DEFAULT FALSE,
    `noturno` BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS `modalidade` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `presencial` BOOLEAN NOT NULL DEFAULT FALSE,
    `remoto` BOOLEAN NOT NULL DEFAULT FALSE,
    `hibrido` BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS `staff` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_disponibilidade` INTEGER NOT NULL,
    `id_usuario` INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS `usuario` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(320) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    `cpf` VARCHAR(11) UNIQUE,
    `ativo` BOOLEAN NOT NULL DEFAULT TRUE,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `id_perfil` INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS `perfil` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS `perfil_permissao` (
    `id_perfil` INTEGER NOT NULL,
    `id_permissao` INTEGER NOT NULL,
    PRIMARY KEY (`id_perfil`, `id_permissao`)
);

CREATE TABLE IF NOT EXISTS `permissao` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS `competencia` (
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE `eixo_cerne` (
  `id` int(11) NOT NULL,
  `id_competencia` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  CONSTRAINT fk_eixo_competencia
  FOREIGN KEY (id_competencia)
  REFERENCES competencia(id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
);

CREATE TABLE IF NOT EXISTS `questao` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `pergunta` VARCHAR(500) NOT NULL,
    `id_competencia` INT NOT NULL,
    `ativo` TINYINT(1) NOT NULL DEFAULT 1,

    FOREIGN KEY (`id_competencia`)
        REFERENCES `competencia` (`id`)
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `questionario` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `ativo` TINYINT(1) NOT NULL DEFAULT 0,
    `descricao` VARCHAR(500) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS `questionario_questao` (
    `id_questionario` INT NOT NULL,
    `id_questao` INT NOT NULL,
    `ordem` TINYINT NOT NULL,

    PRIMARY KEY (`id_questionario`, `id_questao`),

    UNIQUE (`id_questionario`, `ordem`),

    CHECK (`ordem` BETWEEN 1 AND 50),

    FOREIGN KEY (`id_questionario`)
        REFERENCES `questionario` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (`id_questao`)
        REFERENCES `questao` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `resposta_questionario` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_questionario` INT NOT NULL,
    `id_questao` INT NOT NULL,
    `id_usuario` INT NOT NULL,
    `resposta` TINYINT NOT NULL,

    CHECK (`resposta` BETWEEN 0 AND 4),

    FOREIGN KEY (`id_questionario`)
        REFERENCES `questionario` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (`id_questao`)
        REFERENCES `questao` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (`id_usuario`)
        REFERENCES `usuario` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS notificacoes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    mentoria_id INT DEFAULT NULL,

    titulo VARCHAR(150) NOT NULL,
    mensagem TEXT NOT NULL,
    tipo VARCHAR(50) NOT NULL,

    criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS notificacoes_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,

    notificacao_id INT UNSIGNED NOT NULL,
    usuario_id INT NOT NULL,

    visualizada BOOLEAN NOT NULL DEFAULT FALSE,
    visualizada_em DATETIME DEFAULT NULL,

    UNIQUE KEY ( notificacao_id, usuario_id ),

    FOREIGN KEY (notificacao_id)
        REFERENCES notificacoes(id)
        ON DELETE CASCADE,

    FOREIGN KEY (usuario_id)
        REFERENCES usuario(id)
        ON DELETE CASCADE
);

ALTER TABLE `mentor_competencia`
ADD FOREIGN KEY (`id_mentor`) REFERENCES `mentor` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `mentor_competencia`
ADD FOREIGN KEY (`id_competencia`) REFERENCES `competencia` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `disponibilidade`
ADD FOREIGN KEY (`id_mentor`) REFERENCES `mentor` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `disponibilidade`
ADD FOREIGN KEY (`id_semana`) REFERENCES `semana` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `disponibilidade`
ADD FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `disponibilidade`
ADD FOREIGN KEY (`id_modalidade`) REFERENCES `modalidade` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

-- ALTER TABLE `startups`
-- ADD FOREIGN KEY (`id_fundador`) REFERENCES `fundador` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `mentor_mentora_startup`
ADD FOREIGN KEY (`id_mentor`) REFERENCES `mentor` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

-- ALTER TABLE `mentor_mentora_startup`
-- ADD FOREIGN KEY (`id_startup`) REFERENCES `startups` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `usuario_termo`
ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `usuario_termo`
ADD FOREIGN KEY (`id_termo`) REFERENCES `termo` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `mentor`
ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `staff`
ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `usuario`
ADD FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `perfil_permissao`
ADD FOREIGN KEY (`id_permissao`) REFERENCES `permissao` (`id`) ON UPDATE NO ACTION ON DELETE RESTRICT;

ALTER TABLE `perfil_permissao`
ADD FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;
/* Não pode apagar caso algum perfil de acesso esteja usando a permissão */

ALTER TABLE `fundador`
ADD FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

INSERT INTO perfil(nome) VALUES('adm');
INSERT INTO perfil(nome) VALUES('mentor');
	
INSERT INTO usuario (nome, cpf, email, senha, ativo, id_perfil) VALUES ('alencar', '12345678901', 'alencar@gmail.com', '210000$25831e120611829ebfb27515be6ea8d2$c7f9a6e58b72288767ff82270915546bb3bc97003bcb9e26c96799c78f65e4cd', 1, 1);
INSERT INTO usuario (nome, cpf, email, senha, ativo, id_perfil) VALUES ('ada', '12345678902', 'ada@gmail.com', '210000$25831e120611829ebfb27515be6ea8d2$c7f9a6e58b72288767ff82270915546bb3bc97003bcb9e26c96799c78f65e4cd', 1, 2);

INSERT INTO termo (nome, local) VALUES ('Termo de voluntariado', 'a');
INSERT INTO termo (nome, local) VALUES ('Autorização de uso de imagem', 'b');
INSERT INTO termo (nome, local) VALUES ('Termo LGPD', 'c');

INSERT INTO usuario_termo (id_usuario, id_termo) VALUES (2,1);
INSERT INTO usuario_termo (id_usuario, id_termo) VALUES (2,2);
INSERT INTO usuario_termo (id_usuario, id_termo) VALUES (2,3);

INSERT INTO mentor (foto, telefone, linkedin, instagram, biografia, id_usuario, ativo) VALUES ('nada',556799999999,'nada','nada', 'Gosto muito de água critalina', 2, 1);

INSERT INTO competencia(nome) VALUES('Estratégia');
INSERT INTO competencia(nome) VALUES('Mercado e Clientes');
INSERT INTO competencia(nome) VALUES('Produto e Tecnologia');
INSERT INTO competencia(nome) VALUES('Marketing e Vendas');
INSERT INTO competencia(nome) VALUES('Operações');
INSERT INTO competencia(nome) VALUES('Finanças');
INSERT INTO competencia(nome) VALUES('Capital e Investimentos');
INSERT INTO competencia(nome) VALUES('Juridico e PI');
INSERT INTO competencia(nome) VALUES('Pessoas e Cultura');
INSERT INTO competencia(nome) VALUES('Networking e Conexões');

INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,1);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,2);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,3);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,4);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,5);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,6);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,7);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,8);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,9);
INSERT INTO mentor_competencia(id_mentor, id_competencia) VALUES (1,10);

INSERT INTO semana(domingo, segunda, terca, quarta, quinta, sexta, sabado) VALUES (1,1,1,1,1,1,1);

INSERT INTO horario(matutino,vespertino, noturno) VALUES(1,1,1);

INSERT INTO modalidade(presencial, remoto, hibrido) VALUES(1,0,0);

INSERT INTO disponibilidade(id_mentor, id_semana, id_horario, id_modalidade) VALUES (1,1,1,1);

INSERT INTO notificacoes (
    mentoria_id,
    titulo,
    mensagem,
    tipo
) VALUES
(
    NULL,
    'Mentoria designada',
    'Você foi relacionado a uma nova mentoria.',
    'mentoria_designada'
),
(
    NULL,
    'Reunião pendente',
    'Você ainda não marcou a reunião dentro do prazo.',
    'reuniao_pendente'
),
(
    NULL,
    'Aviso de reunião',
    'Sua reunião está próxima.',
    'aviso_reuniao'
);
 
INSERT INTO `notificacoes_usuario` (
    `notificacao_id`,
    `usuario_id`
) VALUES
    (1, 1),
    (2, 1),
    (3, 1);
 

 INSERT INTO `eixo_cerne` (`id`, `id_competencia`, `nome`) VALUES
(1, 9, 'Empreendedor'),
(2, 1, 'Empreendedor'),
(3, 3, 'Tecnologia'),
(4, 5, 'Tecnologia'),
(5, 6, 'Capital'),
(6, 7, 'Capital'),
(7, 2, 'Mercado'),
(8, 4, 'Mercado'),
(9, 10, 'Mercado'),
(10, 1, 'Gestão'),
(11, 8, 'Gestão');