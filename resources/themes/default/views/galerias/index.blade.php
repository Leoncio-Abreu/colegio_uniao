@extends('layouts.master')
@section('content')
    <div class='row'>
        <div class='col-md-12'>
        {!! $filter !!}
        {!! $grid !!}
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
