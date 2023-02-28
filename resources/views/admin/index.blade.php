@extends('layouts/app')

@section('title')
    Back-office admin - Réseau Social Laravel
@endsection

@section('content')
    <h1>Back-office admin</h1>

    <!-- Liste des utilisateurs -->

    <div class="container p-5" id="usersList">
        <h3 class="mb-3">Liste des utilisateurs</h3>

        <table class="table table-primary">

            <!-- titres / en-têtes -->
            <thead class="thead-dark">
                <th>id</th>
                <th>pseudo</th>
                <th>e-mail</th>
                <th>rôle</th>
                <th>supprimer</th>
            </thead>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->pseudo }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role }}</td>
                    <td>
                        <form method="post" action="{{ route('users.destroy', $user) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <!-- Liste des messages -->

    <div class="container p-5" id="usersList">
        <h3 class="mb-3">Liste des messages</h3>

        <table class="table table-secondary">

            <!-- titres / en-têtes -->
            <thead class="thead-dark">
                <th>id</th>
                <th>contenu</th>
                <th>tags</th>
                <th>image</th>
                <th>auteur</th>
                <th>modifier</th>
                <th>supprimer</th>
            </thead>

            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->tags }}</td>
                    <td><img class="w-75" src="{{ asset('images/' . $post->image) }}"></td>
                    <td>{{ $post->user->pseudo }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post) }}">
                            <button class="btn btn-warning">Modifier</button>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

       <!-- Liste des commentaires -->

       <div class="container p-5" id="usersList">
        <h3 class="mb-3">Liste des commentaires</h3>

        <table class="table table-warning">

            <!-- titres / en-têtes -->
            <thead class="thead-dark">
                <th>id</th>
                <th>contenu</th>
                <th>tags</th>
                <th>image</th>
                <th>auteur</th>
                <th>modifier</th>
                <th>supprimer</th>
            </thead>

            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->tags }}</td>
                    <td><img class="w-75" src="{{ asset('images/' . $comment->image) }}"></td>
                    <td>{{ $comment->user->pseudo }}</td>
                    <td>
                        <a href="{{ route('comments.edit', $comment) }}">
                            <button class="btn btn-warning">Modifier</button>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
