@extends('layouts.app', ['pageSlug' => 'threshold'])
@section('content')

@endsection
<div class="row">
    <div class="col-lg-12 ml-4 pl-4 mt-4 pt-4">
        <h1>告警門檻值設定</h1>
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
                        <div class="col-sm-2 border border-info p-3">Sensor_id</div>
                        <div class="col-sm-2 border border-info p-3">感測器</div>
                        <div class="col-sm-2 border border-info p-3">溫度門檻值_上限</div>
                        <div class="col-sm-2 border border-info p-3">溫度門檻值_下限</div>
                        <div class="col-sm-2 border border-info p-3">濕度門檻值_上限</div>
                        <div class="col-sm-2 border border-info p-3">濕度門檻值_下限</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row text-center text-white border" id="list">

                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-info" type="submit">Update</button>
                    <a href="{{route('main')}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            // --- Card Data
        $.ajax({
                type: 'GET',
                url: '{{route("threshold")}}',
                data: {type: 'list'},
                success: function (data) {
                    for($x = 0; $x < data.length; $x++){
                        $rawHTML =
                        `
                        <input type="text" name="${$x}-sensor_id" value="${data[$x].sensor_id}" style="display:none" />
                        <div class="col-sm-2 border border-info p-1">${data[$x].sensor_id}</div>
                        <div class="col-sm-2 border border-info p-1">${data[$x].description}</div>
                        <div class="col-sm-2 border border-info p-1"><input type="text" value="${data[$x].max_t}" name="${$x}-max_t" style="background:transparent;border:none;color:white"/></div>
                        <div class="col-sm-2 border border-info p-1"><input type="text" value="${data[$x].min_t}" name="${$x}-min_t" style="background:transparent;border:none;color:white"/></div>
                        <div class="col-sm-2 border border-info p-1"><input type="text" value="${data[$x].max_h}" name="${$x}-max_h" style="background:transparent;border:none;color:white"/></div>
                        <div class="col-sm-2 border border-info p-1"><input type="text" value="${data[$x].min_h}" name="${$x}-min_h" style="background:transparent;border:none;color:white"/></div>
                        `;
                        
                        $( "#list" ).append($rawHTML);
                    }
                }
            });
        })
    </script>
@endpush
