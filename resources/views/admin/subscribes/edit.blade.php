@extends('layouts.admin.adminMain')


@section('content')

    <div class="admin_create_container">

        @include('includes.errors')

        <div class="secondary_container">

            <h3 class = "admin_main_text">Создание подписки</h3>

            <form  method = "Post"
                   @isset($listOfSubscribe)
                   action="{{route('admin.listOfSubscribe.update', $listOfSubscribe)}}"
                   @else
                   action="{{route('admin.listOfSubscribe.store')}}"
                @endisset>

                @csrf
                <div class="form-group">

                    <div class = genre_text>
                        Выберите тип подписки
                    </div>

                    <select class="admin genre" name="listOfSubscribe_type" style="width: 200px;height: 38px;"
                            @isset($listOfSubscribe)
                            @else
                            required
                        @endisset
                    >
                        @isset($listOfSubscribe)
                            <option value="{{$listOfSubscribe->listOfSubscribeType}}"><label >{{$listOfSubscribe->listOfSubscribeType}}</label></option>
                        @else
                            <option value=""><label >Тип подписки</label></option>
                        @endisset

                        <option value="Genre" name="type">Подписка на жанры</option>
                        <option value="Authors" name="type">Подписка на авторов</option>
                        <option value="New" name="type">Подписка на новинки</option>
                        <option value="Premium" name="type">Премиум подписка</option>


                    </select>

                </div>
                <div class="form-group">
                    <label for="name"></label>
                    <input type="number" name="listOfSubscribe_price"  placeholder="Введите цену " class="form-group"
                           @isset($listOfSubscribe)
                           value = "{{old('listOfSubscribePrice')? : $listOfSubscribe->listOfSubscribePrice}}"
                           @else
                           value = "{{old('listOfSubscribePrice')}}"
                        @endisset>
                </div>

                <div class="form-group">

                    <div class = genre_text>
                        Продолжительность подписки
                    </div>

                    <select class="admin genre" name="monthQuantity" style="width: 200px;height: 38px;"
                            @isset($listOfSubscribe)
                            @else
                            required
                        @endisset
                    >
                        @isset($listOfSubscribe)
                            <option value="{{$listOfSubscribe->listSubscribeMonthQuantity}}"><label >{{$listOfSubscribe->duration}}</label></option>
                        @else
                            <option value=""><label >Продолжительность </label></option>
                        @endisset

                        <option value="1" name="type">1 month</option>
                        <option value="6" name="type">6 month</option>
                        <option value="12" name="type">12 month</option>



                    </select>

                </div>

                <input type="hidden" name="alias"
                       @isset($listOfSubscribe)
                       value="{{$listOfSubscribe->listOfSubscribeType.'_'.$listOfSubscribe->listSubscribeMonthQuantity}}"
                       @else
                           value ="New_Subscribe"
                >
                @endif
                <button type="submit" class="btn btn-success admin_btn">
                    @isset($listOfSubscribe)
                    Редактировать подписку
                    @else
                    Создать подписку
                        @endisset
                </button>

            </form>
        </div>
    </div>



@endsection
