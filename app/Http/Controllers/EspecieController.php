<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $especie = new Especie();
        $especies = Especie::All();
        return view("especie.index", [
            "especie" => $especie,
            "especies" => $especies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get("id") == ""){
            $especie = new Especie();
        }else{
            $especie = Especie::Find($request->get("id"));
        }

        $especie->nomeEspecie = $request->get("nomeEspecie");
        $especie->save();

        $request->Session()->flash("acao", "salvo");

        return redirect("/especie");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especie = Especie::Find($id);
        $especies = Especie::All();

        return view("especie.index", [
            "especie" => $especie,
            "especies" => $especies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Especie::Destroy($id);

        $request->Session()->flash("acao", "excluido");

        return redirect("/especie");
    }
}
