<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use Carbon\Carbon;
use App\Models\Persona;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


class PersonaApiController extends Controller
{
    //





    public function index()
    {
        //
        $date = Carbon::now();
        $personas = Persona::paginate(10);
        return response()->json([
            'date' => $date,
            'personas' => $personas
        ]);

     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'tipo_persona'=> 'required',
            'nombre'=> 'required',
            'tipo_documento'=> 'nullable',
            'num_documento'=> 'nullable',
            'direccion'=> 'nullable',
            'telefono'=> 'nullable',
            'email'=> 'nullable'
        ]);

        $input = $request->all();

        $persona =Persona::create($input);


        return response()->json($persona, Response::HTTP_CREATED);
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
        //
        $persona = Persona::find($id);

        return response()->json($persona);
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
        $this->validate($request, [
           'tipo_persona'=> 'required',
           'nombre'=> 'required',
           'tipo_documento'=> 'nullable',
           'num_documento'=> 'nullable',
           'direccion'=> 'nullable',
           'telefono'=> 'nullable',
           'email'=> 'nullable'
       ]);

            $input = $request->all();

            $persona =Persona::find($id);
            $persona -> update($input);


            return response()->json($persona);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $persona = Persona::find($id);
        Persona::find($id)->delete();



        return response()->json(null, Response::HTTP_NO_CONTENT);
    }


}
