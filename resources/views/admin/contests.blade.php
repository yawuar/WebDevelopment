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

					<div class="{{ ($contest['is_active'] == 1) ? 'active' : 'inactive'  }}">
						<span></span>
						<p>{{ ($contest['is_active'] == 1) ? 'actief' : 'inactief'  }}</p>
					</div>

					<div class="buttons">

						<a href="{{ route('contests.show', ['contest_id' => $contest['contest_id']]) }}" class="change">
			  				Change
						</a>

						{{ Form::open(array('url' => route('contests.delete', ['contest_id' => $contest['contest_id']]), 'method' => 'delete')) }}

							{!! Form::submit('Delete', ['onclick' => 'return confirm("Are you sure?");', ($contest['is_active'] == 1) ? 'disabled' : '']) !!}

						{{ Form::close() }}

					</div>

				</div>

			</div>

		</div>

	@endforeach

	<div class="col-md-12">

		<a href="{{ route('contests.form') }}" class="btn btn-primary"></a>

	</div>

@endsection