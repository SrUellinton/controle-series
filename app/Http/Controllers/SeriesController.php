<?php

namespace App\Http\Controllers;

use App\Events\SeriesCreated as EventsSeriesCreated;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        //armazenando arquivo
        $coverPath = $request->file('cover')->store('series_cover', 'public');
        $request->coverPath = $coverPath;

        $serie = $this->repository->add($request);
        EventsSeriesCreated::broadcast(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason
        );


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
