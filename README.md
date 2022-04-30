#TP1 - Restaurante

##Criar projeto

_composer create-project --prefer-dist laravel/laravel myProjectName_


Entrar na pasta do projeto

Instalar interface de usuario

_composer require laravel/ui_

_php artisan ui react --auth_

_npm install_

_npm run dev_

##Configurando o Banco
Criar banco de dados (xampp Mysql)
Configurar dados de conexão ao banco de dados no arquivo .env - colocar em DB_DATABASE o nome do bd


##Criando o model:

php artisan make:model Funcionario --controller --resource --migration --factory

adicionar atributo aos models

##Fazendo as Migrações Iniciais

Dentro de app/Providers em AppServiceProvider inserir o comando:

\Illuminate\Support\Facades\Schema::defaultStringLength(191);

Migrar as tabelas para o banco

php artisan migrate

