<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Content;
use App\Chronology;

class ContentsController extends Controller
{
    public function edit($id)
    {
        $content = Content::find($id);
        $user = \Auth::user();
        
        if ($content->owner_id === $user->id) {
            return view('contents.edit', [
                'content' => $content,
            ]);
        } else {
            return redirect('/');
        }
    }
    
    public function update(Request $request, $id)
    {
        $data = [];
        $content = Content::find($id);
        $content->update([
            'age' => $request->age,
            'event' => $request->event,
        ]);
        $user = \Auth::user();
        $chronology_id = $content->chronology_id;
        $chronology = Chronology::find($chronology_id);
        $contents = $chronology->contents()->orderBy('age')->paginate(30);
        $data = [
            'user' => $user,
            'chronology' => $chronology,
            'contents' => $contents,
        ];
        return redirect()->route('chronologies.show', $data);
    }
    
    public function store(Request $request)
    {
        $data = [];
        $this->validate($request, Content::$rules);
        $content = new Content;
        $form = $request->all();
        unset($form['_token']);
        $content->fill($form)->save();
        
        $user = \Auth::user();
        $chronology_id = $content->chronology_id;
        $chronology = Chronology::find($chronology_id);
        $contents = $chronology->contents()->orderBy('age')->paginate(30);
        $data = [
            'user' => $user,
            'chronology' => $chronology,
            'contents' => $contents,
        ];
        return redirect()->route('chronologies.show', $data);
    }
    
    public function destroy($id)
    {
        $data = [];
        $content = Content::find($id);
        $content->delete();
        
        $user = \Auth::user();
        $chronology_id = $content->chronology_id;
        $chronology = Chronology::find($chronology_id);
        $contents = $chronology->contents()->orderBy('age')->paginate(30);
        $data = [
            'user' => $user,
            'chronology' => $chronology,
            'contents' => $contents,
        ];
        return view('chronologies.show', $data);
    }
}
