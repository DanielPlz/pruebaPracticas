<style>
.pagination {
    display: -ms-flexbox;
    flex-wrap: wrap;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="pageList flex-wrap" id="pageList">
            @if (method_exists($posts, "links"))
                {{$posts->links()}}
            @endif
        </div>

        @if(count($posts)>0)
            @foreach($posts->sortByDesc('created_at') as $post)
                <div class="mb-4 card" style="max-width: 100vw">
                    <div class="card-body">
                        <input type="hidden" value="{{$post->id}}" id="post_id">
                        <div class="mb-2">
                            <h4 class="mb-0">
                                <a href="{{ route('foroPostIndex', $post->id) }}" class="card-title" style="font-size: 1em" >{{$post->titulo}}</a>
                                @if(Auth::user() && (Auth::user()==$post->user || Auth::user()->tipo == "Administrador" || Auth::user()->tipo == "Moderador"))
                                    <div class="float-right">
                                        <button data-id="{{$post->id}}" class="btn btn-info btn-sm btnModalPostEdit" data-toggle="modal" data-target="#modalPostEdit"><i class="far fa-edit"></i></button>
                                        <button data-id="{{$post->id}}" class="btn btn-danger btn-sm btnModalPostDelete" data-toggle="modal" data-target="#modalBorrarPost"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                @endif
                                @if(Auth::user() && Auth::user()!=$post->user)
                                    <div class="btn-group">
                                        <button class="btn btn-light btn-sm " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button data-post="{{ $post->id }}" class="dropdown-item btnPostFavorite" ><i class="far fa-star"></i><label id="msg"> Añadir a favoritos</label></button>
                                        </div>
                                    </div>
                                @endif
                            </h4>
                            <a class="ml-2" style="color:grey">Publicado por {{$post->user->name}} </a> 
                        </div>
                        <div>
                            @if($post->imagen)
                                <img src="{{url('/storage/foro/' . $post->imagen)}}" alt="" class="responsive rounded mx-auto d-block mb-3" style="max-width: 100%; max-height: 100vh;">
                            @endif
                        </div>
                        <div>
                            <p class="card-text ml-3 mr-3 mb-3" style="font-size: 1.2em">
                                @if (strlen($post->contenido) > 200)
                                    {{ substr($post->contenido, 0, 200)}}...
                                @else
                                    {{$post->contenido}}
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('foroPostIndex', $post->id) }}" class="ml-3" style="color:silver">Ver los {{count($post->comentarios)}} comentarios</a>
                        <div class="float-right">
                            <label id="lblPostLike{{ $post->id }}" style="color:grey;">{{ $post->likes }}</label>
                            <button data-id="1" type="button" data-post="{{ $post->id }}" class="btnTogglePostLike btn btn-outline-light btn-sm"><i class="fas fa-angle-up" style="color:green"></i></button>
                            <label id="lblPostDisLike{{ $post->id }}" style="color:grey;">{{ $post->dislikes }}</label>
                            <button data-id="0" type="button" data-post="{{ $post->id }}" class="btnTogglePostLike btn btn-outline-light btn-sm"><i class="fas fa-angle-down" style="color:red"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert-warning">
                <p class="text-3">No hay publicaciones por aquí</p> 
            </div>
        @endif
        <div class="modal fade" id="modalFail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>                
                    <div class="modal-body">
                        <div class="responseFail">
                            <label id="responseFail"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="pageList" id="pageList">
            @if (method_exists($posts, "links"))
                {{$posts->links()}}
            @endif
        </div>
    </div>
</div>
