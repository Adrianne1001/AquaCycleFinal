<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $articles = article::orderBy('created_at', 'desc')->paginate(3);
        return view('LandingPage', compact('articles'));
    }
    public function showArticle($id){
        $article = article::findOrFail($id);
        return view('LandingPageArticle', compact('article'));
    }
}
