CREATE DATABASE db_sportsmap;
USE db_sportsmap;
-- drop database db_sportsmap;

CREATE TABLE tb_esporte (
  id_esporte INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL UNIQUE,
  esporte_imagem VARCHAR(255)
);

INSERT INTO tb_esporte (nome, esporte_imagem)
VALUES
('Futebol', 'images/futebol.jpg'),
('Basquete', 'images/basquete.jpg'),
('Vôlei', 'images/volei.jpg'),
('Atletismo', 'images/atletismo.jpg'),
('Ciclismo', 'images/ciclismo.jpg'),
('Handebol', 'images/handebol.jpg'),
('Futsal', 'images/futsal.jpg'),
('Corrida', 'images/corrida.jpg');

CREATE TABLE tb_bairros (
    id_bairro INT AUTO_INCREMENT PRIMARY KEY,     
    nome VARCHAR(100) NOT NULL,                   
    cidade VARCHAR(100) NOT NULL,                 
    estado VARCHAR(50) NOT NULL,                  
    cep VARCHAR(10),                              
    descricao TEXT                                
);

CREATE TABLE tb_local (
    id_local INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    bairro INT, -- Agora referenciando o ID da tabela tb_bairros
    cidade VARCHAR(100),
    estado VARCHAR(50),
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    descricao TEXT,
    gratuito BOOLEAN,
    horario_funcionamento VARCHAR(255),
    contato VARCHAR(100),
    foto VARCHAR(255),
    FOREIGN KEY (bairro) REFERENCES tb_bairros(id_bairro) ON DELETE SET NULL
);

CREATE TABLE tb_local_esporte (
  id_local INT,
  id_esporte INT,
  PRIMARY KEY (id_local, id_esporte),
  FOREIGN KEY (id_local) REFERENCES tb_local(id_local) ON DELETE CASCADE,
  FOREIGN KEY (id_esporte) REFERENCES tb_esporte(id_esporte) ON DELETE CASCADE
);

CREATE TABLE tipo_usuario (
    id_tipo_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_tipo_usuario VARCHAR(50) NOT NULL
);

CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    id_tipo_usuario INT,
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuario(id_tipo_usuario)
);

create table cliente(
    id_cliente int(4) not null primary key auto_increment,
    nome char(40) not null,
    email char(80) not null,
    senha char(80) not null
) Engine = InnoDB;

CREATE TABLE eventos (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    nome_evento VARCHAR(100) NOT NULL,
    descricao TEXT,
    id_esporte INT,
    id_usuario INT,
    id_local INT,
    data DATE NOT NULL,
    hora TIME,
    FOREIGN KEY (id_esporte) REFERENCES tb_esporte(id_esporte),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_local) REFERENCES tb_local(id_local)
);

CREATE TABLE tb_favoritos (
    id_favorito INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,               -- ID do usuário que está favoritando
    id_local INT NOT NULL,                 -- ID do local favoritado
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_local) REFERENCES tb_local(id_local) ON DELETE CASCADE,
    UNIQUE (id_usuario, id_local)         -- Garante que um usuário pode favoritar um local apenas uma vez
);

INSERT INTO tb_bairros (nome, cidade, estado, cep)
VALUES
('Jardim América', 'São José dos Campos', 'SP', '12245-000' ),
('Jardim Satélite', 'São José dos Campos', 'SP', '12233-000'),
('Jardim Aquárius', 'São José dos Campos', 'SP', '12244-000');

INSERT INTO tb_local (nome, endereco, bairro, cidade, estado, latitude, longitude, descricao, gratuito, horario_funcionamento, contato, foto)
VALUES 
('Poliesportivo João Do Pulo', 
 'Av. Perseu, 180', 
 '2', 
 'São José dos Campos', 
 'SP', 
 -23.189847,  -- Latitude
 -45.898255,  -- Longitude
 'Quadra poliesportiva coberta, ideal para esportes como futebol, basquete e vôlei.',
 TRUE, 
 'Segunda a sexta: 7h às 22h', 
 '(12) 3456-7890', 
 'images/quadra-pulo1.jpg');
 
INSERT INTO tb_local (nome, endereco, bairro, cidade, estado, latitude, longitude, descricao, gratuito, horario_funcionamento, foto)
VALUES 
('Praça Riugi Kojima', 
 'R. Antônio Rodrigues Júnior, 114', 
 '3', 
 'São José dos Campos', 
 'SP', 
 -23.189847,  -- Latitude
 -45.898255,  -- Longitude
 'Quadra poliesportiva coberta, ideal para esportes como futebol, basquete e vôlei.',
 TRUE, 
 'Aberto 24h', 
 'images/praça-aquarius2.jpg');
 
INSERT INTO tb_local (nome, endereco, bairro, cidade, estado, latitude, longitude, descricao, gratuito, horario_funcionamento, foto)
VALUES 
('Quadra de basquete Aquárius', 
 'R. Benedito Osvaldo Lecques, 306', 
 '3', 
 'São José dos Campos', 
 'SP', 
 -23.189847,  -- Latitude
 -45.898255,  -- Longitude
 'Quadra de basquete, ideal para praticar esporte de basquete.',
 TRUE, 
 'Aberto 24h', 
 'images/quadra-aquarius-2.jpg');
 
 INSERT INTO tb_local (nome, endereco, bairro, cidade, estado, latitude, longitude, descricao, gratuito, horario_funcionamento, foto)
VALUES 
('Praça Ulisses Guimarães', 
 'Rua Dr. Tertuliano Delphim Júnior', 
 '3', 
 'São José dos Campos', 
 'SP', 
 -23.189847,  -- Latitude
 -45.898255,  -- Longitude
 'Praça perfeita para fazer uma caminhada e andar de bicicleta.',
 TRUE, 
 'Aberto 24h', 
 'images/praça-aquarius.jpg');
 
 INSERT INTO tb_local (nome, endereco, bairro, cidade, estado, latitude, longitude, descricao, gratuito, horario_funcionamento, foto)
VALUES 
('Centro da Juventude', 
 ' R. Aurora Pinto da Cunha, 131', 
 '1', 
 'São José dos Campos', 
 'SP', 
 -23.189847,  -- Latitude
 -45.898255,  -- Longitude
 'Quadra poliesportiva descoberta, ideal para esportes como futebol, basquete e vôlei.',
 TRUE, 
 'Aberto 24h', 
 'images/quadra-juventude1.jpg');

INSERT INTO tb_local_esporte (id_local, id_esporte)
VALUES 
(1, 1),  
(1, 2),  
(1, 3),
(2, 1),  
(2, 5),  
(2, 8),
(3, 2),  
(4, 1),  
(4, 5),
(4, 8),  
(5, 1),  
(5, 2);
 
 INSERT INTO tipo_usuario (nome_tipo_usuario) VALUES 
('Administrador'),
('Usuário');

INSERT INTO usuario (nome, email, senha, id_tipo_usuario) VALUES 
('Rivelino', 'rivelino@gmail.com', '123', 1);

INSERT INTO eventos (nome_evento, descricao, id_esporte, id_usuario, id_local, data, hora)
VALUES ('Futebol no Parque', 'Jogo amistoso de futebol no parque central', 1, 1, 1, '2025-05-01', '15:00:00');

INSERT INTO eventos (nome_evento, descricao, id_esporte, id_usuario, id_local, data, hora)
VALUES ('Basquete no Ginásio', 'Jogo amistoso de basquete no ginásio principal', 2, 1, 3, '2025-05-02', '18:00:00');

INSERT INTO eventos (nome_evento, descricao, id_esporte, id_usuario, id_local, data, hora)
VALUES ('Vôlei', 'Jogo de vôlei de quadra no clube', 3, 1, 1, '2025-05-03', '10:00:00');

INSERT INTO eventos (nome_evento, descricao, id_esporte, id_usuario, id_local, data, hora)
VALUES ('Futsal no Ginásio', 'Jogo de futsal no ginásio poliesportivo', 7, 1, 2, '2025-05-04', '18:30:00');

INSERT INTO eventos (nome_evento, descricao, id_esporte, id_usuario, id_local, data, hora)
VALUES ('Corrida no Parque', 'Corrida de rua no parque central', 8, 1, 2, '2025-05-05', '07:00:00');

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    qtd_estrela INT NOT NULL,
    mensagem VARCHAR(255) NULL,
    created DATETIME NOT NULL,
    modified DATETIME NULL
);









