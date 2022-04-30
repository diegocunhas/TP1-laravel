# TP1 - Restaurante

## Criar projeto
~~~php
composer create-project --prefer-dist laravel/laravel myProjectName
~~~

Entrar na pasta do projeto

Instalar interface de usuario

~~~
composer require laravel/ui

php artisan ui react --auth

npm install

npm run dev
~~~

## Configurando o Banco
Criar banco de dados (xampp Mysql)
Configurar dados de conexão ao banco de dados no arquivo .env - colocar em DB_DATABASE o nome do bd


## Criando o model:

~~~php
php artisan make:model Funcionario --controller --resource --migration --factory
~~~

adicionar atributo aos models

## Fazendo as Migrações Iniciais

Dentro de app/Providers em AppServiceProvider inserir o comando:
~~~php
\Illuminate\Support\Facades\Schema::defaultStringLength(191);
~~~

Migrar as tabelas para o banco
~~~php
php artisan migrate
~~~

## Fazendo os Requests

~~~php
php artisan make:request Restaurante
~~~