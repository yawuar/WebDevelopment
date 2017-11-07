@extends('layouts.app')

@section('content')

	@foreach($contests as $contest)

		<div class="wrapper">

			<div class="col-md-12 responsible">

				<div class="inner">
					
					<p><span>Responsible :</span> {{ $contest->user()['email'] }}</p>
				
					<a href="#" class="icon"></a>

				</div>

			</div>

			<div class="col-sm-6 col-md-6 detail">

				<img src="{{ asset($contest['photo_path']) }}" alt="{{ strtolower($contest['title']) }}">

			</div>

			<div class="col-sm-6 col-md-6 content">

				<div class="inner_content">

					<h1>{{ $contest['title'] }}</h1>

					<p>{{ $contest['content'] }}</p>

					<input type="text" class="datepicker" value="{{ $contest['starting_date'] }}">

					<input type="text" class="datepicker" value="{{ $contest['ending_date'] }}">

					<p>{{ $contest['is_active'] }}</p>

					<div class="buttons">

						<button type="button" class="btn btn-primary change" data-toggle="modal" data-target="#exampleModalLong">

			  				Change

						</button>

						{{ Form::open(array('url' => route('contests.delete', ['contest_id' => $contest['contest_id']]), 'method' => 'delete')) }}

							{!! Form::submit('Delete', ['onclick' => 'return confirm("Are you sure?");']) !!}

						{{ Form::close() }}

					</div>

				</div>

			</div>

		</div>

	@endforeach

	<div class="col-md-12">

		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">

		  Add

		</button>

		@include('includes.form.contest', ['type' => 'post', 'contest' => ''])

	</div>

@endsection