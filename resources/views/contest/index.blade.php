@extends('layouts.contest')

@section('content')
	
		@foreach($contestPhotos as $contestPhoto)
			<div class="col-md-4">
				{{-- @if(Auth::check())
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
				@endif --}}
			    	<div class="post-module">
			      		<div class="thumbnail">
			        		<div class="like">
			        		</div>
			        		<img src="{{ url($contestPhoto['photo_path']) }}" alt="{{ $contestPhoto['title'] }}"/>
			      		</div>
			      	<div class="post-content">
			        	<h1 class="title">{{ $contestPhoto['title'] }}</h1>
			        	<p class="description">{{ $contestPhoto['content'] }}</p>
			        	<div class="post-meta">
			        		<span class="timestamp">{{ $contestPhoto['created_at'] }}</span>
			        	</div>
			      	</div>
			      </div>
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
{{-- 
<script>
	$(window).load(function() {
	  $('.post-module').hover(function() {
	    $(this).find('.description').stop().animate({
	      height: "toggle",
	      opacity: "toggle"
	    }, 300);
	  });
	});
</script> --}}
