<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // 1) on valide les champs en précisant les critères attendus
        $request->validate([
            'content' => 'required|min:25|max:1000',
            // autre syntaxe possible : 'content' => ['required', 'min:25', 'max:1000']
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable'
        ]);

        // 2) sauvegarde du message
        Post::create([
            'content' => $request->content,
            'tags' => $request['tags'],
            'image' => $request->input('image'),
            'user_id' => Auth::user()->id
        ]);

        // 3) on redirige vers l'accueil avec un message de succès
        return redirect()->route('home')->with('message', 'Message créé avec succès !');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Post $post)
    {
        return view('posts/edit', ['post' => $post]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post)
    {
        // 1) on valide les champs en précisant les critères attendus
        // (mêmes critères que dans la fonction store)
        $request->validate([
            'content' => 'required|min:25|max:1000',
            // autre syntaxe possible : 'content' => ['required', 'min:25', 'max:1000']
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable'
        ]);

        // 2) sauvegarde du message
        $post->update($request->all());

        // 3) on redirige vers l'accueil avec un message de succès
        return redirect()->route('home')->with('message', 'Message modifié avec succès !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Post $post)
    {
        // je supprime le message
        $post->delete();

        //je redirige sur l'accueil avec un message de confirmation
        return redirect()->route("home")->with('message', 'Suppression réussie');
    }

    
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|min:3|max:20',
        ]);

        $search = $request->input('search');

        // on va chercher les messages qui comportent cette recherche
        // dans leurs tags et / ou dans leur contenu
        $posts = Post::where('posts.tags', 'like', "%$search%") // 1er critère : la chaîne recherchée est dans les tags
            ->orWhere('posts.content', 'like', "%$search%") // 2ème critère : la chaîne recherchée est dans le contenu
            ->with('comments') // EAGER LOADING pour charger les relations nécessaires
            ->latest()->paginate(3); // comments.user = nested eager loading (eager loading "en cascade")

        return view('home', ['posts' => $posts]);
    }
}
