@extends('layouts.app', ['pageSlug' => 'history'])
@section('content')

@endsection
<div class="row">
    <div class="col-lg-12 ml-4 pl-4 mt-4 pt-4 text-center">
        <h3>歷史告警</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <form method="post" action="{{route('threshold')}}">
            @csrf
            <input type="text" value="update" name="type" style="display: none">
            <div class="card">
                <div class="card-header">
                    <div class="row text-center">
                        <div class="col-sm-2 "></div>
                        <div class="col-sm-3">
                            <select class="btn-block m-2 p-1 text-center selector" name="sensor_id" id="sensor_id">
                                @foreach ($sensor as $item)
                                    <option value="{{$item->sensor_id}}">{{$item->description}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 "><input class="selector m-2 p-1 btn-block text-center" type="date" name="date_from" id="date_from"></div>
                        <div class="col-sm-2"><input class="selector m-2 p-1 btn-block text-center" type="date" name="date_to" id="date_to"></div>
                        <div class="col-sm-2 "></div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-4 p-3"></div>
                        <div class="col-sm-2 p-3"><a href="#" class="btns infos p-2 mr-3 mt-4 btn-block" id="query" name="query">Query</a></div>
                        <div class="col-sm-2 p-3"><a href="#" class="btns infos p-2 mr-3 mt-4 btn-block" id="csv" name="csv">CSV</a></div>
                        <div class="col-sm-4 p-3"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-2 border border-info p-3">時間</div>
                        <div class="col-sm-2 border border-info p-3">溫度</div>
                        <div class="col-sm-2 border border-info p-3">溫度上限</div>
                        <div class="col-sm-2 border border-info p-3">溫度下限</div>
                        <div class="col-sm-2 border border-info p-3">濕度</div>
                        <div class="col-sm-1 border border-info p-3">濕度上限</div>
                        <div class="col-sm-1 border border-info p-3">濕度下限</div>
                    </div>
                </div>
                <div class="card-body border border-info">
                    <div class="row" style="overflow: scroll; overflow-x: hidden; height: 20rem;"  id="list_div">

                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{route('main')}}" class="btn btn-info">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            // --- Card Data'
            $("#query").click(function(){
                $.ajax({
                type: 'GET',
                url: '{{route("history")}}',
                data: {type: 'list',sensor_id: $("#sensor_id").val() , date_from: $("#date_from").val(), date_to: $("#date_to").val()},
                success: function (data) {
                    $( "#list_div" ).empty();
                    $('#alert_count').html(data.length);

                    for($x = 0; $x < data.length; $x++){
                        $rawHTML =
                        `
                        <div class="col-sm-2 text-center">
                            <br>
                                <h5 class="blue-text">${data[$x].times}</h5>
                        </div>
                        <div class="col-sm-2 text-center">
                            <br>
                                <h5 class="blue-text">${Math.round(data[$x].temperature * 100) / 100}</h5>
                        </div>
                        <div class="col-sm-2 text-center">
                            <br>
                                <h5 class="blue-text">${data[$x].max_t}</h5>
                        </div>
                        <div class="col-sm-2 text-center">
                            <br>
                                <h5 class="blue-text">${data[$x].min_t}</h5>
                        </div>
                        <div class="col-sm-2 text-center">
                            <br>
                                <h5 class="blue-text">${Math.round(data[$x].humidity * 100) / 100}</h5>
                        </div>
                        <div class="col-sm-1 text-center">
                            <br>
                                <h5 class="blue-text">${data[$x].max_h}</h5>
                        </div>
                        <div class="col-sm-1 text-center">
                            <br>
                                <h5 class="blue-text">${data[$x].min_h}</h5>
                        </div>
                        `;
                        $( "#list_div" ).append($rawHTML);
                    }
                }
            });
            })

            // export
            $("#csv").click(function(){
                window.open(`/history?type=csv&sensor_id=${$("#sensor_id").val()}&date_from=${$("#date_from").val()}&date_to=${$("#date_to").val()}`);
            })
        })
    </script>
@endpush
