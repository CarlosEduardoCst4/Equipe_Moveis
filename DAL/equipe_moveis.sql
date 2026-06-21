-- ============================================================
-- Banco de dados: equipe_moveis
-- Sistema de Gerenciamento de Estoque - Móveis Planejados
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `equipe_moveis`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE `equipe_moveis`;

-- --------------------------------------------------------
-- Tabela: usuario
-- --------------------------------------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id`    INT(11)      NOT NULL,
  `nome`  VARCHAR(35)  NOT NULL,
  `login` VARCHAR(30)  NOT NULL,
  `senha` VARCHAR(32)  NOT NULL        -- MD5 sempre gera 32 chars
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabela: categoria
-- --------------------------------------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id`        INT(11)     NOT NULL,
  `descricao` VARCHAR(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabela: fornecedor
-- --------------------------------------------------------
DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE `fornecedor` (
  `id`       INT(11)     NOT NULL,
  `nome`     VARCHAR(35) NOT NULL,
  `cnpj`     VARCHAR(18) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `email`    VARCHAR(50) NOT NULL,
  `cidade`   VARCHAR(35) NOT NULL,
  `uf`       VARCHAR(2)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabela: produto
-- --------------------------------------------------------
DROP TABLE IF EXISTS `produto`;
CREATE TABLE `produto` (
  `id`             INT(11)        NOT NULL,
  `descricao`      VARCHAR(60)    NOT NULL,
  `id_fornecedor`  INT(11)        NOT NULL,
  `id_categoria`   INT(11)        NOT NULL,
  `preco_custo`    DECIMAL(10,2)  NOT NULL,
  `preco_venda`    DECIMAL(10,2)  NOT NULL,
  `estoque_atual`  INT(11)        NOT NULL DEFAULT 0,
  `estoque_minimo` INT(11)        NOT NULL DEFAULT 0,
  `ativo`          TINYINT(1)     NOT NULL DEFAULT 1  -- 1=ativo, 0=inativo
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabela: movel
-- --------------------------------------------------------
DROP TABLE IF EXISTS `movel`;
CREATE TABLE `movel` (
  `id`            INT(11)        NOT NULL,
  `descricao`     VARCHAR(60)    NOT NULL,
  `id_categoria`  INT(11)        NOT NULL,
  `preco_venda`   DECIMAL(10,2)  NOT NULL,
  `data_cadastro` DATE           NOT NULL,
  `observacao`    VARCHAR(255)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabela: movel_item
-- --------------------------------------------------------
DROP TABLE IF EXISTS `movel_item`;
CREATE TABLE `movel_item` (
  `id`         INT(11) NOT NULL,
  `id_movel`   INT(11) NOT NULL,
  `id_produto` INT(11) NOT NULL,
  `quantidade` INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabela: nota_fiscal
-- --------------------------------------------------------
DROP TABLE IF EXISTS `nota_fiscal`;
CREATE TABLE `nota_fiscal` (
  `id`            INT(11)        NOT NULL,
  `numero_nota`   INT(11)        NOT NULL,
  `data_emissao`  DATE           NOT NULL,
  `nome_cliente`  VARCHAR(100)   NOT NULL,
  `valor_total`   DECIMAL(10,2)  NOT NULL,
  `observacao`    VARCHAR(255)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabela: nota_fiscal_item
-- --------------------------------------------------------
DROP TABLE IF EXISTS `nota_fiscal_item`;
CREATE TABLE `nota_fiscal_item` (
  `id`             INT(11)        NOT NULL,
  `id_nota`        INT(11)        NOT NULL,
  `id_movel`       INT(11)        NOT NULL,
  `quantidade`     INT(11)        NOT NULL,
  `preco_unitario` DECIMAL(10,2)  NOT NULL,
  `subtotal`       DECIMAL(10,2)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- PRIMARY KEYS
-- ============================================================
ALTER TABLE `usuario`         ADD PRIMARY KEY (`id`);
ALTER TABLE `categoria`       ADD PRIMARY KEY (`id`);
ALTER TABLE `fornecedor`      ADD PRIMARY KEY (`id`);
ALTER TABLE `produto`         ADD PRIMARY KEY (`id`);
ALTER TABLE `movel`           ADD PRIMARY KEY (`id`);
ALTER TABLE `movel_item`      ADD PRIMARY KEY (`id`);
ALTER TABLE `nota_fiscal`     ADD PRIMARY KEY (`id`);
ALTER TABLE `nota_fiscal_item` ADD PRIMARY KEY (`id`);

-- ============================================================
-- ÍNDICES para as FKs
-- ============================================================
ALTER TABLE `produto`          ADD KEY `fk_prod_fornecedor` (`id_fornecedor`);
ALTER TABLE `produto`          ADD KEY `fk_prod_categoria`  (`id_categoria`);
ALTER TABLE `movel`            ADD KEY `fk_mov_categoria`   (`id_categoria`);
ALTER TABLE `movel_item`       ADD KEY `fk_movitem_movel`   (`id_movel`);
ALTER TABLE `movel_item`       ADD KEY `fk_movitem_produto` (`id_produto`);
ALTER TABLE `nota_fiscal_item` ADD KEY `fk_nfitem_nota`     (`id_nota`);
ALTER TABLE `nota_fiscal_item` ADD KEY `fk_nfitem_movel`    (`id_movel`);

-- ============================================================
-- AUTO_INCREMENT
-- ============================================================
ALTER TABLE `usuario`          MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `categoria`        MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `fornecedor`       MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `produto`          MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `movel`            MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `movel_item`       MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `nota_fiscal`      MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `nota_fiscal_item` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

-- ============================================================
-- CHAVES ESTRANGEIRAS
-- ============================================================
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_prod_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prod_categoria`  FOREIGN KEY (`id_categoria`)  REFERENCES `categoria`  (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `movel`
  ADD CONSTRAINT `fk_mov_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `movel_item`
  ADD CONSTRAINT `fk_movitem_movel`   FOREIGN KEY (`id_movel`)   REFERENCES `movel`   (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movitem_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `nota_fiscal_item`
  ADD CONSTRAINT `fk_nfitem_nota`  FOREIGN KEY (`id_nota`)  REFERENCES `nota_fiscal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nfitem_movel` FOREIGN KEY (`id_movel`) REFERENCES `movel`       (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- ============================================================
-- DADOS DE EXEMPLO
-- ============================================================

-- Usuário admin (senha: 1234 em MD5)
INSERT INTO `usuario` (`nome`, `login`, `senha`) VALUES
('Administrador', 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- Categorias
INSERT INTO `categoria` (`descricao`) VALUES
('Cozinha'),
('Quarto'),
('Sala'),
('Banheiro'),
('Escritório');

-- Fornecedores
INSERT INTO `fornecedor` (`nome`, `cnpj`, `telefone`, `email`, `cidade`, `uf`) VALUES
('Madeireira São Paulo',  '12.345.678/0001-99', '(11) 98765-4321', 'contato@madeireirasp.com.br',  'São Paulo',    'SP'),
('Ferragens Brasil',      '98.765.432/0001-11', '(18) 99999-1234', 'vendas@ferragensbrasil.com.br', 'Assis',        'SP'),
('MDF Distribuidora',     '45.678.901/0001-22', '(11) 91234-5678', 'mdf@distribuidora.com.br',      'Campinas',     'SP');

-- Produtos
INSERT INTO `produto` (`descricao`, `id_fornecedor`, `id_categoria`, `preco_custo`, `preco_venda`, `estoque_atual`, `estoque_minimo`, `ativo`) VALUES
('MDF 15mm Branco 1,83x2,75m',  1, 1, 120.00, 180.00, 50, 10, 1),
('MDF 18mm Carvalho 1,83x2,75m',1, 2,  95.00, 140.00, 30,  5, 1),
('Dobradiça 35mm',              2, 1,   2.50,   5.00, 200, 50, 1),
('Corrediça 45cm telescópica',  2, 1,  18.00,  30.00, 100, 20, 1),
('Puxador Inox 128mm',          2, 3,  12.00,  22.00,  80, 15, 1);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;