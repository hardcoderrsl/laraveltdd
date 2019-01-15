@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="#">{{$thread->owner->name}}</a> posted: {{$thread->title}}</div>

                <div class="card-body">
                   
                    <article>
                         <div class="body">{{$thread->body}}</div>
                     
                    </article>
                    <hr>
                   
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
       <div class="col-md-8">
            <!-- <div class="card"> -->
                <div class="card-header">Replies</div> 
            @foreach($thread->replies as $reply)   
            <div class="card">
                <div class="card-header">
               <a href="#">{{$reply->owner->name}}</a>  said- 
                {{$reply->created_at->diffForHumans()}}
                </div>
                <div class="card-body">{{$reply->body}}</div>
            </div>
                    <br>
            @endforeach               
            <!-- </div> -->


        </div>
    </div>
    @if(auth()->check())
    <div class="row justify-content-center">
       <div class="col-md-8">
            <form action="{{$thread->path().'/replies'}}" method="POST">
            @csrf
                <div class="form-group">
                    <textarea name="body" id="body" class="form-control" placeholder="Have someting to say?" cols="30" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-default">Post</button>
            </form>
            

        </div>
    </div>

    @else
      <p class="text-center"> <a href="{{route('login')}}">please login</a> to participate conversation.</p>
    @endif
@endsection

</div>