# TP1 - Restaurante

[Objetivo](#objetivos)
[Criar Projeto](#criando-projeto)
[Configurando Banco](#configurando-o-banco)
[Criando o model](#criando-o-model)
[Fazendo as migrações iniciais](#fazendo-as-migrações-iniciais)
[Fazendo os requests](#fazendo-os-requests)
[Configurando as migrations](#configurando-as-migrations)
[Associação 1:n](#implementando-relacionamento-entre-tabelas-do-tipo-um-para-muitos)
[Associação n:n](#implementando-relacionamento-entre-tabelas-do-tipo-muitos-para-muitos)
[Chaves estrangeiras no model](#verificando-chaves-estrangeiras-no-model)
[Gerando APP KEY](#gerando-app-key-para-o-arquivo-env)
[Simulador para testes](#simulador-tinker)
[Inserindo dados na tabela](#inserindo-dados-na-tabela)
[Consultando objetos associados](#consultando-objetos-associados)

## Objetivos
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

### Todos os tipos do restaurante R1

~~~php
$r1 = Restaurante::where('razaoSocial','=','R1')->first();
$r1->belongsToMany(TipoRestaurante::class)->get();
~~~