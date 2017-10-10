<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		   	{{ Form::open(array('url' => route('contests.add'), 'files' => true, 'method' => $type)) }}
		    <div class="modal-body">
		      	{{ Form::token() }}
		        {{ Form::label('title', 'Title') }}
				{{ Form::text('title', ($type == 'put') ? $contest['title'] : '', array('required' => 'required')) }}

				{{ Form::label('content', 'Content') }}
				{{ Form::text('content', ($type == 'put') ? $contest['content'] : '', array('required' => 'required')) }}

				{{ Form::label('starting_date', 'Starting Date') }}
				{{ Form::date('starting_date', ($type == 'put') ? $contest['starting_date'] : '') }}

				{{ Form::label('ending_date', 'Ending Date') }}
				{{ Form::date('ending_date', ($type == 'put') ? $contest['ending_date'] : '') }}

				{{ Form::label('photo_path', 'Photo') }}
				{{ Form::file('photo_path', array('required' => 'required')) }}
		    </div>
		    <div class="modal-footer">
		    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        {{ Form::submit('Save')}}
		    </div>
		    {{ Form::close() }}
		</div>
	</div>
</div>