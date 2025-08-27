<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = article::orderBy('created_at', 'desc')->get(); 
        return view('admin.article.index', compact( 'articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.article.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'title' => 'required|max:255',
        'intro' => 'required',
        'body' => 'required',
        'conclusion' => 'required',
        'reference' => 'nullable|string',
        'author' => 'required|max:255',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size: 2MB
    ]);

    // Create new article instance
    $article = new article();
    $article->title = $request->input('title');
    $article->intro = $request->input('intro');
    $article->body = $request->input('body');
    $article->conclusion = $request->input('conclusion');
    $article->reference = $request->input('reference');
    $article->author = $request->input('author');

    // Handle image upload if exists
    if ($request->hasFile('image_url')) {
        $image_url = $request->file('image_url');
        $imageName = time() . '_' . uniqid() . '.' . $image_url->getClientOriginalExtension();
        
        $imagePath = $image_url->storeAs('articles', $imageName, 'public');
        $article->image_url = $imagePath;
    }

    // Save article to the database
    $article->save();

    // Redirect back with a success message
    return to_route('article.index')->with('message', 'Article was successfully added!');
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(article $article)
    {
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, article $article)
{
    // Validate the incoming request
    $request->validate([
        'title' => 'required|max:255',
        'intro' => 'required',
        'body' => 'required',
        'conclusion' => 'required',
        'reference' => 'nullable|string',
        'author' => 'required|max:255',
        'image_url' => 'image|nullable|max:2048', 
    ]);

    $article->title = $request->title;
    $article->intro = $request->intro;
    $article->body = $request->body;
    $article->conclusion = $request->conclusion;
    $article->reference = $request->reference;
    $article->author = $request->author;

    if ($request->hasFile('image_url')) {
        // Store the new image
        $path = $request->file('image_url')->store('articles', 'public');

        if ($article->image_url && Storage::disk('public')->exists($article->image_url)) {
            Storage::disk('public')->delete($article->image_url);
        }

        $article->image_url = $path;
    }
    $article->save();
    return response()->json(['success' => 'Article updated successfully!']);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        if ($article->image_url && Storage::disk('public')->exists($article->image_url)) {
            Storage::disk('public')->delete($article->image_url);
        }
    
        $article->delete();
    
        return redirect()->route('article.index')->with('success', 'Article deleted successfully!');
    }
}
