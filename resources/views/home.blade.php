@extends('layouts.app')

@section('content')
<div id=app>
	 <div class="container">
	     <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employees</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
				<employees-component></employees-component>
		        </div>
            </div>
        </div>
    </div>
 	</div>
</div>
@endsection
