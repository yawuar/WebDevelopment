@extends('layouts.app')
@section('content')
	<div class="col-md-10 col-md-offset-1">
		<ul class="list-group">
			@foreach($users as $user)
				<li class="list-group-item">
		  			<div class="title">
		  				<h4>{{ $user['firstname'] }} {{ $user['lastname'] }}</h4>
		  			</div>
		  			<div class="address">
		  				{{ $user['address'] }} {{ $user['number'] }}, {{ $user['zipcode'] }} {{ $user['city'] }} 
		  			</div>
		  			<div class="created_at pull-right">
		  				{{ Carbon\Carbon::parse($user['created_at'])->format('F d, Y') }}
		  			</div>
		  			<div class="buttons pull-right">
						<a class="remove" href="{{ route('participants.delete', ['user_id' => $user['user_id']]) }}">
				          <span class="glyphicon glyphicon-remove"></span>
				        </a>
				        <a class="{{ ($user['is_admin'] == 1) ? 'admin' : 'user' }}" href="{{ route('participants.change', ['user_id' => $user['user_id']]) }}">
				          <span class="glyphicon glyphicon-user"></span>
				        </a>
		  			</div>
		  		</li>
			@endforeach
		</ul>
	</div>
@endsection