-- Criação da tabela materiais conforme o formulário do arquivo index.html
CREATE TABLE materiais (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    quantidade INT(11) NOT NULL,
    descricao TEXT,
    preco_unitario DECIMAL(10, 2) NOT NULL,
    data_cadastro DATE
);

-- Inserindo os primeiros dados para testar, o resto pode ser feito manualmente
INSERT INTO materiais (nome, quantidade, descricao, preco_unitario, data_cadastro)
VALUES ('Processador Intel Core i7', 10, 'Processador de última geração', 1500.00, '2024-03-28'),
       ('Memória RAM DDR4 8GB', 50, 'Memória para desktop', 300.00, '2024-03-28'),
       ('SSD 500GB', 20, 'Unidade de armazenamento SSD', 400.00, '2024-03-28');
