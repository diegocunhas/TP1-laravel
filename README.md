# TP1 - Restaurante

[Objetivo](#objetivos) |
[Criar Projeto](#criando-projeto) |
[Configurando Banco](#configurando-o-banco) |
[Testando configurações iniciais](#testando-configurações-iniciais) |
[Criando o model](#criando-o-model) |
[Fazendo as migrações iniciais](#fazendo-as-migrações-iniciais) |
[Fazendo os requests](#fazendo-os-requests) |
[Configurando as migrations](#configurando-as-migrations) |
[Associação 1:n](#implementando-relacionamento-entre-tabelas-do-tipo-um-para-muitos) |
[Associação n:n](#implementando-relacionamento-entre-tabelas-do-tipo-muitos-para-muitos) |
[Chaves estrangeiras no model](#verificando-chaves-estrangeiras-no-model) |
[Gerando APP KEY](#gerando-app-key-para-o-arquivo-env) |
[Simulador para testes](#simulador-tinker) |
[Inserindo dados na tabela](#inserindo-dados-na-tabela) |
[Consultando objetos associados](#consultando-objetos-associados) |
[belongsTo, belongsToMany, hasMany](#hasmany-belongstomany-belongsto) |


## Objetivo
Caso de estudo de como criar um projeto utilizando da metodologia MVC em laravel

## Criando Projeto
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

Caso o projeto seja clonado do github instale as bibliotecas utilizando
~~~
composer install
~~~

## Configurando o Banco
Criar banco de dados (xampp Mysql)
Configurar dados de conexão ao banco de dados no arquivo .env - colocar em DB_DATABASE o nome do bd

*MUDE O NOME DO ARQUIVO *.env.example* PARA *.env**

gerar chave de criptografia do projeto
~~~php
php artisan key:generate
~~~

Opcionalmente se pode recriar o banco
~~~php
php artisan migrate:fresh
~~~

Configuração do .env
~~~
DB_CONNECTION=mysql
DB_HOST=sql10.freemysqlhosting.net
DB_PORT=3306
DB_DATABASE=sql10490707
DB_USERNAME=sql10490707
DB_PASSWORD=1bDcGVNXVB
~~~

## Testando configurações iniciais
~~~php
php artisan serve
~~~

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
    Schema::create('Restaurante_tipo_restaurante', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        //----------Chaves Estrangeiras-----------/
        $table->bigInteger('restaurante_id')->unsigned();
        $table->foreign('restaurante_id')->references('id')->on('restaurantes');
        $table->bigInteger('tipo_restaurante_id')->unsigned();
        $table->foreign('tipo_restaurante_id')->references('id')->on('tipo_restaurantes');
        //----utilizar restrição de unique composta para evitar a redundancia de informação-----//
        $table->unique(['restaurante_id','tipo_restaurante_id'],'unica');

    });
}
~~~
obs.: não usar camel case para nomes compostos, separar pelo _ como no exemplo acima tipo_restaurante em vez de tipoRestaurante

O ,'unica' serve para dar nome a condição unique, garantido assim que ela não estoure o limite de caracteres do sql.
Caso a tabela não esteja sendo gerada utilizar
~~~php
php artisan migrate:fresh
~~~

## Verificando chaves estrangeiras no model

Verificar se no model as chaves estrangeiras foram criadas

~~~php
class Prato extends Model
{
    use HasFactory;

    protected $fillable = ['id','tipo','nome','preco','restaurante_id'];
}
~~~

após alterar o model é necessário rever a migração, para adicionar esse parametro caso ele não exista

~~~php
    public function up()
    {
        Schema::create('pratos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',50);
            $table->string('nome',50);
            $table->decimal('preco',10,2);
            $table->timestamps();
            //-----------Criando chave Estrangeira
            $table->bigInteger('restaurante_id')->unsigned();
            $table->foreign('restaurante_id')->references('id')->on('restaurantes');
            
        });
    }
~~~

## Gerando app key para o arquivo .env
Sem uma key definida no arquivo .env a aplicação não conseguirá acessar o banco de dados.

~~~php
php artisan key:generate
~~~

## Simulador tinker
permite codar em php no prompt para poder realizar testes
~~~php
php artisan tinker
~~~

## Inserindo dados na tabela

Inserindo os dados diretamente via cli php
~~~php
Restaurante::create(['razaoSocial'=>'R2','cnpj'=>'4321','telefone'=>'088','endereco'=>'Rua y,33','email'=>'r2@restaurante.com'])

TipoRestaurante::create(['descricao'=>'italiano'])

Prato::create(['tipo'=>'prato1','nome'=>'teste','preco'=>'56789','restaurante_id'=>'1'])
~~~

Inserindo os dados de Restaurante,TipoRestaurante na tabela resolução Restaurante_TipoRestaurante

~~~php
$x = TipoRestaurante::find(1)
$x->belongsToMany(Restaurante::class)->attach(1)
~~~
ao rodar o comando acima o prompt retorna null

para relacionamentos n:n se utiliza o belongsToMany

## Consultando objetos associados

### Todos restaurantes do tipo brasileiro

~~~php
$tipobra = TipoRestaurante::where('descricao','=','brasileiro')->first();
$tipobra->belongsToMany(Restaurante::class)->get();
~~~

### Todos os tipos de comida do restaurante R1

~~~php
$r1 = Restaurante::where('razaoSocial','=','R1')->first();
$r1->belongsToMany(TipoRestaurante::class)->get();
~~~

### Todos os pratos do restaurante R1

~~~php
$r1 = Restaurante::where('razaosSocial','=','R1')->first();
$r1->hasMany(Prato::class)->get();
~~~

Note que enquanto em uma relação de muitos para muitos se usa o belongsToMany, para uma relação de um para muitos se o hasMany

### Quais restaurantes vendem o prato P2

~~~php
$prato = Prato::find(2);
$prato->belongsTo(Restaurante::class)->first();
~~~

## hasMany, belongsToMany, belongsTo
Em associações de n:n usar belongsToMany em ambos os sentidos (consultando restaurante em tipo_restaurante || tiopo_restaurante em restaurante)

Em associações 1:n, usar hasMany para navegar do lado 1 (Prato em Restaurante) para n e belongsTo para navegar do n para o lado 1 (Restaurante em Prato)
