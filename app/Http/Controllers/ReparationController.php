<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ReparationController extends Controller
{
    
    public function updateRep(Request $request ,$id){
        $rep = $request->repId;
        $reparation = Reparation::findOrFail($rep);
        $request->validate([
            'libelle' => ['required' , 'min:3' , 'max:80'] , 
            'quantite' => ['required'] , 
            'prixUn' => ['required']  
        ]);

        $reparation->update([
            'libelle' => $request->libelle , 
            'quantite' => $request->quantite ,
            'prix_un' => $request->prixUn , 
            'prix' => $request->quantite * $request->prixUn , 
        ]) ;

        return  Redirect::to('/client/'.$id);
    }

    public function editRep(Request $request ,$id, $rep){
        $reps = Reparation::where('client_id','=',$id)->orderBy('created_at')->get();
        $data = Client::findOrFail($id);
        $reparation = Reparation::findOrFail($rep);
        $user = Auth::user();
        $somme = Reparation::where('client_id','=' , $id)->sum('prix');
        return view('edit-rep' , [
            'client' => $data ,
            'reparations' => $reps ,
            'rep' => $reparation ,
            'user' => $user ,
            'total' => $somme
        ]);
    }

    public function stats(Request $request){
        $cl = Client::select('clients.*',DB::raw('SUM(reparations.prix) as total_prix'))
        ->join('reparations','clients.id','=','reparations.client_id')
        ->groupBy('clients.id')
        ->orderBy('total_prix','desc')
        ->limit(4)
        ->get();
        $cl2 = Client::select('clients.*',DB::raw('SUM(reparations.prix) as total_prix'))
        ->join('reparations','clients.id','=','reparations.client_id')
        ->groupBy('clients.id')
        ->orderBy('total_prix','desc')
        ->get();
        $nb_rep = Client::withCount('reparations')->orderBy('reparations_count' , 'desc')->take(4)->get();
        $plus = Reparation::orderBy('prix' ,'desc')->take(4)->get();
        
        $user = Auth::user();
        $chart_data = [];
        $chart_label = [];
        foreach($cl as $item){
            $chart_data = [...$chart_data , intval($item->total_prix)];
            $chart_label = [...$chart_label , $item->nom];
        };
        $chart2_data = [];
        $chart2_label = [];
        foreach($cl2 as $item){
            $chart2_data = [...$chart2_data , intval($item->total_prix)];
            $chart2_label = [...$chart2_label , $item->nom];
        };

        return view('statistiques', [
            'plus' => $plus ,
            'clients_plus' => $cl ,
            'chart_label' => $chart_label ,
            'chart_data' => $chart_data ,
            'chart2_label' => $chart2_label ,
            'chart2_data' => $chart2_data ,
            'user' => $user ,
            'nb_rep' => $nb_rep 
        ]);
    }

    public function getFilteredRep(Request $request , $id){
        $libelle = $request->libelle;
        $prixMin = $request->prixMin;
        $prixMax = $request->prixMax;
        $data = Reparation::where('client_id','=' , $id)
            ->where('libelle','like','%'.$libelle.'%')
            ->whereBetween('prix',[intval($prixMin) , intval($prixMax)])
            ->get();
        $client = Client::findOrFail($id);
        $user = Auth::user();
        $somme = Reparation::where('client_id','=' , $id)->sum('prix');
        $dates = Reparation::select('date')->where('client_id','=',$id)->groupBy('date')->get();
        return view('client' , [
            'client' => $client ,
            'reparations' => $data ,
            'user' => $user ,
            'total' => $somme,
            'dates' => $dates
        ]);

    }

    public function addRep(Request $request , $id){
        $request->validate([
            'libelle' => ['required' , 'min:3' , 'max:80'] , 
            'quantite' => ['required'] , 
            'prixUn' => ['required']  
        ]);

        $rep = new Reparation();
        $rep->client_id = $id;
        $rep->libelle = $request->libelle;
        $rep->quantite = $request->quantite;
        $rep->prix = $request->prixUn * $request->quantite;
        $rep->prix_un = $request->prixUn;
        $rep->date = $request->date;

        $rep->save();
       
        return  Redirect::to('/client/'.$id);
    }

    public function deleteRep($id, $rep){
        Reparation::findOrFail($rep)->delete();
        
        return  Redirect::to('/client/'.$id);
    }
}
