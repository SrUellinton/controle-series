<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    //
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();

        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index', ['series' => $series])
        ->with('mensagemSucesso', $mensagemSucesso);
    }
    
    public function create(){
        return view('series.create');
    }

    public function store(Request $request){
        //mass assigmment 
        $request->validate([
            'nome' => ['required', 'min:3']
        ]);
        $serie = Serie::create($request->all());
        return redirect('/series')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy( Serie $series)
    {
        $series->delete();

        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Serie $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update (Serie $series, Request $request){

        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
             ->with('mensagem.sucesso', "Série '($series->nome}' atualizada com sucesso");
    }

}
