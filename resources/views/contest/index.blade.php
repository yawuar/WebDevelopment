@extends('layouts.contest')

@section('content')
	
		@foreach($contestPhotos as $contestPhoto)
			<div class="col-md-4 equal-height">
				<div style="background-image: url('{{ $contestPhoto['photo_path'] }}');">
					
				</div>
				{{-- <img src="{{ $contestPhoto['photo_path'] }}" alt="{{ $contestPhoto['title'] }}"> --}}
			</div>
		@endforeach

		<div class="col-md-4 equal-height">
			{{ Form::open(array('url' => route('contest.store'), 'files' => true)) }}
		    	{{ Form::text('title') }}
		    	{{ Form::text('content') }}
		    	{{ Form::file('photo_path') }}
		    	{{ Form::submit('Send') }}
			{{ Form::close() }}
		</div>

@endsection
