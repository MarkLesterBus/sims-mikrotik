@extends('adminlte::page')

@section('title', $identity[0]['name'])

@section('content_header')
<h1>{{$identity[0]['name']}}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-microchip"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">CPU {{$resources[0]['cpu']}}</span>

                <span class="info-box-number">
                    {{$resources[0]['cpu-frequency']}}
                    <small>MHz</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-memory"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Memory</span>
                <span class="info-box-number">{{ $free_memory }}/{{ $total_memory }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-server"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Storage</span>
                <span class="info-box-number">{{ $free_hdd_space }}/{{ $total_hdd_space }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-compact-disc"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Router OS</span>
                <span class="info-box-number">{{$resources[0]['version']}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Logs</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @php
                $heads = [
                'ID',
                'Time',
                'Topics',
                'Message',
                ]




                @endphp

                <x-adminlte-datatable id="table1" :heads="$heads">
                    @foreach($logs as $row)
                    <tr>
                        @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </x-adminlte-datatable>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-4">

    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<!-- <script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/uplot/uPlot.iife.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/demo.js"></script> -->
<script>
    window.addEventListener('load', function() {
        var xhr = null;

        getXmlHttpRequestObject = function() {
            if (!xhr) {
                // Create a new XMLHttpRequest object 
                xhr = new XMLHttpRequest();
            }
            return xhr;
        };

        updateLiveData = function() {

            var url = '/';
            xhr = getXmlHttpRequestObject();
            xhr.onreadystatechange = evenHandler;
            // asynchronous requests
            xhr.open("GET", url, true);
            // Send the request over the network
            xhr.send(null);
        };

        updateLiveData();

        function evenHandler() {
            // Check response is ready or not
            if (xhr.readyState == 4 && xhr.status == 200) {
                dataDiv = document.getElementById('liveData');
                // Set current data text
                dataDiv.innerHTML = xhr.responseText;
                // Update the live data every 1 sec
                setTimeout(updateLiveData(), 1000);
            }
        }
    });
</script>
@stop