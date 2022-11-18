@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="{{route('albums.pictures.index', ['album' => $album->id])}}">{{ __('pictures') }} </a></div>
               
                <div class="card-body">
                    <form method="POST" class="dropzone" id="dropzone" action="{{ route('albums.pictures.store', ['album' => $album->id] ) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="dz-default dz-message">
                            <h4>Drop Files Here Or Click To Upload</h4>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
