<p class="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<h1>Sistema de Controle de Estoque</h1>

<h2>Sobre o Projeto</h2>
<p>Este projeto consiste em um sistema de controle de estoque desenvolvido em <strong>Laravel</strong>, com o objetivo de gerenciar produtos, categorias e movimentações de entrada e saída de itens.<br>
A aplicação busca oferecer uma solução simples, organizada e escalável para o gerenciamento de estoques, podendo ser utilizada em pequenas e médias empresas ou como base para estudos e evoluções futuras.</p>

<hr>

<h2>Funcionalidades</h2>
<ul>
  <li>Cadastro, edição e exclusão de <strong>produtos</strong></li>
  <li>Organização de produtos em <strong>categorias</strong></li>
  <li>Registro de <strong>movimentações de estoque</strong> (entradas e saídas)</li>
  <li>Exibição do <strong>saldo atual de cada produto</strong></li>
</ul>

<hr>

<h2>Tecnologias Utilizadas</h2>
<ul>
  <li><strong>Laravel</strong> – Framework PHP para desenvolvimento backend (arquitetura MVC)</li>
  <li><strong>Blade</strong> – Template engine do Laravel para renderização de views</li>
  <li><strong>PHP 8.x</strong> – Linguagem utilizada no backend</li>
  <li><strong>MySQL</strong> – Banco de dados relacional</li>
  <li><strong>Composer</strong> – Gerenciador de dependências PHP</li>
  <li><strong>Node.js + npm</strong> – Compilação de recursos front-end (quando aplicável)</li>
</ul>

<hr>

<h2>Pré-requisitos</h2>
<ul>
  <li>PHP (>= 8.x)</li>
  <li>Composer</li>
  <li>MySQL (ou outro banco compatível)</li>
  <li>Node.js e npm (para gerenciamento de assets)</li>
</ul>

<hr>

<h2>Instalação</h2>
<p>Siga os passos abaixo para configurar e executar o sistema:</p>
<pre><code># 1. Clonar o repositório
git clone https://github.com/rainervitorrv/stock.git
cd stock

# 2. Instalar as dependências PHP
composer install

# 3. Criar e configurar o arquivo .env
cp .env.example .env
php artisan key:generate

# 4. Configurar o banco de dados no arquivo .env

# 5. Executar as migrations (e seeders, se disponíveis)
php artisan migrate --seed

# 6. Criar o link simbólico para armazenamento (se necessário)
php artisan storage:link

# 7. Instalar dependências do front-end
npm install
npm run dev

# 8. Iniciar o servidor local
php artisan serve
</code></pre>
<p>Após esses passos, o sistema estará disponível em <code>http://127.0.0.1:8000</code>.</p>

<hr>

<h2>Estrutura do Projeto</h2>
<pre><code>app/              → Models, Controllers e lógica da aplicação
database/         → Migrations e seeders
resources/views/  → Templates Blade
routes/web.php    → Definição de rotas web
public/           → Arquivos públicos e assets
</code></pre>

<hr>

<h2>Utilização</h2>
<ul>
  <li><code>/produtos</code> – Gerenciamento de produtos</li>
  <li><code>/categorias</code> – Gerenciamento de categorias</li>
  <li><code>/movimentacoes</code> – Registro de entradas e saídas de estoque</li>
</ul>

<hr>

<h2>Contribuição</h2>
<p>Contribuições são bem-vindas. Para colaborar:</p>
<ol>
  <li>Realize um fork do repositório</li>
  <li>Crie uma branch para sua feature ou correção (<code>feature/nome-da-feature</code>)</li>
  <li>Envie seus commits de forma clara e objetiva</li>
  <li>Submeta um Pull Request com a descrição da proposta</li>
</ol>

<hr>

<h2>Licença</h2>
<p>Este projeto está licenciado sob a licença <strong>MIT</strong>.<br>
Sinta-se à vontade para utilizar, modificar e distribuir conforme necessário.</p>

<hr>

<h2>Contato</h2>
<p><strong>Autor:</strong> Rainer Vitor<br>
<strong>Repositório:</strong> <a href="https://github.com/rainervitorrv/stock" target="_blank">stock</a></p>
