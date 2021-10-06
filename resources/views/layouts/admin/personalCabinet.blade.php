@include('includes.main.head')
@include('includes.admin.navbar')
@include('includes.admin.scripts')
<body style="height: 100vh; background-image: url(https://ergomebel.ru/upload/iblock/326/3269dfb3c768f5685a652b74810466b6.jpg)">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1 id="tables">Personal Cabinet</h1>
        </div>

        <div class="bs-component">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th scope="col">Comment id</th>
                    <th scope="col">User name</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Comment text</th>
                    <th scope="col">Published</th>
                    <th scope="col">Operation</th>

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

                    <td>


                        <a href="{{route('admin.personalCabinetAllow', $comment)}}"><button class="btn btn-primary">Allow</button></a>

                        @can('edit',$comment)

                       <a href="{{route('admin.personalCabinetEdit', $comment)}}"><button class="btn btn-success">Edit</button></a>
                        @endcan

                        @can('delete',$comment)
                            <a href="{{route('admin.personalCabinetDelete', $comment)}}"><button class="btn btn-danger">Delete</button></a>
                        @endcan

                    </td>
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

                        <td>



                            @can('edit',$comment)

                            <a href="{{route('admin.personalCabinetEdit', $comment)}}"><button class="btn btn-success">Edit</button></a>

                            @endcan

                            @can('delete',$comment)

                            <a href="{{route('admin.personalCabinetDelete', $comment)}}"><button class="btn btn-danger">delete</button></a>

                            @endcan

                        </td>
                @endforeach


                </tbody>
            </table>


    </div>
</div>
</body>
