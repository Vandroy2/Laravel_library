<section class="testimonials text-center bg-light" style="
background-image: url(https://upload.wikimedia.org/wikipedia/commons/d/d3/British_Museum_Reading_Room_Section_Feb_2006.jpg)">
    <div class="container">
        <h2 class="mb-5">What people are saying...</h2>
    <script>
        function form_create() {
            document.getElementById('form_create').style.display = 'block';
            document.getElementById('btn_create').style.display = 'block';
        }</script>

        @if(\Illuminate\Support\Facades\Auth::check())
    <button class="btn btn-primary"  onclick='form_create()'>Leave comment</button>
    @endif
    <form role="form" id="form_create" action="{{route('commentStore')}}" method = "Post" style="width: 200px; margin-left: 550px; display: none;">
        @csrf
        <div class="form-group">
            <label for="textarea"></label>
            <textarea class="form-control" id="textarea" name="comment_text" ></textarea>

        </div>
        <button type="submit" id="btn_create" class="btn btn-success" style="display: none">Add comment</button>
    </form>
        <div style="display: flex;flex-wrap: wrap; margin-top: 50px" >
            @foreach($comments as $comment)

            <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0" >

                    @foreach($comment->user->images as $image)
                        <img class="img-fluid" src="{{asset('/storage/'. $image->images)}}" style="width: 100px; height: 100px; margin-bottom: 5px" alt="image" />
                    @endforeach

                    <h5>{{$comment->user->name}}</h5>
                    <p class="font-weight-light mb-0" style="display: block; word-wrap: break-word;">{{$comment->comment_text}}</p>
                </div>
            </div>
                    @endforeach
        </div>
    </div>
</section>
