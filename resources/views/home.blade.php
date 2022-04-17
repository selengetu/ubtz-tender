@extends('layouts.app')
@section('style')
<style>
</style>
@stop

@section('content')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Гарын авлага</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
            <iframe src="" id="fileviewer" height="600px" width="100%"></iframe>
            </div>
        </div>
@stop

@section('script')
<script>
    console.log('Hi!');
</script>
@stop
