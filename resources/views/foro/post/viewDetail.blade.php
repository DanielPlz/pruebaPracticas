<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <a class="card-title mb-0 h5" style="font-size: 1.5em">{{ $post->titulo }}</a>
                <div class="float-right">
                    @if(Auth::user()==$post->user)
                        <button data-id="{{$post->id}}" class="btn btn-sm btn-info btnModalPostEdit" data-toggle="modal" data-target="#modalPostEdit"><i class="far fa-edit"></i></button>
                        <button data-id="{{$post->id}}" class="btn btn-sm btn-danger btnModalPostDelete" data-toggle="modal" data-target="#modalBorrarPost"><i class="far fa-trash-alt"></i></button>
                    @endif  
                    @if(Auth::user()!=$post->user)
                        <div class="btn-group">
                            <button class="btn btn-light btn-sm " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button data-post="{{ $post->id }}" class="dropdown-item btnPostFavorite" ><i class="far fa-star"></i><label id="msg"> Añadir a favoritos</label></button>
                            </div>
                        </div>
                    @endif  
                </div>
            </div>
            <div class="card-body">
                <img src="{{url('/storage/foro/' . $post->imagen)}}" alt="" class="responsive rounded mx-auto d-block mb-3" style="max-width: 100%;">
                <p class="card-text my-3" style="font-size: 1.2em">{!! nl2br(e($post->contenido)) !!}</p>
                <blockquote class="blockquote mb-0 ml-3 mt-3">
                    <footer class="blockquote-footer">
                        <a style="color:silver"> Publicado por {{ $post->user->name }} a la fecha {{ $post->created_at }} </a>
                            <div align="right">
                                <label id="lblPostLike{{ $post->id }}" style="color:grey;">{{ $post->likes }}</label>
                                <button data-id="1" type="button" data-post="{{ $post->id }}" class="btnTogglePostLike btn btn-outline-light btn-sm"><i class="fas fa-angle-up" style="color:green"></i></button>
                                <label id="lblPostDisLike{{ $post->id }}" style="color:grey;">{{ $post->dislikes }}</label>
                                <button data-id="0" type="button" data-post="{{ $post->id }}" class="btnTogglePostLike btn btn-outline-light btn-sm"><i class="fas fa-angle-down" style="color:red"></i></button>
                            </div>
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>