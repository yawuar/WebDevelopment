@extends('layouts.contest')

@section('content')
	
		@foreach($contestPhotos as $contestPhoto)
			<div class="col-sm-4 equal-height">
				<div style="background-image: url('{{ $contestPhoto['photo_path'] }}');"></div>
				@if(Auth::check())
					@if(Auth::user()->user_id == $contestPhoto['user_id'])
						<p>You can't like this photo because it's yours</p>
					@else
						{{ Form::open(array('url' => route('votes.storeLike', ['id' => $contestPhoto['contest_photos_id']]))) }}
					    	{!! Form::submit('like', ['onclick' => 'return confirm("Are you sure?");']) !!}
						{{ Form::close() }}

						{{ Form::open(array('url' => route('votes.storeSuperLike', ['id' => $contestPhoto['contest_photos_id']]))) }}
					    	{!! Form::submit('superLike', ['onclick' => 'return confirm("Are you sure?");']) !!}
						{{ Form::close() }}
					@endif
				@endif
			</div>
		@endforeach

		<div class="col-md-4 equal-height">
			@if(Auth::check())
				{{ Form::open(array('url' => route('contest.store'), 'files' => true)) }}
			    	{{ Form::text('title', '', array('required' => 'required')) }}
			    	{{ Form::text('content', '', array('required' => 'required')) }}
			    	{{ Form::file('photo_path', array('required' => 'required')) }}
			    	{{ Form::submit('Send') }}
				{{ Form::close() }}
			@else
				<h4>You have to login <a href="{{ route('login') }}">login</a></h4>
			@endif
		</div>

@endsection
