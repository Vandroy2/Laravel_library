@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_orders_container">

        @include('includes.errors')

        <div class="secondary_container">


                <div class="">
                    @include('includes.errors')
                    <form role="form" action="{{route('admin.personalCabinetUpdate', $comment)}}" method = "Post">
                        @csrf
                        <div class="form-group genre_text">
                            <label for="comment_text"></label>
                            <input type="text" name="comment_text" value="{{$comment->comment_text}}" id = "comment_text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Update comment</button>
                    </form>
                </div>

        </div>
    </div>

@endsection
