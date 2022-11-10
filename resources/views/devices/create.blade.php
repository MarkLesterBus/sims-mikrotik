@extends('adminlte::page')

@section('title', 'Devices')

@section('content_header')
<h1>Create Devices</h1>
@stop

@section('content')


<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Instruction</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <b>Host</b> - Enter the desired host address for the device, ex. <code>127.0.0.1</code>
                </div>
                <div class="row">
                    <b>Port</b> - is the number of the service running in the host. ex. <code>8279</code>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <form class="card" action="{{ route('device.store') }}" method="post">
            <div class="card-header">
                <h3 class="card-title">Device</h3>
                <div class="card-tools">

                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Name</label>
                    </div>
                    <div class="col-md-8">
                        <x-adminlte-input name="name" placeholder="Device name" fgroup-class="col-md-12" disable-feedback />

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Host</label>
                    </div>
                    <div class="col-md-8">
                        <x-adminlte-input name="host" placeholder="Host address" fgroup-class="col-md-12" disable-feedback />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">User</label>
                    </div>
                    <div class="col-md-8">
                        <x-adminlte-input name="user" placeholder="Username" fgroup-class="col-md-12" disable-feedback />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Password</label>
                    </div>
                    <div class="col-md-8">
                        <x-adminlte-input name="password" type="password" placeholder="Password" fgroup-class="col-md-12" disable-feedback />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Port</label>
                    </div>
                    <div class="col-md-8">
                        <x-adminlte-input name="port" placeholder="Port number" fgroup-class="col-md-12" disable-feedback />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Comment</label>
                    </div>
                    <div class="col-md-8">
                        <x-adminlte-textarea name="comment" placeholder="Comment" fgroup-class="col-md-12" disable-feedback />
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <x-adminlte-button label="Save" type="submit" theme="success" icon="fas fa-save" />
            </div>
            <!-- /.card-footer-->
        </form>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop