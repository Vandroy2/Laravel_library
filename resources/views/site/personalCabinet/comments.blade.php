@extends('layouts.site.personalCabinet')

@section('content')

    <div class="admin_orders_container">

        @include('includes.errors')

        <div class="secondary_container">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h2 id="tables">Комментарии</h2>
        </div>
        <div class="bs-component">
            <table class="table table-hover">
                <thead style="background-color: #4a5568">
                <tr>
                    <th scope="col">Comment id</th>
                    <th scope="col">User name</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Comment text</th>
                    <th scope="col">Published</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commentsNotPublished as $comment)
                    <tr class="table-active">
                        <th scope="row">{{$comment->id}}</th>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->comment_text}}</td>
                        <td>No</td>
                @endforeach
                </tbody>
                <tbody>
                @foreach($commentPublished as $comment)
                    <tr class="table-dark">
                        <th scope="row">{{$comment->id}}</th>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->created_at}}</td>
                        <td>{{$comment->comment_text}}</td>
                        <td>Yes</td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
        </div>
    </div>
@endsection
