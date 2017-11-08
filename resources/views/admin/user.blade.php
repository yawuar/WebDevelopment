@extends('layouts.app')

@section('content')

	<nav>
		
		<ul>
			
			<li><a href="{{ route('participants') }}">Participants</a></li>

			<li><a href="{{ route('contests.index') }}">Contests</a></li>

		</ul>

	</nav>

	<div class="col-md-12 col-md-offset-1">

		<ul class="list-group">

			@foreach($users as $user)

				<li class="list-group-item">

					<div class="inner_content">

						<div class="title">

		  					<h4>{{ $user['firstname'] }} {{ $user['lastname'] }}</h4>

			  			</div>

			  			<div class="created_at pull-right">

			  				{{ Carbon\Carbon::parse($user['created_at'])->format('F d, Y') }}

			  			</div>

			  			<div class="buttons pull-right">

							<a class="{{ ($user['disqualified'] == 1) ? 'disqualified' : 'notdisqualified' }}" href="{{ route('participants.disqualify', ['user_id' => $user['user_id']]) }}">

					          <span class="glyphicon glyphicon-remove"></span>

					        </a>

					        <a class="{{ ($user['is_admin'] == 1) ? 'admin' : 'user' }}" href="{{ route('participants.change', ['user_id' => $user['user_id']]) }}">

					          <span class="glyphicon glyphicon-user"></span>

					        </a>

			  			</div>

					</div>

					<a href="{{ route('participants.delete', ['user_id' => $user['user_id']]) }}" class="delete_btn">

						hallo

					</a>

		  		</li>

			@endforeach

		</ul>

	</div>

@endsection