<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

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
    public function edit(User $user)
    {
        // [ 'nom variable dans vue ' => variable correspondante ]
        return view('user/edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // ************* UPDATE : permet de valider les modifications effectuées *******************

    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|max:40',
            'image' => 'nullable|string'
        ]);

        //on modifie les infos de l'utilisateur
        $user->pseudo = $request->input('pseudo');
        $user->image =  $request->input('image');

        // on sauvegarde les changements en bdd
        $user->save();

        // on redirige sur la page précédente
        return back()->with('message', 'Le compte a bien été modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        // (les id doivent être identiques) 
        if (Auth::user()->id == $user->id) {
            $user->delete();
            return redirect()->route('index')->with('message', 'Le compte a bien été supprimé');

        // si c'est l'admin => suppression possible, redirection sur back-office
        } else if (Auth::user()->role_id == "2") {
            $user->delete();
            return redirect()->route('admin')->with('message', 'Le compte a bien été supprimé');

        // ni l'un ni l'autre : suppression impossible
        } else
            return redirect()->back()->withErrors(['erreur' => 'suppression du compte impossible']);
    }
}
