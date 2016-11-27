@extends('layouts.master')


<!--    <div class='row'>-->

@section('content')
    <div class='box-body'>
        <div class='col-md-12'>
            <!-- Box -->
			{!! $filter !!}
		{!! $grid !!}

        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection
