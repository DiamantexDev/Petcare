# PetCare - Migração para PHP

Este projeto foi migrado de uma aplicação frontend estática para uma estrutura PHP organizada, segura e sustentável.

## Requisitos

- PHP 8.2+
- MySQL ou MariaDB
- Servidor web local ou PHP built-in server

## Estrutura do projeto

```text
petshop/
├── app/
│   ├── bootstrap
│   ├── config/
│   ├── controllers/
│   ├── helpers/
│   ├── middleware/
│   ├── models/
│   └── views/
├── database/
│   └── database.sql
├── public/
│   ├── index
│   ├── login
│   ├── cadastro
│   ├── logout
│   ├── contato
│   ├── sobre
│   ├── 403
│   ├── cliente/
│   └── funcionario/
├── assets/
├── css/
├── .env.example
├── .gitignore
├── README.md
└── package.json
```

## Configuração do banco

1. Crie um banco MySQL/MariaDB chamado `petshop`.
2. Copie o arquivo `.env.example` para `.env`.
3. Ajuste as credenciais:

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=petshop
DB_USER=root
DB_PASSWORD=
```

## Importação do banco

```bash
mysql -u root -p < database/database.sql
```

ou importe via phpMyAdmin ou outro cliente MySQL.

## Execução local

### Usando o servidor embutido do PHP

```bash
php -S localhost:8000 -t public
```

Em seguida, acesse:

- http://localhost:8000/
- http://localhost:8000/login
- http://localhost:8000/cadastro

## Autenticação e autorização

A autenticação foi migrada para PHP com sessões e `password_hash()`/`password_verify()`.

- Usuário cliente: acesso a páginas de cliente
- Usuário funcionário: acesso a páginas administrativas
- Usuários não autenticados: redirecionados para login
- Usuários com acesso indevido: redirecionados para 403

## Usuários de teste

O arquivo `database/database.sql` já inclui registros de exemplo com senhas compatíveis com `password_hash()`:

- Admin: `admin@petcare.com` / senha: `admin123`
- Cliente: `ana@cliente.com` / senha: `admin123`
- Cliente: `bruno@cliente.com` / senha: `admin123`

## Principais funcionalidades

- Cadastro de clientes
- Login com sessão PHP
- Gerenciamento de pets
- Agendamentos
- Consultas
- Gestão de serviços
- Painel administrativo
- Proteção por tipo de usuário
- Validação no servidor

## Segurança aplicada

- PDO com prepared statements
- password_hash e password_verify
- sessões PHP
- validações no backend
- escape de saída com `htmlspecialchars()`
- controle de acesso no servidor
- ausência de autenticação via localStorage

## Observação sobre a migração

A API Node.js antiga e o armazenamento de sessão em localStorage foram removidos da base de autenticação. A aplicação agora trabalha com PHP e banco de dados MySQL/MariaDB.
