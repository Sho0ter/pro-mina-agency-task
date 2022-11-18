@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                

            <div class="card">  
                <div class="col-md-3">
                    <a class="btn btn-primary" role="button" href="{{route('albums.create')}}" > {{ __('new album') }} </a>
                </div>
                <div class="card-header">{{ __('albums') }}</div>

                <div class="card-body">
                   <table class="table" >
                    <thead class="thead-dark">
                    <tr>   
                        <th>name</th>
                        <th>created at</th>
                        <th>Pictures</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        
                    </tr>   
                    </thead>
                    <tbody>
                    @foreach($albums as $album)

                        <tr>
                            <td> {{$album->name}} </td>
                            <td> {{$album->created_at}} </td>
                            <td>
                                <a  href="{{route('albums.pictures.index', ['album' => $album->id ] )}}">
                                    {{$album->pictures()->count()}}
                                </a>
                            </td>
                            <td>
                            <a class="btn btn-primary" href="{{route('albums.edit', ['album' => $album->id ] )}}"> edit </a>
                            </td>
                            <td>
                            <a class="btn btn-primary" href="{{route('albums.pictures.create', ['album' => $album->id ] )}}"> upload </a>
                            </td>
                            <td>
                            <form method="POST" action="{{route('albums.destroy',  ['album' => $album->id ] )}}">
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
                {{ $albums->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
