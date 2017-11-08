@extends('layouts.app')

@section('content')

	<nav>
		
		<ul>
			
			<li><a href="{{ route('participants') }}">Participants</a></li>

			<li><a href="{{ route('contests.index') }}">Contests</a></li>

		</ul>

	</nav>

	<div class="col-md-12 col-md-offset-1">

		<table id="table" class="table table-bordred table-striped">
                   
            <thead>
            
	            <th>First Name</th>

	            <th>Last Name</th>

	            <th>Address</th>

	            <th>Email</th>

	            <th>Disqualify</th>

	            <th>Admin</th>
	               
	            <th>Delete</th>

            </thead>

	    	<tbody>

	    		@foreach($users as $user)
	    
				    <tr>
					    <td>{{ $user['firstname'] }}</td>

					    <td>{{ $user['lastname'] }}</td>

					    <td>{{ $user['address'] . ' ' . $user['number'] . ', ' . $user['zipcode'] .' ' . $user['city'] }}</td>

					    <td>{{ $user['email'] }}</td>

					    <td>
					    	
					    	<a class="{{ ($user['disqualified'] == 1) ? 'disqualified' : 'notdisqualified' }}" href="{{ route('participants.disqualify', ['user_id' => $user['user_id']]) }}">
					    		
					    	</a>

					    </td>

					    <td>

					    	<a class="{{ ($user['is_admin'] == 1) ? 'admin' : 'user' }}" href="{{ route('participants.change', ['user_id' => $user['user_id']]) }}">
							
							</a>

						</td>

					    <td>

							<a class="remove" href="{{ route('participants.delete', ['user_id' => $user['user_id']]) }}" class="delete_btn">

							</a>
		
					    </td>

				    </tr>

				@endforeach

		    </tbody>
	        
		</table>

		<a class="participants" href="{{ route('participants.excel') }}">Export Participants</a>

	</div>

@endsection