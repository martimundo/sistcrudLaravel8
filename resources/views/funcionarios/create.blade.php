@extends('layouts.app')

@section('content')
<div class="container">
<h2>Formulário para criar novos funcionários.</h2>
<form action="{{url('/funcionarios')}} " method="POST" enctype="multipart/form-data">
@csrf
@include('funcionarios.form', ['modo'=>'Salvar']);

</form>
</div>
@endsection
