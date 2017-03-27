<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Response;

class TagController extends Controller
{
    public function tags(Request $request) 
    {
        \Log::info('got em');
        //Step 1: All tags with Noun 
        if(!$request->has('tags')) {
            return $this->trentTags();
        }



        /* Step 2: 
            1. All tags without Noun
            2. Order by related tags
        */

        $tags = explode(',', $request->tags);

        //
        $noun = $tags[0];

        $query = Tag::where('type', '<>',  'N')
                    ->whereNotIn('id', $tags);

        /*
            Exp: Ул боов {}
            [{
                tag: 'ул боов',
                type: 'N',    
            }, {
                tag: 'цагаан сар',
                type: 'A',
            }, {
                 
            }]  
        */  

        return Response::json([
            'code' => 0,
            'result' => $query->get(),
        ]);  
    }

    public function trentTags()
    {
        $query = Tag::where('type', 'N');

        return Response::json([
            'code' => 0,
            'result' => $query->take(15)->get(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Response::json([
            'code' => 0,
            'result' => Tag::orderBy('type')->get(),
        ]);
    }

    public function validateForm(array $data) {
        $error = false;

        if(!isset($data['name']) && empty($data['name'])) {
            $error = true;
        }

        if(!isset($data['icon']) && empty($data['icon'])) {
            $error = true;
        }

        if(!isset($data['type']) && empty($data['type'])) {
            $error = true;
        }

        return $error;
    }

    public function createTag(array $data)
    {
        return Tag::create([
            'name' => $data['name'],
            'icon' => $data['icon'],
            'type' => $data['type'],
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
        if($this->validateForm($request->all())) {
            return Response::json([
                'code' => 1,
                'message' => 'Бүтэн өгөгдөл оруулна уу!.'
            ]);
        }

        $tag = $this->createTag($request->all());

        return Response::json([
            'code' => 0,
            'result' => $tag,
        ]);
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
        //
        if($this->validateForm($request->all())) {
            return Response::json([
                'code' => 1,
                'message' => 'Бүтэн өгөгдөл оруулна уу!.'
            ]);
        }

        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->icon = $request->icon;
        $tag->type = $request->type;
        $tag->save();

        return Response::json([
            'code' => 0,
            'result' => $tag,
        ]);
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
    }

}
