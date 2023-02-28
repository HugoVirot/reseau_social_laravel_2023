@extends ('layouts/app')

@section('title')
    Réseau Social Laravel - Modifier un message
@endsection

@section('content')
    <div class="container">
        <h1>Modifier le message</h1>

        <form class="col-4 mx-auto" action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content">Nouveau texte</label>
                <input required type="text" class="form-control" name="content"
                    value="{{ $post->content }}" id="pseudo">
            </div>

            <div class="form-group">
                <label for="image">Nouvelle image</label>
                <input type="text" class="form-control" name="image" value="{{ $post->image }}"
                    id="image">
            </div>

            <div class="form-group">
                <label for="tags">Nouveaux tags</label>
                <input type="text" class="form-control" name="tags" value="{{ $post->tags }}"
                    id="tags">
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
@endsection
