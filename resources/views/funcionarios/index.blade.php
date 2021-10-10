@extends('layouts.app')
@section('content')
<div class="container">
    @if(Session::has('mensagem'))
        <div  class="alert alert-success alert-dismissible">
        {{Session::get('mensagem')}}
        <button type="button" class="close" data-dismiss="alert" arial-label="Fechar">
            <span arial-hidden="true">&times;</span>
        </button>
    @endif

<a href="{{url ('/funcionarios/create')}}" class="btn btn-success">Cadastrar Novo Funcionario</a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Cód. Func</th>
            <th>Foto</th>
            <th>Nome</th>
            <th>SobreNome</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($funcionarios as $funcionario)
        <tr>
            <td>{{ $funcionario->id }}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{asset('storage'). '/'.$funcionario->foto}}" width="100" alt="">
            </td>
            <td>{{ $funcionario->nome}}</td>
            <td>{{ $funcionario->sobrenome}}</td>
            <td>{{ $funcionario->email}}</td>
            <td>{{ $funcionario->cpf}}</td>
            <td>
            <a href="{{url ('/funcionarios/'.$funcionario->id.'/edit')}}" class="btn btn-info" >
            Editar</a>
            <form action="{{url('/funcionarios/'.$funcionario->id)}}" class="d-inline" method="POST">
                @csrf
                {{method_field('DELETE')}}

                <input type="submit" onclik="return confirm('Deseja deletar esse Registro?')"   class="btn btn-danger" value="Excluir">
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $funcionarios->links(); !!}
</div>
@endsection

