@extends('layouts.contest')

@section('content')
	
		@foreach($contestPhotos as $contestPhoto)
			<div class="col-md-4">
			    	<div class="post-module">
			      		<div class="thumbnail" style="background-image: url({{ $contestPhoto['photo_path']  }});">
			      			@if(Auth::check())
								@if(Auth::user()->user_id == $contestPhoto['user_id'])
									<!-- show it's your photo button -->
								@else
									{{ Form::open(array('url' => route('votes.storeLike', ['id' => $contestPhoto['contest_photos_id']]), 'class' => 'like')) }}
								    	{!! Form::submit('like', ['onclick' => 'return confirm("Are you sure?");']) !!}
									{{ Form::close() }}

									{{ Form::open(array('url' => route('votes.storeSuperLike', ['id' => $contestPhoto['contest_photos_id']]), 'class' => 'like superlike')) }}
								    	{!! Form::submit('superLike', ['onclick' => 'return confirm("Are you sure?");']) !!}
									{{ Form::close() }}
								@endif
							@endif
			      		</div>
			      	<div class="post-content">
			        	<h1 class="title">{{ ucfirst($contestPhoto['title']) }}</h1>
			        	<p class="description">{{ $contestPhoto['content'] }}</p>
			        	<div class="post-meta">
			        		<span class="timestamp">{{ Carbon\Carbon::parse($contestPhoto['created_at'])->format('F d, Y') }}</span>
			        	</div>
			      	</div>
			      </div>
			</div>
		@endforeach

		<div class="col-md-4">
			<div class="post-module form">
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
		</div>

@endsection
