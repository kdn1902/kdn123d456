@extends('layouts.app')

@section('content')
<div class="container">
	<div id=app>
		<employee-component :empl='{!! $empl !!}' ></employee-component>
	</div>
@endsection
