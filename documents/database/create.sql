CREATE TABLE usuario(
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    senha VARCHAR(150) NOT NULL,
    status BOOLEAN NOT NULL DEFAULT TRUE,
    cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario)
);


CREATE TABLE token(
  id_token INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  token TEXT NOT NULL,
  ip VARCHAR(100) NOT NULL,
  data_expira TIMESTAMP NOT NULL,
  data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_token),
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);


CREATE TABLE produto(
    id_produto INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT NULL DEFAULT NULL,
    descricao_curta TEXT NULL DEFAULT NULL,
    valor DOUBLE NOT NULL DEFAULT 0,
    PRIMARY KEY (id_produto)
);


CREATE TABLE imagem(
    id_imagem INT NOT NULL AUTO_INCREMENT,
    id_produto INT NOT NULL,
    imagem VARCHAR(150) NOT NULL,
    principal BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id_imagem),
    FOREIGN KEY (id_produto) REFERENCES produto(id_produto)
);


