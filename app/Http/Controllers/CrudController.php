<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TableCrudUser;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TableCrudUser::get();
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
        $crud = new TableCrudUser();
        $crud->rut = $request->rut;
        $crud->nombre = $request->nombre;
        $crud->f_naci = $request->f_naci;
        $crud->genero = $request->genero;
        $crud->email = $request->email;
        $crud->fono = $request->fono;
        $crud->direccion = $request->direccion;
        $crud->region = $request->region;
        $crud->comuna = $request->comuna;

        $crud->save();

        return $crud;
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
        $crud = TableCrudUser::find($id);
        $crud->genero = $request->genero;
        $crud->email = $request->email;
        $crud->fono = $request->fono;
        $crud->direccion = $request->direccion;
        $crud->region = $request->region;
        $crud->comuna = $request->comuna;

        $crud->save();

        return $crud;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crud = TableCrudUser::find($id);

        $crud->delete();
    }
}
