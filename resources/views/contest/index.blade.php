@extends('layouts.contest')

@section('content')
	
		@foreach($contestPhotos as $contestPhoto)

			<div class="col-xs-12 col-sm-6 col-md-4">

			    <div class="post-module">

			      	<div class="thumbnail" style="background-image: url({{ $contestPhoto['photo_path']  }});">

			      		<div class="likes"><span></span>{{ $contestPhoto['likes']  }}</div>

			      		<div class="superlikes"><span></span>{{ $contestPhoto['superlikes']  }}</div>

			      	</div>

			      	<div class="post-content">

			      		<div class="inner">

			      			<h1 class="title">{{ ucfirst($contestPhoto['title']) }}</h1>

				        	<p class="description">{{ $contestPhoto['content'] }}</p>

				        	<div class="post-meta">

				        		<div class="user">

				        			@if($contestPhoto->user()['photo_path'] != null)

				        				<img src="{{ $contestPhoto->user()['photo_path'] }}" alt="{{ $contestPhoto->user()['firstname'] }}" width="35" height="35">
				        			@else

				        				<img src="{{ url('/images/users/avatar.png') }}" alt="avatar" width="35" height="35">

				        			@endif

				        			<p>{{ $contestPhoto->user()['firstname'] . ' ' . $contestPhoto->user()['lastname'] }}</p>

				        		</div>

				        	</div>

			      		</div>

			      		<div class="post-likes">

				      		@if(Auth::check())

								@if(Auth::user()->user_id == $contestPhoto['user_id'])

									<span>Your photo</span>

								@else

									@if($contestPhoto->votes()->where('user_id', Auth::user()->user_id)->get()->first()['isLiked'] == 1)

										{{ Form::open(array('url' => route('votes.unLike', ['id' => $contestPhoto['contest_photos_id']]), 'class' => 'like', 'method' => 'delete')) }}

											{!! Form::submit('unlike', ['onclick' => 'return confirm("Are you sure?");', 'class' => ($contestPhoto->votes()->where('user_id', Auth::user()->user_id)->get()->first()['like'] == 1) ? 'full_heart' : 'heart']) !!}

											{{ Form::close() }}

											{{ Form::open(array('url' => route('votes.storeSuperLike', ['id' => $contestPhoto['contest_photos_id']]), 'class' => 'like superlike')) }}

											{!! Form::submit('superLike', ['onclick' => 'return confirm("Are you sure?");', 'class' => (count($contestPhoto->votes()->where('user_id', Auth::user()->user_id)->where('super_like', 1)->get()) == 1) ? 'full_star' : 'star']) !!}

										{{ Form::close() }}

									@else

										{{ Form::open(array('url' => route('votes.storeLike', ['id' => $contestPhoto['contest_photos_id']]), 'class' => 'like')) }}

											{!! Form::submit('like', ['onclick' => 'return confirm("Are you sure?");', 'class' => 'heart']) !!}

											{{ Form::close() }}

											{{ Form::open(array('url' => route('votes.storeSuperLike', ['id' => $contestPhoto['contest_photos_id']]), 'class' => 'like superlike')) }}

											{!! Form::submit('superLike', ['onclick' => 'return confirm("Are you sure?");', 'class' => (count($contestPhoto->votes()->where('user_id', Auth::user()->user_id)->where('super_like', 1)->get()) == 1) ? 'full_star' : 'star']) !!}

										{{ Form::close() }}

									@endif

								@endif

							@endif

				    	</div>

			      	</div>

			    </div>

			</div>

		@endforeach

		<div class="col-xs-12 col-sm-6 col-md-4">

			<div class="post-module form">

				<div class="panel panel-default">

					<div class="panel-body">

					@if(Auth::check())

						{{ Form::open(array('url' => route('contest.store'), 'files' => true)) }}

							<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">

	                            {{ Form::label('title', 'Title') }}

	                            <div class="col-md-12">

	                                {{ Form::text('title', '', array('value' => old('firstname'), 'required' => 'required')) }}

	                                @if ($errors->has('title'))

	                                    <span class="help-block">

	                                        <strong>{{ $errors->first('title') }}</strong>

	                                    </span>

	                                @endif

	                            </div>

	                        </div>

	                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">

	                            {{ Form::label('content', 'Content') }}

	                            <div class="col-md-12">

	                                {{ Form::text('content', '', array('value' => old('content'), 'required' => 'required')) }}

	                                @if ($errors->has('content'))

	                                    <span class="help-block">

	                                        <strong>{{ $errors->first('content') }}</strong>

	                                    </span>

	                                @endif

	                            </div>

	                        </div>

	                        <div class="form-group{{ $errors->has('photo_path') ? ' has-error' : '' }}">

	                            <div class="col-md-12">

	                                {{ Form::file('photo_path', array('value' => old('photo_path'), 'required' => 'required')) }}

	                                @if ($errors->has('photo_path'))

	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('photo_path') }}</strong>

	                                    </span>

	                                @endif

	                            </div>

	                        </div>
	                        
					    	{{ Form::submit('Send') }}

						{{ Form::close() }}

					@else

						<h4>You have to login.</h4>

						<a href="{{ route('login') }}">login</a>

					@endif

					</div>

				</div>

			</div>

		</div>

@endsection
