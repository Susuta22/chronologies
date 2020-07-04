<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Content;

use App\Chronology;


class ChronologiesController extends Controller
{
    public function index()
    {
        $data = [];
        
        if (\Auth::check()) {
            $user = \Auth::user();
            $chronologies = $user->chronologies()->orderBy('created_at')->get();
            
            $data = [
                'user' => $user,
                'chronologies' => $chronologies,
            ];
        }
        return view('index', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
        ]);
        
        $request->user()->chronologies()->create([
            'title' => $request->title,
        ]);
        
        return redirect ('/');
    }
    
    public function show($id)
    {
        $data = [];
        $user = \Auth::user();
        $chronology = Chronology::find($id);
        $contents = $chronology->contents()->orderBy('age')->paginate(30);
        
        $data = [
            'user' => $user,
            'chronology' => $chronology,
            'contents' => $contents,
        ];
        return view('chronologies.show', $data);
    }
    
    public function edit($id)
    {
        $chronology = Chronology::find($id);
        return view('chronologies.edit', [
            'chronology' => $chronology,
        ]);
    }
    
    public function destroy($id)
    {
        $chronology = Chronology::find($id);
        $chronology->delete();
        
        
        return redirect('/');
    }
}
