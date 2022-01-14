@extends('layouts.admin.adminMain')


@section('content')

    <div class="admin_create_container genre_text">

        @include('includes.errors')

        <div class="admin_filter_container">

            <h3 class = "genre_text" >Подборки</h3>
<form method = "Post"
      @if(isset($selection))

      action="{{route('admin.selection.update', $selection)}}"

      @else
      action="{{route('admin.selection.store')}}"
      @endif
      class = "form-group" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <label for="selection_name"></label>
        <input type="text" name="selection_name" class="form-control-range" style="width: 500px"
               @isset($selection)
               value="{{old('selection_name')? : $selection->selection_name}}"
               @else
               value="{{old('selection_name')}}"
            @endisset
        >
    </div>

    <div class="form-group">
        <h6 class = "orderEditSelectText">Жанры</h6>
        <select class="admin orderDelivery" name="genre_id[]" multiple>
            @isset($selection)

                @foreach($selection->genres as $genre)
            <option value="{{$genre->id}}" selected><label>{{$genre->genre_name}}</label></option>
                @endforeach

            @endif

        @foreach($genres as $genre)

                <option value="{{$genre->id}}" class="option"
                        name="genre_id">{{$genre->genre_name}}</option>
                @endforeach

        </select>
    </div>

    <div class="form-group">
        <h6 class = "orderEditSelectText">Авторы</h6>
        <select class="admin orderDelivery" name="author_id[]" multiple>
            @isset($selection)

                @foreach($selection->authors as $author)
                    <option value="{{$author->id}}" selected><label>{{$author->author_name}}</label></option>
                @endforeach

            @endif

            @foreach($authors as $author)

                <option value="{{$author->id}}" class="option"
                        name="author_id">{{$author->fullname}}</option>
            @endforeach

        </select>
    </div>

    <div class="form-group">
        <h6 class = "orderEditSelectText">Сортировка по цене</h6>
        <select class="admin orderDelivery" name="sortByPrice">

            @isset($selection)
                <option  class="option" name="sortByPrice" value="{{$selection->sortByPrice}}" selected>Default</option>
                <option  class="option" name="sortByPrice" value="">Цена</option>
                <option  class="option" name="sortByPrice" value="price_low">Сначала дешевые</option>
                <option  class="option" name="sortByPrice" value="price_hi">Сначала дорогие</option>
            @else
                <option  class="option" name="sortByPrice" value="">Цена</option>
                <option  class="option" name="sortByPrice" value="price_low">Сначала дешевые</option>
                <option  class="option" name="sortByPrice" value="price_hi">Сначала дорогие</option>
            @endisset


        </select>
    </div>

    <div class="form-group">
        <h6 class = "orderEditSelectText">Сортировка по продажам</h6>
        <select class="admin orderDelivery" name="sortBySales" >

            @isset($selection)
                <option  class="option" name="sortBySales" value="{{$selection->sortBySales}}" selected>Default</option>
                <option  class="option" name="sortBySales" value=""><label>Фильтр очищен</label></option>
                <option  class="option" name="sortBySales" value="sales_hi">Сначала популярные</option>
                <option  class="option" name="sortBySales" value="sales_low">Сначала не популярные</option>
            @else
                <option  class="option" name="sortBySales" value="Популярность"><label>Популярность</label></option>
                <option  class="option" name="sortBySales" value="sales_hi">Сначала популярные</option>
                <option  class="option" name="sortBySales" value="sales_low">Сначала не популярные</option>
            @endisset


        </select>
    </div>

    <div class="form-group">
        <h6 class = "orderEditSelectText">Лимит</h6>
        <select class="admin orderDelivery" name="limit">
            @isset($selection)

                <option value="{{$selection->limit}}" selected><label>{{$selection->limit}}</label></option>
            @else
                <option value="" selected><label>Лимит</label></option>

            @endif

            <option  class="option" name="limit">Not limited</option>
            <option  class="option" name="limit">3</option>
            <option  class="option" name="limit">5</option>
            <option  class="option" name="limit">10</option>
            <option  class="option" name="limit">50</option>


        </select>
    </div>

     <div class = "form-group">
         <h6 class = "orderEditSelectText">Нажмите на пустое поле для выбора даты создания</h6>

    <input class="date form-control-range" type="text" name="created_at"
           @isset($selection)
           value="{{old('created_at')?: $selection->created_at}}"
           @else
           value="{{old('created_at')}}"
        @endisset
    >
    </div>

    <div class = "form-group">
        <h6 class = "orderEditSelectText">Введите начальную и конечную цену для фильтра</h6>
        <input class="form-control-range" type="number" name="priceParamLow"
        @isset($selection)
            value="{{old('priceParamLow')?: $selection->priceParamLow}}"
        @else
               value="{{old('priceParamLow')}}"
            @endisset

        >
        <input class="form-control-range" type="number" name="priceParamHigh"
               @isset($selection)
               value="{{old('priceParamHigh')?: $selection->priceParamHigh}}"
               @else
               value="{{old('priceParamHigh')}}"
            @endisset
        >
    </div>



    <button type="submit" class="btn btn-success">Сохранить</button>

</form>
        </div>
    </div>


            @endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">

    $('.date').datepicker({
        format: 'mm-dd-yyyy'
    });

</script>
