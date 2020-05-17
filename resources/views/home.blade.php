﻿@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>


                    @if(session('success'))
                        <div class="alert alert-success col-6 text-center">

                            {{session('success')}}
                        </div>
                    @endif



                    @if(isset($posts) && $posts -> count() > 0)
                        @foreach($posts as $post)


                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <h1> {{$post -> title}} - @if(Auth::id() == $post -> user -> id)   المالك @endif</h1>
                                <br>
                                {{$post -> body}}


                                    <br>
                                    <br>
                                    <h4>Comments</h4>
                                    @foreach($post->comments as $comment)
                                        <p>{{$comment->body}}  - from : {{$comment->user->name}}</p> <br>
                                    @endforeach
                                <br>
                                <br>
                                <form method="POST" action="{{route('comment.save')}}" enctype="multipart/form-data">
                                    @csrf
                                    @if(Auth::id() != $post -> user -> id)
                                        <input type="hidden" name="post_id" value="{{$post -> id}}">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="comment">
                                            @error('name_ar')
                                            <small class="form-text text-danger">{{$message}}</small>
                                            @enderror
                                        </div>



                                        <button type="submit" class="btn btn-primary">أضافه ردك</button>
                                    @endif
                                </form>


                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

