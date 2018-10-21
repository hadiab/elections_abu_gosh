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

        $results = $elections->paginate(30);

        return view('welcome', [
            'elections' => $results,
            'search' => $search,
            'filter' => $filter,
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
            'location'=>$election->location
        ]); 

    }
    public function updateVoting(Request $request, $id) {  
        $election = Election::find($id);

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
}
