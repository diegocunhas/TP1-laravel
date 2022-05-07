# TP1 - Restaurante



## [1]: Criar projeto
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
php artisan make:model Prato --controller --resource --migration --factory
~~~

adicionar atributo aos models
~~~php
protected $fillable = ['id','tipo','nome','preco'];
~~~

## Fazendo as Migrações Iniciais

Dentro de app/Providers em AppServiceProvider inserir o comando dentro da classe boot:
~~~php
\Illuminate\Support\Facades\Schema::defaultStringLength(191);
~~~

Migrar as tabelas para o banco
~~~php
php artisan migrate
~~~

## Fazendo os Requests

~~~php
php artisan make:request PratoRequest
~~~

## Configurando as migrations

Ir em database\migrations e adicionar os atributos no Schema::Create

~~~php
public function up()
{
    Schema::create('restaurantes', function (Blueprint $table) {
        $table->id();
        $table->string('razaoSocial',100);
        $table->decimal('cnpj',13,0)->unique();
        $table->string('telefone',50);
        $table->string('endereco',100);
        $table->string('email',100);
        $table->timestamps();
    });
}
~~~

## Implementando relacionamento entre tabelas do tipo um para muitos

Se adiciona a chave da tabela "Pai" para a tabela "filho", essa adição é feita na tabela
~~~php
public function up()
{
    Schema::create('pratos', function (Blueprint $table) {
        $table->id();
        $table->string('tipo',50);
        $table->string('nome',50);
        $table->decimal('cnpj',10,2);
        $table->timestamps();
        //-----------Criando chave Estrangeira-----------//
        $table->bigInteger('restaurante_id')->unsigned();
        $table->foreign('restaurante_id')->references('id')->on('restaurantes');
        
    });
}
~~~


## Implementando relacionamento entre tabelas do tipo muitos para muitos

Se cria uma tabela resolução, para isso e se faz uma nova migração (de preferencia a tabela resolução usa o nome das tabelas na ordem alfabética)
~~~php
php artisan make:migration CriaTabelaResolucao --create=Restaurante_tipoRestaurante
~~~ 

Depois se adiciona as chaves estrangeiras a tabela criada, se atentando a redundancia
~~~php
public function up()
{
    Schema::create('Restaurante_tipoRestaurante', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        //----------Chaves Estrangeiras-----------/
        $table->bigInteger('restaurante_id')->unsigned();
        $table->foreign('restaurante_id')->references('id')->on('restaurantes');
        $table->bigInteger('tipoRestaurante_id')->unsigned();
        $table->foreign('tipoRestaurante_id')->references('id')->on('tipo_restaurantes');
        //----utilizar restrição de unique composta para evitar a redundancia de informação-----//
        $table->unique(['restaurante_id','tipoRestaurante_id'],'unica');

    });
}
~~~
O ,'unica' serve para dar nome a condição unique, garantido assim que ela não estoure o limite de caracteres do sql.
Caso a tabela não esteja sendo gerada utilizar
~~~php
php artisan migrate:fresh
~~~
