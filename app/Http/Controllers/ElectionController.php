<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Election;
use DB;

class ElectionController extends Controller {

    public function show(Request $request) {
        $search = $request->search;
        $filter = $request->filter;

        $elections = Election::where(function($query) use ($search) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ', `father_name`, ' ', `last_name`)"), 'LIKE', "%" . $search . "%")
            ->orWhere('street', 'LIKE', "%" . $search . "%")
            ->orWhere('home_number', 'LIKE', "%" . $search . "%")
            ->orWhere('id_number', 'LIKE', "%" . $search . "%")
            ->orWhere('seq_number', 'LIKE', "%" . $search . "%")
            ->orWhere('kalpi', 'LIKE', "%" . $search . "%");
        });

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
            $election->last_name = $item['last_name'];
            $election->kalpi = '1';
            $election->voting = false;
            $election->save();
        }

        return response()->json(['success' => 'save data successfully']);

    }

    public function updateElection(Request $request) {
        $election = Election::where('seq_number', $request->seq_number)->first();
        $election->voting = true;
        return response()->json(['success' => 'change voting to true successfully']);
    }
}
