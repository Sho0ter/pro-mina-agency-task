@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                

            <div class="card">  
                <div class="col-md-3">
                    <a class="btn btn-primary" role="button" href="{{route('albums.pictures.create', ['album' => $album])}}" > {{ __('new picture') }} </a>
                </div>
                <div class="card-header">{{ __('pictures') }}</div>

                <div class="card-body">
                   <table class="table" >
                    <thead class="thead-dark">
                    <tr>   
                        <th>Album Name</th>
                        <th>name</th>
                        <th>created at</th>
                        <th>Picture</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        
                    </tr>   
                    </thead>
                    <tbody>
                    @foreach($pictures as $picture)

                        <tr>

                            <td> {{$picture->album->name}} </td>
                            <td> {{$picture->name}} </td>
                            <td> {{$picture->created_at}} </td>
                            <td>
                                <img width="200" height="100" src="{{env('APP_ENV').('/uploads/albums/'.$picture->album->id.'/'.$picture->path)}}" alt="{{$picture->name}}" />
                            </td>
                            <td>
                                <form method="POST" action="{{route('albums.pictures.destroy',  ['picture' => $picture->id , 'album' => $picture->album->id ] )}}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="delete" />    
                                </form>
                            </td>
                        </tr>

                    @endforeach    
                    </tbody>
                </table>
                </div>
                {{ $pictures->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
