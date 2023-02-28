<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {

        // récupération des variables nécessaires : users, messages et commentaires
        // EAGER LOADING avec syntaxe with : je charge le rôle de chaque user
        $users = User::with('role')->get();
        // récupération de tous les posts
        $posts = Post::all();
        // récupération de tous les commentaires
        $comments = Comment::all();

        //renvoie vers l'accueil du back-office
        return view("admin/index", [
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
