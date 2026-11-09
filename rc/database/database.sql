CREATE DATABASE IF NOT EXISTS petshop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE petshop;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    tipo ENUM('cliente', 'funcionario') NOT NULL,
    cpf VARCHAR(14) NULL,
    telefone VARCHAR(20) NULL,
    cargo VARCHAR(80) NULL,
    status ENUM('ativo', 'inativo') NOT NULL DEFAULT 'ativo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL UNIQUE,
    logradouro VARCHAR(150) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    bairro VARCHAR(80) NOT NULL,
    cidade VARCHAR(80) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    complemento VARCHAR(120) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_clientes_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL UNIQUE,
    cargo VARCHAR(80) NOT NULL,
    especialidade VARCHAR(120) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_funcionarios_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE pets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    raca VARCHAR(80) NULL,
    idade VARCHAR(20) NULL,
    peso VARCHAR(20) NULL,
    observacoes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_pets_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_pets_cliente (cliente_id)
);

CREATE TABLE servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    duracao_minutos INT NOT NULL DEFAULT 60,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE consultas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT NOT NULL,
    funcionario_id INT NULL,
    servico_id INT NULL,
    data_hora DATETIME NOT NULL,
    diagnostico TEXT NULL,
    observacoes TEXT NULL,
    status ENUM('agendada', 'realizada', 'cancelada') NOT NULL DEFAULT 'agendada',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_consultas_pet FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE,
    CONSTRAINT fk_consultas_funcionario FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id) ON DELETE SET NULL,
    CONSTRAINT fk_consultas_servico FOREIGN KEY (servico_id) REFERENCES servicos(id) ON DELETE SET NULL,
    INDEX idx_consultas_pet (pet_id),
    INDEX idx_consultas_data (data_hora)
);

CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    pet_id INT NOT NULL,
    servico_id INT NOT NULL,
    data_hora DATETIME NOT NULL,
    status ENUM('pendente', 'confirmado', 'cancelado', 'concluido') NOT NULL DEFAULT 'pendente',
    observacoes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_agendamentos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    CONSTRAINT fk_agendamentos_pet FOREIGN KEY (pet_id) REFERENCES pets(id) ON DELETE CASCADE,
    CONSTRAINT fk_agendamentos_servico FOREIGN KEY (servico_id) REFERENCES servicos(id) ON DELETE RESTRICT,
    INDEX idx_agendamentos_cliente (cliente_id),
    INDEX idx_agendamentos_data (data_hora)
);

INSERT INTO usuarios (nome, email, senha_hash, tipo, cpf, telefone, cargo, status) VALUES
('Administrador PetCare', 'admin@petcare.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3d.5j0F3AAV4dB9E4bP8d1u8W', 'funcionario', '12345678909', '(11) 98888-8888', 'Administrador', 'ativo'),
('Ana Silva', 'ana@cliente.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3d.5j0F3AAV4dB9E4bP8d1u8W', 'cliente', '11122233344', '(11) 99999-1111', NULL, 'ativo'),
('Bruno Santos', 'bruno@cliente.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3d.5j0F3AAV4dB9E4bP8d1u8W', 'cliente', '22233344455', '(11) 98888-2222', NULL, 'ativo');

INSERT INTO clientes (usuario_id, logradouro, numero, bairro, cidade, estado, cep, complemento) VALUES
(2, 'Rua das Flores', '123', 'Centro', 'São Paulo', 'SP', '01000-000', 'Casa 1'),
(3, 'Avenida Paulista', '456', 'Bela Vista', 'São Paulo', 'SP', '01310-100', NULL);

INSERT INTO funcionarios (usuario_id, cargo, especialidade) VALUES
(1, 'Administrador', 'Gestão e atendimento');

INSERT INTO pets (cliente_id, nome, tipo, raca, idade, peso, observacoes) VALUES
(1, 'Luna', 'Cachorro', 'Golden Retriever', '3 anos', '18 kg', 'Muito ativa e sociável'),
(2, 'Milo', 'Gato', 'Siamês', '2 anos', '4 kg', 'Cuidados especiais com alimentação');

INSERT INTO servicos (nome, descricao, preco, duracao_minutos, ativo) VALUES
('Banho & Tosa', 'Higienização completa com escovação e tosa', 120.00, 90, 1),
('Consulta Veterinária', 'Consulta clínica e avaliação do pet', 150.00, 60, 1),
('Vacinação', 'Aplicação de vacinas e acompanhamento', 140.00, 45, 1);

INSERT INTO consultas (pet_id, funcionario_id, servico_id, data_hora, diagnostico, observacoes, status) VALUES
(1, 1, 2, '2026-10-05 10:00:00', 'Sem alterações relevantes', 'Acompanhamento anual', 'agendada');

INSERT INTO agendamentos (cliente_id, pet_id, servico_id, data_hora, status, observacoes) VALUES
(1, 1, 1, '2026-10-06 09:00:00', 'pendente', 'Pet agitado, mas tranquilo'),
(2, 2, 3, '2026-10-07 14:30:00', 'confirmado', 'Vacina anual');
