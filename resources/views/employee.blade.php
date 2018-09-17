@extends('layouts.app')

@section('content')
<div class="container">
		<employee-component employee='{!! $empl !!}' ></employee-component>
</div>
@endsection
