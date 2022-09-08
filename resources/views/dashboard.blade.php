@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('content')
<div class="row">
    <div class="col-sm-3">
        <img src="/black/img/logo-pizzahut.png"/>
    </div>
</div>
<div class="row">
        <div class="col-md-7">
            <div class="card card-color first">
                <div class="card-header">
                    <div class="row pb-3 mb-3">
                        <div class="col-md-3 text-center blue-text border-bottom border-info">
                        </div>
                        <div class="col-md-6 text-center border-bottom border-info">
                            <h5 class="blue-text">PUT TEXT HERE</h5>
                        </div>
                        <div class="col-md-3 text-right blue-text border-bottom border-info">
                            <button class="btns successs">2</button>
                            <button class="btns dangers">1</button>
                        </div>
                    </div>
                    <div class="row firstcard">
                        {{-- Data will be dynamically input here --}}
                    </div>
                </div>
                <br>
            </div>
        </div>
    <div class="col-md-5">
        <div class="card card-color second">
            <div class="row loading-card">
               <div class="col-sm-6 text-center">
                <br>
                    <h5 class="blue-text">MSG</h5>
               </div>
               <div class="col-sm-6 text-center">
                <br>
                    <h5 class="blue-text">TIME</h5>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-color">
            <div class="row loading-card pt-1 mt-1">
                <div class="col-md-4 text-center">
                   
                </div>
                <div class="col-md-4 text-center">
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="btn-block m-2 p-1 text-center selector" name="sensor_id" id="sensor_id">
                
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input class="selector m-2 p-1 btn-block text-center" type="month" name="date" id="date">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <button class="btns infos p-1 mr-3 mt-2" id="query" name="query">Query</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>Some TEXT - <span id="date_text"></span> &nbsp; <span id="sensor_id_text"></span> </h4>
                </div>
                <div class="col-md-12 text-center" style="height: 300px">
                    <canvas id="myChart"></canvas>
                </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        var queryData = [];
        var label = [];

        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'line',
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    labels: {
                        color: "#ffffff",
                    },
                    position: "top",
                },
                tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return Math.round(tooltipItem.yLabel * 100) / 100;
                            }
                        }
                    },
                scales: {
                    y: {
                        min: -20,
                        max: 100,
                        step: 20,
                        ticks: {
                            color: "#62cee9"
                        },
                        grid: {
                            color: '#42617e'
                        }
                    },
                    x: {
                        ticks: {
                            color: "#62cee9"
                        },
                        grid: {
                             color: '#42617e'
                        }
                    },
                },
            }
        });

        // ON LOAD GET DATA
        $(document).ready(function() {
        // ---
        setInterval(function() {
            cache_clear()
        }, 180000);
        // --- Card Data
        $.ajax({
                type: 'GET',
                url: '{{route("main")}}',
                data: {type: 'card1'},
                success: function (data) {
                    for($x = 0; $x < data.length; $x++){
                        if(data[$x].humidity != null){
                        $rawHTML =
                        `
                        <div class="col-sm-4 text-center">
                            <div class="border-left border-danger pl-2 m-2">
                                <div class="card border border-danger" style="background: transparent; height: 100px">
                                    <div class="card-body">
                                        <h6 class="border-bottom border-secondary pb-1 mb-1">${data[$x].description}</h6>
                                        <br>
                                        <h6><i class="fa-solid fa-temperature-quarter text-warning"></i>TEMP : ${data[$x].temperature}*</h6>
                                        <h6><i class="fa-solid fa-droplet text-info"></i>HUMID : ${data[$x].humidity}*</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        }else{
                        $rawHTML =
                        `
                        <div class="col-sm-4 text-center">
                            <div class="border-left border-success pl-2 m-2">
                                <div class="card border border-success" style="background: transparent; height: 100px">
                                    <div class="card-body">
                                        <h6 class="border-bottom border-secondary pb-1 mb-1">${data[$x].description}</h6>
                                        <br>
                                        <h6><i class="fa-solid fa-temperature-quarter text-warning"></i>TEMP : ${data[$x].temperature}*</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        }
                        $( ".firstcard" ).append($rawHTML);
                        $rawOption =
                        `
                        <option value="${data[$x].sensor_id}">${data[$x].description}</option>
                        `;
                        $( "#sensor_id" ).append($rawOption);
                    }
                    $(".second").height($(".first").height());
                }
            });
        // Graph
        $('#query').click(function(){
            $.ajax({
                type: 'GET',
                url: '{{route("main")}}',
                data: {type: 'graph', id: $('#sensor_id').val(), date: $('#date').val()},
                success: function (data) {
                    // setting name
                    $('#sensor_id_text').html($( "#sensor_id option:selected" ).text());
                    $('#date_text').html($('#date').val());
                    // updating chart
                    myChart.data.labels = [];
                    myChart.data.datasets = [{
                        label: data[0]['name'],
                        data: data[0]['values'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 3,
                        lineTension: .4,
                    }];
                    myChart.data.datasets.push({
                        label: data[0]['name1'],
                        data: data[0]['values1'],
                        borderColor: ['#99d0f9'],
                        borderWidth: 3,
                        lineTension: .4,
                    });
                    $x =  new Date($('#date').val());
                    $days = new Date($x.getFullYear(), $x.getMonth() + 1, 0).getDate();
                    for (let i = 1; i <= $days; i++){
                        myChart.data.labels.push(i);
                        myChart.update();
                    }
                }
            });
          });
        })
    </script>
@endpush