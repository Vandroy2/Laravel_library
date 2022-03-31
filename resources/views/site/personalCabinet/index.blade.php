@extends('layouts.site.personalCabinet')

@section('content')

    <div class="admin_index_container">

        @include('includes.errors')

        <div class="secondary_container">

            @forelse($notifications as $notification)
                <div class = "alert alert-danger" role = "alert">
                    Your subscribe "{{$notification->data['subscribe_type']}}" duration {{$notification->data['monthQuantity']}} month will ends after 2 days.
                    Please check your balance to continue subscribing.
                    <a href="#" class="float-right mark-as-read" data-id="{{$notification->id}}">
                        Mark as read
                    </a>
                </div>

                @if($loop->last)
                    <a href="#" id="mark-all">
                        Mark all as read
                    </a>
                @endif
            @empty
                There are no new notifications
            @endforelse

            <div class = "flex justify-content-around">

                <div class = w-50>
                    <h2 class = "text-center">Диаграмма популярности жанров</h2>
                    <div id="chartGenres"></div>
                </div>


                <div class = w-50>
                    <h2 class = "text-center">Диаграмма популярности авторов</h2>
                    <div id="chartAuthors"></div>
                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script>
        am5.ready(function() {

            let chartGenres = function (elemId, arr) {

                var chartDiv = am5.Root.new(elemId);

                chartDiv.setThemes([
                    am5themes_Animated.new(chartDiv)
                ]);

                var chart = chartDiv.container.children.push(am5percent.PieChart.new(chartDiv, {
                    layout: chartDiv.verticalLayout
                }));

                var series = chart.series.push(am5percent.PieSeries.new(chartDiv, {
                    valueField: "sale",
                    categoryField: "name"
                }));

                series.data.setAll(arr);

                series.appear(1000, 100);
            }

            let arrGenres = @json($genresForChart);

            let arrAuthors = @json($authorsForChart);

            chartGenres("chartGenres", arrGenres);

            chartGenres("chartAuthors", arrAuthors);
        });
    </script>

    @include('includes.main.scripts')
@endsection
