# TP1 - Restaurante

1. [Objetivo](#objetivos)
2. [Criar Projeto](#criando-projeto)
3. [Configurando Banco](#configurando-o-banco)
4. [Testando configurações iniciais](#testando-configurações-iniciais)
5. [Criando o model](#criando-o-model)
. [Fazendo as migrações iniciais](#fazendo-as-migrações-iniciais)
7. [Fazendo os requests](#fazendo-os-requests)
8. [Configurando as migrations](#configurando-as-migrations)
9. [Associação 1:n](#implementando-relacionamento-entre-tabelas-do-tipo-um-para-muitos)
10. [Associação n:n](#implementando-relacionamento-entre-tabelas-do-tipo-muitos-para-muitos)
11. [Chaves estrangeiras no model](#verificando-chaves-estrangeiras-no-model)
12. [Gerando APP KEY](#gerando-app-key-para-o-arquivo-env)
13. [Simulador para testes](#simulador-tinker)
14. [Inserindo dados na tabela](#inserindo-dados-na-tabela)
15. [Consultando objetos associados](#consultando-objetos-associados)
   1. [belongsTo, belongsToMany, hasMany](#hasmany-belongstomany-belongsto)
16. [Criando Controller](#criando-controller)
   1. [Index](#index)
   2. [Create](#create)
   3. [Read](#read)
   4. [Update](#update)
   5. [Delete](#delete)


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

*MUDE O NOME DO ARQUIVO ==.env.example== PARA ==.env==*

gerar chave de criptografia do projeto
~~~php
php artisan key:generate
~~~

Opcionalmente se pode recriar o banco
~~~php
php artisan migrate:fresh
~~~

Configuração do .env para esse projeto
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
--controller - cria PratoController
--resource - cria no PratoController as função de CRUD (index, create, ...)
--migration - class responsável por alterar o banco de dados: criar ou alterar tabelas
--factory - inserir dados para testes

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
php artisan make:migration CriaTabelaResolucao --create=restaurante_tipo_restaurante
~~~ 

Depois se adiciona as chaves estrangeiras a tabela criada, se atentando a redundancia
~~~php
public function up()
{
    Schema::create('restaurante_tipo_restaurante', function (Blueprint $table) {
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

### hasMany, belongsToMany, belongsTo
Em associações de n:n usar belongsToMany em ambos os sentidos (consultando restaurante em tipo_restaurante || tipo_restaurante em restaurante)

Em associações 1:n, usar hasMany para navegar do lado 1 (Prato em Restaurante) para n e belongsTo para navegar do n para o lado 1 (Restaurante em Prato)

#### Todos restaurantes do tipo brasileiro

~~~php
$tipobra = TipoRestaurante::where('descricao','=','brasileiro')->first();
$tipobra->belongsToMany(Restaurante::class)->get();
~~~

#### Todos os tipos de comida do restaurante R1

~~~php
$r1 = Restaurante::where('razaoSocial','=','R1')->first();
$r1->belongsToMany(TipoRestaurante::class)->get();
~~~

#### Todos os pratos do restaurante R1

~~~php
$r1 = Restaurante::where('razaosSocial','=','R1')->first();
$r1->hasMany(Prato::class)->get();
~~~

Note que enquanto em uma relação de muitos para muitos se usa o belongsToMany, para uma relação de um para muitos se o hasMany

#### Quais restaurantes vendem o prato P2

~~~php
$prato = Prato::find(2);
$prato->belongsTo(Restaurante::class)->first();
~~~

## Criando controller

Durante a criação do model nós utilizamos o comando

~~~php
php artisan make:model Prato --controller --resource --migration --factory
~~~

para gerar o model, seu controller sua migration, sua factory e seu resource (modelo padrão dento do controller).

caso seja necessário gerar apenas o controller utilizamos
~~~php
php artisan make:controller PratoController
~~~

O controller será responsável pelas funções e métodos que serão utilizados pela view.

### Index
Recuperar do banco de dados todos os pratos cadastrados e os envia para a view
~~~php
public function index()
{
    return View('prato.index')->with('dados',Prato::all());
}
~~~

### Create
Envia um formulário em branco para cadastrar novos pratos
~~~php
public function create()
{
    return View('prato.create');
}
~~~

Armazena no banco de dados o novo prato com os dados recebidos do formulário gerado pela CREATE.
~~~php
public function store(Request $request)
{
    Prato::create( $request->all() );
    // $request->all() gera um vetor com os dados do formuário
    return View('prato.index')->with('dados',Prato::all());
    //retornamos para a view index após armazenar o formulário
}
~~~

### READ
Aciona a view para apresentar os dados do prato recuperado automaticamaento do banco conforme ID
~~~php
public function show(Prato $prato)
{
    return View('prato.show')->with('dados',$prato);
}
~~~

### UPDATE
Envia formilário preenchido com os dados da máquina sendo editada
~~~php
public function edit(Prato $prato)
{
    return View('prato.edit')->with('dados',$prato);
}
~~~

Regrava objeto prato no banco de dados com novos dados recebidos do formulário gerado por EDIT
~~~php
public function update(Request $request, Prato $prato)
{
    $prato->update( $request->all() );
    // gravação
    return View('prato.index')->with('dados',Prato::all());
    //retornamos para a view index após atualizar os dados
}
~~~

### DELETE
Excluir objeto do banco de dados

~~~php
public function destroy(Prato $prato)
{
    $prato->delete();
    return View('prato.index')->with('dados',Prato::all());
    //retornamos para a view index após deletarmos o objeto
}
~~~

## Criando as Views
Primeiro precisamos ir em resources/views e criar o diretório com que iremos trabalhar (nesse caso o diretório prato).
Dentro de prato criamos as views que iremos acessar:
- index.blade.php
- create.blade.php
- show.blade.php
- edit.blade.php

Exemplo simples da view: 
1. index.blade.php
~~~html
@section('content')
<div class='container pt-4'></div>
<div class='container'>
    <table class="table table-striped table-bordered table-sm text-center align-middle">
        <thread class="thread-dark">
        <tr><th scope="col">id</th><th scope="col">Nome</th><th scope="col">Tipo de alimento</th><th scope="col">Preço</th><th scope="col">restaurante_id</th><th scope="col"><a href="/pratos/create" class="btn btn-primary btn-sm">Novo Prato</a></th></tr>
            @foreach($dados as $p)
            <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nome }}</td>
            <td>{{ $p->tipo }}</td>
            <td>{{ $p->preco }}</td>
            <td>{{ $p->restaurante_id }}</td>
            <td>
            <a href="/pratos/{{$p->id}}" class="btn btn-primary btn-sm">Excluir</a>
            <a href="/pratos/{{$p->id}}/edit" class="btn btn-primary btn-sm">Editar</a>
            </td>
            </tr>
            @endforeach
        </thread>
    </table>
</div>
@endsection('content')
~~~

2. create.blade.php
~~~html
@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col-sm-6 text-center align-middle">
            <h4>Adicionar Novo Prato</h4>
            <form action="/pratos" method="post">
                @csrf  <!-- token de segurança -->
                @method('POST') <!-- para acionar a função update do controller -->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}"/>
                    @if($errors->has('nome'))
                    <p>{{$errors->first('nome')}}</p>
                    @endif	
                </div>
                <div>
                    <label for="tipo">Tipo de alimento</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" value="{{old('descricao')}}"/>
                    @if($errors->has('tipo'))
                    <p>{{$errors->first('tipo')}}</p>
                    @endif
                </div>
                <div>
                    <label for="preco">Preço</label>
                    <input type="text" name="preco" id="preco" class="form-control" value="{{old('preco')}}"/>
                    @if($errors->has('preco'))
                    <p class="text-danger">{{$errors->first('preco')}}</p>
                    @endif
                </div>
                <div>
                    <label for="restaurante_id">Restaurante_id</label>
                    <input type="text" name="restaurante_id" id="restaurante_id" class="form-control" value="{{old('restaurante_id')}}"/>
                    @if($errors->has('restaurante_id'))
                    <p class="text-danger">{{$errors->first('restaurante_id')}}</p>
                    @endif
                </div>
                <input type="submit" value="Criar" class="btn btn-primary btn-sm"/>
                <a href="/pratos" class="btn btn-primary btn-sm">Voltar</a>
            </form>
        </div>
    </div>
</div>
@endsection('content')
~~~~

3. edit.blade.php
~~~html
@section('content')
<div class="container pt-4">
		<h3>Editar Prato</h3>
		<div class="row">
			<div class="col-sm-6 text-center align-middle">
				<form action="/pratos/{{$dados->id}}" method="post">
					@csrf  <!-- token de segurança -->
					@method('PUT') <!-- para acionar a função update do controller -->
					<div class="form-group">
						<label for="nome">Nome</label>
						<input type="text" name="nome" id="nome" class="form-control" value="{{empty(old('nome')) ? $dados->nome : old('nome')}}"/>
						@if($errors->has('nome'))
						<p>{{$errors->first('nome')}}</p>
						@endif	
					</div>
					<div>
						<label for="tipo">Tipo de alimento</label>
						<input type="text" name="tipo" id="tipo" class="form-control" value="{{empty(old('tipo')) ? $dados->tipo : old('tipo')}}"/>
						@if($errors->has('tipo'))
						<p>{{$errors->first('tipo')}}</p>
						@endif
					</div>
					<div>
						<label for="preco">Preço</label>
						<input type="text" name="preco" id="preco" class="form-control" value="{{(empty(old('preco')))?$dados->preco:old('preco')}}"/>
						@if($errors->has('preco'))
						<p class="text-danger">{{$errors->first('preco')}}</p>
						@endif
					</div>
                    <div>
						<label for="restaurante_id">Restaurante_id</label>
						<input type="text" name="restaurante_id" id="restaurante_id" class="form-control" value="{{(empty(old('restaurante_id')))?$dados->restaurante_id:old('restaurante_id')}}"/>
						@if($errors->has('restaurante_id'))
						<p class="text-danger">{{$errors->first('restaurante_id')}}</p>
						@endif
					</div>
		    		<input type="submit" value="Alterar" class="btn btn-primary btn-sm" />
		    		<a href="/pratos" class="btn btn-primary btn-sm">Voltar</a>
				</form>
			</div>
		</div>
	</div>
	@endsection('content')
~~~~

4. show.blade.php
~~~html
 @section('content')
    <div class="container text-center align-middle pt-4">
        <h2>Prato {{$dados->nome}}</h2>
        <ul class="list-group-flush">
            <li class="list-item">id: {{$dados->id}}</li>
            <li class="list-item">Nome: {{$dados->nome}}</li>
            <li class="list-item">Tipo de Alimento: {{$dados->tipo}}</li>
            <li class="list-item">Preço: {{$dados->preco}}</li>
            <li class="list-item">Restaurante: {{$dados->restaurante_id}}</li>
        </ul>
        <form action="/pratos/{{$dados->id}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Confirmar" class="btn btn-primary btn-sm">
            <a href="/pratos" class="btn btn-primary btn-sm">Voltar</a>
        </form>
    </div>
    @endsection('content')
~~~~



## Rotas e direcionamentos
Para acessar as views necessitamos de rotas que façam o link entre uri e view e entre controller e view.
~~~php
Route::resource('/pratos',PratoController::class);
~~~
