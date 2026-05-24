# PedeFlow PDV

Sistema PDV para delivery em PHP 8 + MySQL (XAMPP), sem Laravel e sem Node.

## Instalação local (XAMPP)
1. Copie a pasta `pedeflow-pdv` para `C:/xampp/htdocs/`.
2. Crie o banco `pedeflow_pdv` no phpMyAdmin.
3. Importe `database/pedeflow.sql`.
4. Ajuste `config/database.php` se necessário.
5. Execute seed: `php database/seed.php`.
6. Acesse `http://localhost/pedeflow-pdv/public`.

## Login inicial
- Email: `admin@pedeflow.com`
- Senha: `123456`

## Estrutura
Projeto organizado em MVC (`app/Controllers`, `app/Models`, `app/Views`) com roteamento central em `public/index.php`, PDO com prepared statements, sessões e proteção básica de rotas.

## Funcionalidades entregues (base expansível)
- Login/logout com senha hash.
- Dashboard com indicadores.
- Módulos iniciais: categorias, produtos, adicionais, clientes, pedidos (kanban), entregadores, caixa, relatórios, configurações.
- Base para cardápio público e integração WhatsApp.
- Layout responsivo com Bootstrap 5 e identidade visual própria.
