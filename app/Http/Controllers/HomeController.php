<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // seuls les invités non-connectés peuvent voir l'index (inscription + connexion)
        $this->middleware('guest')->only('index');
        // seuls les visiteurs connectés peuvent voir la liste des messages
        $this->middleware('auth')->only('home');
    }

    public function index()
    {
        return view('index');
    }

    public function home()
    {
        // syntaxe de base : on récupère tous les messages
        // $posts = Post::all();
        // syntaxe avec le + récent en 1er +
        // $posts = Post::latest()->get();
        // syntaxe avec le + récent en 1er + la pagination (5 messages par page)
        $posts = Post::latest()->paginate(5);
        return view('home', compact('posts'));
        // autre syntaxe
        // return view('home', ['posts' => $posts]);
    }
}
