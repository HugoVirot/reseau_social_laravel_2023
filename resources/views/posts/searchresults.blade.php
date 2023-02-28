@extends('layouts/app')

@section('title')
    Résultats de la recherche - Réseau Social Laravel
@endsection

@section('content')

    <h1>Résultats de la recherche</h1>

    <!-- ******************************** si aucun résultat *****************************-->

    @if (count($posts) == 0)
        <p>aucun résultat pour votre recherche</p>

    <!-- ****************************** si il y a des résultats **************************-->

    @else

        @foreach ($posts as $post)

            <div class="card text-bg-primary mb-3">
                posté par {{ $post->user->pseudo }}
                
                <div class="card-header row">
                    <div class="col-6">
                        {{ $post->tags }}
                    </div>
                    <div class="col-6">
                        posté {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <div class="row card-text">
                        <div class="col-md-8"><img class="w-75" src="{{ asset('images/' . $post->image) }} " alt="imagePost">
                        </div>
                        <div class="col-md-4"> {{ $post->content }}</div>
                    </div>

                    <!-- bouton modifier => mène à la page de modification du message-->
                    <a href="{{ route('posts.edit', $post) }}">
                        <button class="btn btn-info">modifier</button>
                    </a>

                </div>

            </div>
        @endforeach

        <div>
            {{ $posts->links() }}
        </div>
    @endif
@endsection
