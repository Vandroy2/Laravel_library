@extends('layouts.site.personalCabinet')

@section('content')

    <div class="admin_index_container">

        @include('includes.errors')

        <div class="secondary_container">

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

@endsection
