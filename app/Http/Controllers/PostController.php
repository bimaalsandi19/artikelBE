<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data =  Post::all();
       if ($data) {
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' =>$data
        ]);
       } else {
        return response()->json([
            'code' => 400,
            'message' => 'Failed',
        ]);
       }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $request->validate([
            'title' => 'required|string|min:20',
            'content' => 'required|string|min:200',
            'category' => 'required|string|min:3',
            'status' => 'required|in:Publish,Draft,Trash',
        ]);

        $data = new Post;
        $data->title=$request->title;
        $data->content=$request->content;
        $data->category=$request->category;
        $data->status=$request->status;
        $result = $data->save();
        if ($result) {
            return [
                'code' => 200,
                'message' => 'Data Berhasil DIsimpan',
                'data' => $data
            ]; 
        } else {
            return [
                'code' => 400,
                'message' => 'Data Gagal DIsimpan'
            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $limit = $request->input('limit', 4);
       $offset = $request->input('offset', 0);

       $data = Post::latest()->skip($offset)->take($limit)->get();
       return response()->json([
        'code' => 200,
        'data' => $data
       ]);
    }

    public function store_publish(Request $request)
    {
       $limit = $request->input('limit', 4);
       $offset = $request->input('offset', 0);

       $data = Post::latest()->where('status', 'Publish')->skip($offset)->take($limit)->get();
       return response()->json([
        'code' => 200,
        'data' => $data
       ]);
    }

    public function store_draft(Request $request)
    {
       $limit = $request->input('limit', 4);
       $offset = $request->input('offset', 0);

       $data = Post::latest()->where('status', 'Draft')->skip($offset)->take($limit)->get();
       return response()->json([
        'code' => 200,
        'data' => $data
       ]);
    }

    public function store_trash(Request $request)
    {
       $limit = $request->input('limit', 4);
       $offset = $request->input('offset', 0);

       $data = Post::latest()->where('status', 'Trash')->skip($offset)->take($limit)->get();
       return response()->json([
        'code' => 200,
        'data' => $data
       ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $data =  Post::find($id);
        if ($data) {
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' =>$data
            ]);
           } else {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
            ]);
           }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:20',
            'content' => 'required|string|min:200',
            'category' => 'required|string|min:3',
            'status' => 'required|in:Publish,Draft,Trash',
        ]);
        
        $data = Post::find($id);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data tidak ditemukan']);
        }

        $data->update($request->all());

        return response()->json([
            'message' => 'Data berhasil diperbarui', 
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Post::find($id);

        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data tidak ditemukan'
                
            ]);
        }

        $data->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
