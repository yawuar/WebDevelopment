@extends('layouts.app')

@section('content')

	<div class="jumbotron edit">

			{{ Form::open(array('url' => route('contests.add'), 'method' => 'post', 'files' => true)) }}

				<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">

	                {{ Form::label('title', 'Title') }}

	                    <div class="col-md-12">

	                        {{ Form::text('title', '', array('required' => 'required')) }}

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

	                    {{ Form::textarea('content', '', array('required' => 'required')) }}

	                    @if ($errors->has('content'))

	                        <span class="help-block">

	                            <strong>{{ $errors->first('content') }}</strong>

	                        </span>

	                    @endif

	                </div>

	            </div>

	            <div class="form-group{{ $errors->has('photo_path') ? ' has-error' : '' }}">

	                <div class="col-md-12">

	                    {{ Form::file('photo_path', array('required' => 'required')) }}

	                    @if ($errors->has('photo_path'))

	                        <span class="help-block">

	                            <strong>{{ $errors->first('photo_path') }}</strong>

	                        </span>

	                    @endif

	                </div>

	            </div>

	            <div class="form-group{{ $errors->has('starting_date') ? ' has-error' : '' }}">

	                {{ Form::label('starting_date', 'Starting Date') }}

	                <div class="col-md-12">

	                    {{ Form::datetime('starting_date', '', array('class' => 'datepicker', 'required' => 'required')) }}

	                    @if ($errors->has('starting_date'))

	                        <span class="help-block">

	                            <strong>{{ $errors->first('starting_date') }}</strong>

	                        </span>

	                    @endif

	                </div>

	            </div>

	            <div class="form-group{{ $errors->has('ending_date') ? ' has-error' : '' }}">

	                {{ Form::label('ending_date', 'Ending Date') }}

	                <div class="col-md-12">

	                    {{ Form::datetime('ending_date', '', array('class' => 'datepicker', 'required' => 'required')) }}

	                    @if ($errors->has('ending_date'))

	                        <span class="help-block">

	                            <strong>{{ $errors->first('ending_date') }}</strong>

	                        </span>

	                    @endif

	                </div>

	            </div>

	            <div class="form-group{{ $errors->has('responsible') ? ' has-error' : '' }}">

	                {{ Form::label('responsible', 'Responsible') }}

	                <div class="col-md-12">

	                    <select name="responsible" id="responsible">

	                    	@foreach($responsibles as $responsible)
								
								<option value="{{ $responsible['user_id'] }}">{{ $responsible['firstname'] }}</option>

	                    	@endforeach

	                    </select>

	                    @if ($errors->has('responsible'))

	                        <span class="help-block">

	                            <strong>{{ $errors->first('responsible') }}</strong>

	                        </span>

	                    @endif

	                </div>

	            </div>

			 	{{ Form::submit('Update') }}

			{{ Form::close() }}
	</div>

@endsection