<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware('auth')->except('index');
    }

    //
    public function index(Request $request)
    {
        $series = Series::with('seasons')->get();

        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index', ['series' => $series])
        ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
        $serie = $this->repository->add($request);

        return redirect('/series')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy( Series $series)
    {
        $series->delete();

        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series){
        $season = $series->seasons()->with('episodes')->first();

        return view('series.edit', ['serie'=> $series, 'season' => $season]);
    }

    public function update (Series $series, Request $request){
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
             ->with('mensagem.sucesso', "Série '($series->nome}' atualizada com sucesso");
    }

}
