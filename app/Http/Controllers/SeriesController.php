<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    //
    public function index()
    {
        $series = Serie::query()->orderBy('nome')->get();

        return view('series.index', ['series' => $series]);
    }
    
    public function create(){
        return view('series.create');
    }

    public function store(Request $request){
        //mass assigmment 
        Serie::create($request->all());

        return redirect('/series');
    }
}
