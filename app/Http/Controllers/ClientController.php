<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    //
    public function client(Request $request ,$id){
        $somme = Reparation::where('client_id','=',$id)->sum('prix');
        $dates = Reparation::select('date')->where('client_id','=',$id)->groupBy('date')->get();
        $data = Client::findOrFail($id);
        $user = Auth::user();
        return view('client' , [
            'client' => $data ,
            'user' => $user ,
            'total' => $somme ,
            'dates' => $dates
        ]);
    }

    public function print(Request $request ,$id , $date){
        $reps = Reparation::where('client_id','=',$id)->where('date','=',$date)->orderBy('created_at')->get();
        $somme = Reparation::where('client_id','=',$id)->where('date','=',$date)->sum('prix');

        $data = Client::findOrFail($id);
        $user = Auth::user();
        return view('print' , [
            'client' => $data ,
            'reparations' => $reps  ,
            'user' => $user ,
            'total' => $somme
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nom' => ['required' , 'min:3' , 'max:80'] , 
            'prenom' => [] ,
            'phone' => ['required' , 'min:10' , 'max:11'] , 
            'mail' => ['required' , 'min:7'] , 
            'cin' => ['required' , 'min:12' , 'integer' , 'unique:clients'] , 
            'adresse' => ['required' , 'min:2']  
        ]);

        $liste = Client::create([
            'nom' => $request->nom , 
            'prenom' => $request->prenom ,
            'phone' => $request->phone , 
            'mail' => $request->mail , 
            'cin' => $request->cin ,
            'adresse' => $request->adresse  
        ]);
        return  Redirect::to('/clients ');
    }

    public function search(Request $request){
        $condition = '%' . $request->search . '%' ;
        $data = Client::where('nom' , 'like' ,$condition)->get();
        $user = Auth::user();

        return view('clients' , [
            'data' => $data ,
            'user' => $user
        ]);
    }

    public function supprimer($id){
        $data = Client::findOrFail($id);
        $data->delete();
        return Redirect::to('/clients');

    }

    public function clients(Request $request){
        $data = Client::all();
        $user = Auth::user();
        return view('clients' , [
            'data' => $data ,
            'user' => $user
        ]);
    }

    public function ajouter(Request $request){
        $user = Auth::user();
        return view('ajouter' , [
            'user' => $user
        ]) ;
    }
    public function modify(Request $request,$id){
        $data = Client::findOrFail($id) ;
        $user = Auth::user();
        return view('edit' , [
            'client' => $data ,
            'user' => $user
        ]) ;   
    }
    public function edit(Request $request , $id){
        $data = Client::findOrFail($id) ;
        $request->validate([
            'nom' => ['required' , 'min:3' , 'max:80'] , 
            'prenom' => [] ,
            'phone' => ['required' , 'min:10' , 'max:11'] , 
            'mail' => ['required' , 'min:7'] , 
            'cin' => ['required' , 'min:12' , 'integer' , 'unique:clients'] , 
            'adresse' => ['required' , 'min:2']  
        ]);
        $data->update([
            'nom' => $request->nom , 
            'prenom' => $request->prenom ,
            'phone' => $request->phone , 
            'mail' => $request->mail , 
            'cin' => $request->cin ,
            'adresse' => $request->adresse  
        ]) ;
        return Redirect::to('/clients');
    }
}
