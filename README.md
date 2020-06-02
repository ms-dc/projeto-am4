<p><strong><span style="font-size: 24px;">&nbsp;Projeto AM4</span></strong></p>
<p><br></p>
<p><span style="font-size: 20px;">&nbsp;Como instalar o projeto Laravel</span></p>
<p><br></p>
<p><a href="https://laravel.com/docs/7.x">Pr&eacute; Requisitos</a> (ou um ambiente de desenvolvimento, recomendo o <a href="https://laragon.org/download/">Laragon</a>).</p>
<p>Instru&ccedil;&otilde;es:</p>
<ol>
    <li>Baixar ou clonar o reposit&oacute;rio para sua m&aacute;quina</li>
    <li>No diret&oacute;rio do projeto executar o comando <em>composer install</em> para baixar as depend&ecirc;ncias do composer.</li>
    <li>Executar o comando <em>npm install && npm run dev</em> para baixar os pacotes NPM.</li>
    <li>Executar o comando <em>php artisan key:generate</em> para gerar uma chave criptografada no arquivo .env<em>.</em></li>
    <li>Copiar e/ou executar o arquivo bd.sql localizado na ra&iacute;z do projeto em um sistema gerenciador de banco de dados que possua suporte &agrave; MYSQL (recomendo o <a href="https://dbeaver.io/download/">DBeaver</a>).</li>
    <li>Executar o comando <em>php artisan migrate</em> para migrar a base de dados.</li>
    <li>Executar os comandos <em>php artisan db:seed --class=UserSeeder</em> e <em>php artisan db:seed --class=NewsSeeder</em> para popular as tabelas do banco de dados (as notícias criadas automaticamente não conterão imagens, basta editá-las e carregar uma nova imagem caso deseje ou então criar uma nova notícia posteriormente com o site já rodando).</li>
    <li>Executar o comando <em>php artisan storage:link</em> para criar um link simbólico e possibilitar o acesso da pasta pública, fazendo com que as imagens das notícias possam ser mostradas.
</ol>
<p> Após o processo de instalação o site se tornará funcional e ja é possível acessá-lo normalmente (url padrão é projeto-am4.test, mas caso dê erro, mude APP_URL no arquivo .env para localhost ou o host configurado em seu ambiente de desenvolvimento)
<p> Login -> E-mail: admin@admin - Senha: 123456 (deixei em aberto a possibilidade de se cadastrar).</p>
