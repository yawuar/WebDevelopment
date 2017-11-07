@extends('layouts.app')

@section('content')

	<nav>
		
		<ul>
			
			<li><a href="{{ route('participants') }}">Participants</a></li>

			<li><a href="{{ route('contests.index') }}">Contests</a></li>

		</ul>

	</nav>

	<div class="jumbotron">

	    <h1>Administrator</h1>    

	    <p>As an administrator you can add new contest, change user permissions.</p>

	</div>

@endsection