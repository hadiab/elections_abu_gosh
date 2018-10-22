<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use DB;

class ElectionController extends Controller {

    public function show(Request $request) {
        $isLogged = session('logged_in',false);
        if($isLogged == false){
            return redirect('/login');
        }
        $search = $request->search;
        $filter = $request->filter;
        $search_by = $request->search_by;
        $kalpi = $request->kalpi;
        
        // $elections = Election::where(function($query) use ($search) {
        //     $query->where(DB::raw("CONCAT(`first_name`, ' ', `father_name`, ' ', `last_name`)"), 'LIKE', "%" . $search . "%")
        //     ->orWhere(DB::raw("CONCAT(`street`, ' ', `home_number`)"), 'LIKE', "%" . $search . "%")
        //     // ->orWhere('street', 'LIKE', "%" . $search . "%")
        //     // ->orWhere('home_number', 'LIKE', "%" . $search . "%")
        //     ->orWhere('id_number', 'LIKE', "%" . $search . "%")
        //     ->orWhere('seq_number', 'LIKE', "%" . $search . "%")
        //     ->orWhere('kalpi', 'LIKE', "%" . $search . "%");
        // });

        if($search_by === 'all') {
            $elections = Election::where(function($query) use ($search) {
                $query->where(DB::raw("CONCAT(`first_name`, ' ', `father_name`, ' ', `last_name`)"), 'LIKE', "%" . $search . "%")
                ->orWhere(DB::raw("CONCAT(`street`, ' ', `home_number`)"), 'LIKE', "%" . $search . "%")
                ->orWhere('id_number', 'LIKE', "%" . $search . "%")
		->orWhere('active_person', 'LIKE', "%" .  $search ."%")
                ->orWhere('seq_number', 'LIKE', "%" . $search . "%");
            });
        } else if($search_by === 'seq_number'){
            $elections = Election::where('seq_number', 'LIKE', "%" . $search . "%");
        }  else if($search_by === 'id_number') {
            $elections = Election::where('id_number', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'home_number') {
            $elections = Election::where('home_number', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'street') {
            $elections = Election::where('street', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'full_name') {
            $elections = Election::where(DB::raw("CONCAT(`first_name`, ' ', `father_name`, ' ', `last_name`)"), 'LIKE', "%" . $search . "%");
        } else if($search_by === 'first_name') {
            $elections = Election::where('first_name', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'father_name') {
            $elections = Election::where('father_name', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'last_name') {
            $elections = Election::where('last_name', 'LIKE', "%" . $search . "%");
        }
	else if($search_by === 'active_person') {
	    $elections = Election::where('active_person', 'LIKE' , "%" . $search . "%");
	}
	 else {
            $elections = Election::where('id', '>', 0);
        }
    
        
        if($filter === 'voted') {
            $elections->where('voting', true);
        } else if($filter === 'not_voted') {
            $elections->where('voting', false);
        }
        
        // kalpi filter
        if($kalpi !== 'all' && $kalpi){
            $elections->where('kalpi',$kalpi);
        }
        $results = $elections->paginate(30);
        return view('welcome', [
            'elections' => $results,
            'search' => $search,
            'filter' => $filter,
            'kalpi' => $kalpi,
            'search_by' => $search_by,
        ]);
    }


    public function logout(){
        session(['logged_in' => false]);
        return redirect('/login');

    }

    public function getKalpi(Request $request){
        $election = Election::where('id_number','=',$request->id_number)->first();
        return response()->json([
            'kalpi' =>  $election->kalpi,
            'location'=>$election->location,
            'full_name'=> $election->first_name . ' ' . $election->last_name
        ]); 

    }
    
    public function updateVoting(Request $request, $id) {  
        $election = Election::find($id);

        $search = $request->search;
        $filter = $request->filter;
        $search_by = $request->search_by;
        $kalpi = $request->kalpi;

        $election->voting = !$election->voting;
        $election->save();

        return redirect('/');
    }

    public function loginView(Request $request){
        $isLogged = session('logged_in',false);
        if($isLogged == true){
            return redirect('/');
        }
        return view('login');

    }

    public function login(Request $request){
        if($request->user == 'Admin' && $request->password == 'Alef1221'){
            session(['logged_in' => true]);
            return redirect('/');
        }
        else{
            return redirect('/login');
        }
        

    }


    public function statistics(){

        $kalpi_10_ebraheem = Election::where('last_name','איברהים')->where('kalpi','10')->where('voting',true)->count();
        $kalpi_21_ebraheem = Election::where('last_name','איברהים')->where('kalpi','21')->where('voting',true)->count();
        $kalpi_22_ebraheem = Election::where('last_name','איברהים')->where('kalpi','22')->where('voting',true)->count();
        $kalpi_30_ebraheem = Election::where('last_name','איברהים')->where('kalpi','30')->where('voting',true)->count();
        $kalpi_41_ebraheem = Election::where('last_name','איברהים')->where('kalpi','41')->where('voting',true)->count();
        $kalpi_42_ebraheem = Election::where('last_name','איברהים')->where('kalpi','42')->where('voting',true)->count();
        $kalpi_50_ebraheem = Election::where('last_name','איברהים')->where('kalpi','50')->where('voting',true)->count();
        $kalpi_60_ebraheem = Election::where('last_name','איברהים')->where('kalpi','60')->where('voting',true)->count();
        $kalpi_70_ebraheem = Election::where('last_name','איברהים')->where('kalpi','70')->where('voting',true)->count();
        $kalpi_80_ebraheem = Election::where('last_name','איברהים')->where('kalpi','80')->where('voting',true)->count();

        $kalpi_10_jaber = Election::where('last_name','ג\'בר')->where('kalpi','10')->where('voting',true)->count();
        $kalpi_21_jaber = Election::where('last_name','ג\'בר')->where('kalpi','21')->where('voting',true)->count();
        $kalpi_22_jaber = Election::where('last_name','ג\'בר')->where('kalpi','22')->where('voting',true)->count();
        $kalpi_30_jaber = Election::where('last_name','ג\'בר')->where('kalpi','30')->where('voting',true)->count();
        $kalpi_41_jaber = Election::where('last_name','ג\'בר')->where('kalpi','41')->where('voting',true)->count();
        $kalpi_42_jaber = Election::where('last_name','ג\'בר')->where('kalpi','42')->where('voting',true)->count();
        $kalpi_50_jaber = Election::where('last_name','ג\'בר')->where('kalpi','50')->where('voting',true)->count();
        $kalpi_60_jaber = Election::where('last_name','ג\'בר')->where('kalpi','60')->where('voting',true)->count();
        $kalpi_70_jaber = Election::where('last_name','ג\'בר')->where('kalpi','70')->where('voting',true)->count();
        $kalpi_80_jaber = Election::where('last_name','ג\'בר')->where('kalpi','80')->where('voting',true)->count();


        

        $jaber = Election::where('last_name','ג\'בר')->where('voting',true)->count();
        return response()->json([
            'kalpi_10_ebraheem'=> $kalpi_10_ebraheem,
            'kalpi_21_ebraheem'=> $kalpi_21_ebraheem,
            'kalpi_22_ebraheem'=> $kalpi_22_ebraheem,
            'kalpi_30_ebraheem'=> $kalpi_30_ebraheem,
            'kalpi_41_ebraheem'=> $kalpi_41_ebraheem,
            'kalpi_42_ebraheem'=> $kalpi_42_ebraheem,
            'kalpi_50_ebraheem'=> $kalpi_50_ebraheem,
            'kalpi_60_ebraheem'=> $kalpi_60_ebraheem,
            'kalpi_70_ebraheem'=> $kalpi_70_ebraheem,
            'kalpi_80_ebraheem'=> $kalpi_80_ebraheem,

            'kalpi_10_jaber'=> $kalpi_10_jaber,
            'kalpi_21_jaber'=> $kalpi_21_jaber,
            'kalpi_22_jaber'=> $kalpi_22_jaber,
            'kalpi_30_jaber'=> $kalpi_30_jaber,
            'kalpi_41_jaber'=> $kalpi_41_jaber,
            'kalpi_42_jaber'=> $kalpi_42_jaber,
            'kalpi_50_jaber'=> $kalpi_50_jaber,
            'kalpi_60_jaber'=> $kalpi_60_jaber,
            'kalpi_70_jaber'=> $kalpi_70_jaber,
            'kalpi_80_jaber'=> $kalpi_80_jaber
            
            ]);

    }


    public function saveElections(Request $request) {

        foreach($request->elections as $item) {
            $election = new Election();
            $election->seq_number = $item['seq_number'];
            $election->id_number = $item['id_number'];
            $election->home_number = $item['home_number'];
            $election->street = $item['street'];
            $election->father_name = $item['father_name'];
            $election->first_name = $item['first_name'];
	    $election->belonges_to = $item['belonges_to'];
	    $election->active_person = $item['active_person'];
            $election->last_name = $item['last_name'];
            $election->kalpi = $item['kalpi'];
            $election->voting = false;
            $election->save();
        }

        return response()->json(['success' => 'save data successfully']);

    }

    public function updateElection(Request $request) {
	$matchThese = ['seq_number' => $request->seq_number, 'kalpi' => $request->kalpi];

        $election = Election::where($matchThese)->first();
        $election->voting = true;
        $election->save();

        return response()->json(['success' => 'change voting to true successfully']);
    }


    public function export(Request $request){

        $search = $request->search;
        $filter = $request->filter;
        $search_by = $request->search_by;
        $kalpi = $request->kalpi;


        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=exported.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        
        if($search_by === 'all') {
            $elections = Election::where(function($query) use ($search) {
                $query->where(DB::raw("CONCAT(`first_name`, ' ', `father_name`, ' ', `last_name`)"), 'LIKE', "%" . $search . "%")
                ->orWhere(DB::raw("CONCAT(`street`, ' ', `home_number`)"), 'LIKE', "%" . $search . "%")
                ->orWhere('id_number', 'LIKE', "%" . $search . "%")
		->orWhere('active_person', 'LIKE', "%" .  $search ."%")
                ->orWhere('seq_number', 'LIKE', "%" . $search . "%")
                ->orWhere('kalpi', 'LIKE', "%" . $search . "%");
            });
        } else if($search_by === 'seq_number'){
            $elections = Election::where('seq_number', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'kalpi') {
            $elections = Election::where('kalpi', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'id_number') {
            $elections = Election::where('id_number', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'home_number') {
            $elections = Election::where('home_number', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'street') {
            $elections = Election::where('street', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'full_name') {
            $elections = Election::where(DB::raw("CONCAT(`first_name`, ' ', `father_name`, ' ', `last_name`)"), 'LIKE', "%" . $search . "%");
        } else if($search_by === 'first_name') {
            $elections = Election::where('first_name', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'father_name') {
            $elections = Election::where('father_name', 'LIKE', "%" . $search . "%");
        } else if($search_by === 'last_name') {
            $elections = Election::where('last_name', 'LIKE', "%" . $search . "%");
        }
	else if($search_by === 'active_person') {
	    $elections = Election::where('active_person', 'LIKE' , "%" . $search . "%");
	}
	 else {
            $elections = Election::where('id', '>', 0);
        }
	
        if($filter === 'voted') {
            $elections->where('voting', true);
        } else if($filter === 'not_voted') {
            $elections->where('voting', false);
        }

         // kalpi filter
         if($kalpi !== 'all' && $kalpi){
            $elections->where('kalpi',$kalpi);
        }

        $results = $elections->get();

        $columns = array('שם', 'שם אב', 'שם משפחה', 'קלפי', 'מס סידורי', 'רחוב', 'מס בית', 'ת.ז', 'פעיל', 'הצביע','שייך למשפחה');

        $callback = function() use ($results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($results as $result) {
                fputcsv($file, array($result->first_name,$result->father_name,
                                     $result->last_name,$result->kalpi,$result->seq_number
                                    ,$result->street,$result->home_number,$result->id_number,$result->active_person,$result->voting ? 'כן' : 'לא', 
                                    $result->belonges_to));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
}
}


