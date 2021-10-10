@extends('layouts.app')

@section('content')
<div class="container">
    Formulário para editar Funcionários.

    <form action="{{url('/funcionarios/'.$funcionario->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('PATCH')}}
        @include('funcionarios.form', ['modo'=>'Editar']);
    </form>
</div>
@endsection


