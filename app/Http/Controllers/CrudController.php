<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File as File_;

use App\TableCrudUser;
use App\User;
use App\File;
use Auth;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::get();
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
        $password_encrypt = Hash::make($request->password);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password_encrypt;

        $user->save();

        return $user;
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
        $user = User::find($id);
        $user->email = $request->email;
        $user->name = $request->name;


        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
    }

    public function uplodadFile(Request $request)
    {
        $fileName = date('Y-m-d-H:h:m').$request->file->getClientOriginalName();
        $request->file->move(public_path('files'), $fileName);

        $file = new File();
        $file->path_file = $fileName;
        $file->user_id = Auth::user()->id;

        $file->save();

        return $file;
    }

    public function getFiles(){
        $file = File::select('files.id','files.path_file','users.name')
        ->join('users','users.id','=','files.user_id')->get();

        return $file;
    }

    public function deleteFile($id){
        $file = File::find($id);
        $file_name = $file->path_file;
        File_::delete('files/'.$file_name); // Comentar esta linea de código en caso de que
        // no se quiera eliminar el archivo del proyecto.
        $file->delete();
    }

    public function editUserFile(Request $request){
        $file = File::find($request->id);
        $file->user_id = $request->user_id;

        $file->save();

        return $file;
    }
}
