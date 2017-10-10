@extends('layouts.app')
@section('content')
	@foreach($contests as $contest)
		<div class="col-md-6 detail">
			<img src="{{ asset($contest['photo_path']) }}" alt="{{ strtolower($contest['title']) }}">
		</div>
		<div class="col-md-6 detail">
			<div class="inner_content">
				<h1>{{ $contest['title'] }}</h1>
				<p>{{ $contest['content'] }}</p>
				<p>{{ $contest['starting_date'] }}</p>
				<p>{{ $contest['ending_date'] }}</p>
				<p>{{ $contest['is_active'] }}</p>
				<div class="buttons">
					{{ Form::open(array('url' => route('contests.delete', ['contest_id' => $contest['contest_id']]), 'method' => 'delete')) }}
						{!! Form::submit('Delete', ['onclick' => 'return confirm("Are you sure?");']) !!}
					{{ Form::close() }}
					<button type="button" class="btn btn-primary change" data-toggle="modal" data-target="#exampleModalLong">
		  				Change
					</button>
				</div>
			</div>
		</div>
	@endforeach
	<!-- add text-align center & margin top 100px -->
	<div class="col-md-12">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
		  Add
		</button>
		@include('includes.form.contest', ['type' => 'post', 'contest' => ''])
		{{-- @include('includes.form.contest', ['type' => 'put', 'contest' => '']) --}}
	</div>
@endsection