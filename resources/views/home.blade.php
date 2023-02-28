@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center text-center">

            <h1 class="m-5">Accueil / liste de messages</h1>

            <h2 class="m-5">Poster un message</h2>

            <form action="{{ route('posts.store') }}" method="POST" class="w-50">
                @csrf

                <!-- ***************************input content************************ -->

                <div class="row mb-3">
                    <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
                    <label for="content">écris un truc
                        sympa (ou pas !)</label>
                    <textarea required class="container-fluid mt-2" type="text" name="content" id="content"
                        placeholder="salut à tous !"></textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- ***************************input tags************************ -->

                <div class="row mb-3">
                    <label for="tags" class="col-md-4 col-form-label text-md-end">tags</label>

                    <div class="col-md-6">
                        <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror"
                            name="tags" placeholder="bonjour hello" required autofocus>

                        @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- ***************************input image************************ -->

                <div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('image') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="text" class="form-control @error('image') is-invalid @enderror"
                            name="image" placeholder="image.jpg" autocomplete="image" autofocus>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Valider</button>

            </form>

            <h2 class="m-5">Liste des messages</h2>

            <!-- ******************************boucle qui affiche les messages**************************-->
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
                            <div class="col-md-8"><img class="w-75" src="{{ asset('images/' . $post->image) }} "
                                    alt="imagePost"></div>
                            <div class="col-md-4"> {{ $post->content }}</div>
                        </div>

                        <!-- bouton modifier => mène à la page de modification du message-->
                        <a href="{{ route('posts.edit', $post) }}">
                            <button class="btn btn-info">modifier</button>
                        </a>

                        <!-- bouton supprimer -->
                        <div class="container text-center mt-5">
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach

            <div>
                {{ $posts->links() }}
            </div>

        </div>
    </div>
@endsection
