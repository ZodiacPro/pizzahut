@extends('layouts.app', ['pageSlug' => 'alarm'])
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
                        <div class="col-sm-3"></div>
                        <div class="col-sm-2 "><input class="selector m-2 p-1 btn-block text-center" type="date" name="date_from" id="date_from"></div>
                        <div class="col-sm-2"><input class="selector m-2 p-1 btn-block text-center" type="date" name="date_to" id="date_to"></div>
                        <div class="col-sm-2 "><a href="#" class="btns infos p-1 mr-3 mt-2" id="query" name="query">Query</a></div>
                        <div class="col-sm-2 "></div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-6 border border-info p-3">告警訊息</div>
                        <div class="col-sm-6 border border-info p-3">時間</div>
                    </div>
                </div>
                <div class="card-body border border-info">
                    <div class="row" style="overflow: scroll; overflow-x: hidden; height: 20rem;"  id="alert_div">

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
                url: '{{route("alarm")}}',
                data: {type: 'list', date_from: $("#date_from").val(), date_to: $("#date_to").val()},
                success: function (data) {
                    $( "#alert_div" ).empty();
                    $('#alert_count').html(data.length);

                    for($x = 0; $x < data.length; $x++){
                        $rawHTML =
                        `
                        <div class="col-sm-6 text-center">
                            <br>
                                <h5 class="blue-text">${data[$x].alarm}</h5>
                        </div>
                        <div class="col-sm-6 text-center">
                            <br>
                                <h5 class="blue-text">${data[$x].times}</h5>
                            </div>
                        `;
                        $( "#alert_div" ).append($rawHTML);
                    }
                }
            });
            })
        })
    </script>
@endpush
