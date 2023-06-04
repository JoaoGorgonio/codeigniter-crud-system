CREATE DATABASE bd_sistema_cadastro;

CREATE TABLE tb_usuario (
  cd_usuario INT(11) AUTO_INCREMENT NOT NULL,
  nm_usuario VARCHAR(120) NOT NULL,
  cd_email VARCHAR(320) UNIQUE NOT NULL,
  cd_senha VARCHAR(255) NOT NULL,
  ic_admin TINYINT(1) NOT NULL DEFAULT 0,
  ic_ativo TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (cd_usuario)
);

INSERT INTO tb_usuario (nm_usuario, cd_email, cd_senha, ic_admin, ic_ativo)
VALUES ('Many Minds', 'teste@manyminds.com.br', '$2y$10$v1A03mh0fL6q9X8YIx4wNOi1UHTdvqfDo0LGyAKtFrlE8XDLNfpuG', 1, 1);


CREATE TABLE tb_endereco (
  cd_endereco INT(11) AUTO_INCREMENT NOT NULL, 
  cd_cep VARCHAR(9) NOT NULL,
  sg_uf CHAR(2) NOT NULL,
  nm_cidade VARCHAR(255) NOT NULL,
  nm_bairro VARCHAR(255) NOT NULL,
  nm_rua VARCHAR(255) NOT NULL,
  cd_rua VARCHAR(120) NOT NULL,
  ds_complemento LONGTEXT NULL,
  cd_usuario INT(11) NOT NULL,
  FOREIGN KEY (cd_usuario) REFERENCES tb_usuario(cd_usuario),
  PRIMARY KEY (cd_endereco)
);

INSERT INTO tb_endereco (cd_cep, sg_uf, nm_cidade, nm_bairro, nm_rua, cd_rua, ds_complemento, cd_usuario) 
VALUES ('11075-651', 'SP', 'Santos', 'Campo Grande', 'Rua João Carvalhal Filho', '1217', 'Apartamento 309', 1);

CREATE TABLE tb_falha_login (
  cd_falha_login INT(11) AUTO_INCREMENT NOT NULL,
  cd_ip VARCHAR(255) NOT NULL,
  dt_tentativa DATETIME NOT NULL,
  PRIMARY KEY (cd_falha_login)
);

CREATE TABLE tb_log (
  cd_log INT(11) AUTO_INCREMENT NOT NULL,
  dt_log DATE NOT NULL,
  hr_log TIME NOT NULL, 
  nm_tipo_log VARCHAR(255) NOT NULL,
  cd_usuario INT(11) NOT NULL,
  FOREIGN KEY (cd_usuario) REFERENCES tb_usuario(cd_usuario),
  PRIMARY KEY (cd_log)
);

CREATE TABLE tb_estado (
  sg_estado CHAR(2) NOT NULL,
  nm_estado VARCHAR(255) NOT NULL
);

INSERT INTO tb_estado (sg_estado, nm_estado) VALUES
('AC', 'Acre'),
('AL', 'Alagoas'),
('AP', 'Amapá'),
('AM', 'Amazonas'),
('BA', 'Bahia'),
('CE', 'Ceará'),
('DF', 'Distrito Federal'),
('ES', 'Espírito Santo'),
('GO', 'Goiás'),
('MA', 'Maranhão'),
('MT', 'Mato Grosso'),
('MS', 'Mato Grosso do Sul'),
('MG', 'Minas Gerais'),
('PA', 'Pará'),
('PB', 'Paraíba'),
('PR', 'Paraná'),
('PE', 'Pernambuco'),
('PI', 'Piauí'),
('RJ', 'Rio de Janeiro'),
('RN', 'Rio Grande do Norte'),
('RS', 'Rio Grande do Sul'),
('RO', 'Rondônia'),
('RR', 'Roraima'),
('SC', 'Santa Catarina'),
('SP', 'São Paulo'),
('SE', 'Sergipe'),
('TO', 'Tocantins');
