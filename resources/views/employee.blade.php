@extends('layouts.app')

@section('content')
<div class="container">
	<div id=app>
		<employee-component employee='{!! $empl !!}' ></employee-component>
	</div>
@endsection
