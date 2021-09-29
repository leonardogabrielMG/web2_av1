<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Animal;
use App\Models\Especie;

class animalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $animais = DB::table("animal AS a")->join("especie AS e", "a.especie", "=", "e.id")
                    ->select("a.id", "a.nomeAnimal", "a.idade", "e.nomeEspecie AS especie")->get();
        $animal = new Animal();
        $especies = Especie::All();  

        return view("animal.index", [
            "animais" => $animais,
            "animal" => $animal,
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
        if ($request->get("id") == "")
        {
            $animal = new Animal();
        }else
        {
            $animal = Animal::Find($request->get("id"));
        }
        
        $animal->nomeAnimal = $request->get("nomeAnimal");
        $animal->nomeDono = $request->get("nomeDono");
        $animal->raca = $request->get("raca");
        $animal->dataNascimento = $request->get("dataNascimento");

        function calcularIdade($data){
            $idade = 0;
            $data_nascimento = date('Y-m-d', strtotime($data));
            list($anoNasc, $mesNasc, $diaNasc) = explode('-', $data_nascimento);
         
            $idade = date("Y") - $anoNasc;
            if (date("m") < $mesNasc){
                $idade -= 1;
            } elseif ((date("m") == $mesNasc) && (date("d") <= $diaNasc) ){
                $idade -= 1;
            }
         
            return $idade;
        }

        $animal->idade = calcularIdade($request->get("dataNascimento"));
        $animal->especie = $request->get("nomeEspecie");
        
        $animal->save();

        $request->Session()->flash("acao", "salvo");
        
        return redirect("/animal");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animal::Find($id);
        return response()->json([
            "Nome Animal" => $animal->nomeAnimal ,
            "Nome Dono" => $animal->nomeDono
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animais = DB::table("animal AS a")->join("especie AS e", "a.especie", "=", "e.id")
                    ->select("a.id", "a.nomeAnimal", "a.idade", "e.nomeEspecie AS especie")->get();
        $animal = Animal::Find($id);
        $especies = Especie::All();

        return view("animal.index", [
            "animais" => $animais,
            "animal" => $animal,
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

        Animal::Destroy($id);

        $request->Session()->flash("acao", "excluido");

        return redirect("/animal");
    }
}
