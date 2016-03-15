@extends('templates.default')

@section('content')

	@if ($session->has('info'))
		<div class="alert alert-info" role="alert">
			{{ $session->remove('info') }}
		</div>
	@endif

	<h3>Welcome to Application</h3>
	<p> To proceed further kindly add your Device Id</p>

	<form class="form-vertical" role="form" method="post" action="#">
		<div class="form-group{{ $errors->has('deviceId') ? ' has-error' : ''}} ">
			<label for="deviceId" class="control-label">Device Number</label>
			<input type="text" name="deviceId" class="form-control" id="deviceId" value="{{ Request::old('deviceId')? :''}}">
			<button type="submit" class="btn btn-default">Add Device</button>
		</div>

	</form>
@stop