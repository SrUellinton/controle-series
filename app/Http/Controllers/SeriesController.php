<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use App\Models\Seasons;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
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

    public function store(Request $request){
        //mass assigmment 
        $serie = Series::create($request->all());
        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) { 
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i
            ];

            Seasons::insert($seasons);

            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason ; $j++) { 
                    $episodes[] = [
                        'seasons_id' => $season->id,
                        'number' => $j
                    ];
                }
            }

            Episodes::insert($episodes);
        }
        return redirect('/series')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy( Series $series)
    {
        $series->delete();

        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update (Series $series, Request $request){

        $series->fill($request->all());
        $series->save();
        return to_route('series.index')
             ->with('mensagem.sucesso', "Série '($series->nome}' atualizada com sucesso");
    }

}
