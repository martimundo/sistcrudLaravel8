<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados['funcionarios']=Funcionario::paginate(1);
        return view('funcionarios.index', $dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos=[

            'nome'=>'required|string|max:150',
            'sobrenome'=>'required|string|max:150',
            'email'=>'required|string|max:150',
            'cpf'=>'required|string|max:20',
            'foto'=>'required|max:1000|mimes:jpeg,png,jpg',

        ];
        $messagem=[

            'required'=>'O :attribute é obrigatório',
            'foto.required'=>'A foto é obrigatória'
        ];

        $this->validate($request, $campos, $messagem);
        //$dadoFuncionario = request()->all();
        $dadoFuncionario = request()->except('_token');

        if($request->hasFile('foto')){
            $dadoFuncionario['foto']=$request->file('foto')->store('uploads','public');
        }
        Funcionario::insert($dadoFuncionario);
        //return response()->json($dadoFuncionario);
        return redirect('funcionarios')->with('mensagem','Funcionario Cadatrado com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $funcionario = Funcionario::findOrfail($id);
        return view('funcionarios.edit', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[

            'nome'=>'required|string|max:150',
            'sobrenome'=>'required|string|max:150',
            'email'=>'required|string|max:150',
            'cpf'=>'required|string|max:20',


        ];
        $messagem=[

            'required'=>'O :attribute é obrigatório',

        ];
        if($request->hasFile('foto')){

            $cammpos=['foto'=>'required|max:1000|mimes:jpeg,png,jpg'];
            $messagem=['foto.required'=>'A foto é obrigatória'];
        }

        $this->validate($request, $campos, $messagem);

        //
        $dadoFuncionario = request()->except(['_token', '_method']);
        //faz a verificação da foto salva no BD
        if($request->hasFile('foto')){
            $funcionario = Funcionario::findOrfail($id);
            Storage::delete('public/'.$funcionario->foto);
            $dadoFuncionario['foto']=$request->file('foto')->store('uploads','public');
        }
        Funcionario::where('id', '=', $id)->update($dadoFuncionario);
        $funcionario = Funcionario::findOrfail($id);
        //return view('funcionarios.edit', compact('funcionario'));
        return redirect('funcionarios')->with('mensagem', 'Registro Editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $funcionario = Funcionario::findOrFail($id);

        if(Storage::delete('public/'.$funcionario->foto)){

            Funcionario::destroy($id);
        }
        return redirect('funcionarios')->with('mensagem', 'Registro excluido com sucesso.');
    }
}
