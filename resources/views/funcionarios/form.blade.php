<h1>{{$modo}} Funcionario</h1>

@if(count($errors) > 0)

    <div class="class alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>

    </div>

@endif

    <div class="row">

        <div class="col-3">
            <label for="Nome">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu Nome"value="{{isset($funcionario->nome) ? $funcionario->nome:old('nome')}}">
        </div>
        <div class="col-3">
            <label form="Sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" id="sobrenome" class="form-control" placeholder="Digite seu Sobrenome" value="{{isset($funcionario->sobrenome) ? $funcionario->sobrenome:old('sobrenome')}}">
        </div>
        <div class="col-3">
            <label for="Email">Email:</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Digite seu email" value="{{isset($funcionario->email) ? $funcionario->email:old('email')}}">
        </div>
        <div class="col-3">
            <label form="CPF">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Digite seu CPF"value="{{isset($funcionario->cpf) ? $funcionario->cpf:old('cpf')}}">
        </div>

    </div>
    <div class="row">
        <div class="col-1">
            @if(isset($funcionario->foto))
            <img class="img-thumbnail img-fluid" src="{{asset('storage'). '/'.$funcionario->foto}}" width="100" alt="">
            @endif
            <input type="file" name="foto"  enctype="multipart/form-data" id="foto" value="">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input type="submit"  class="btn btn-primary" value="{{$modo}} Dados" >
            <a href="{{url ('/funcionarios/')}}" class="btn btn-success">Visualizar Registros</a>
        </div>
    </div>



