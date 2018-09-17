@extends('layouts.app')

@section('content')
	 <div class="container">
	     <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employees</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
  						{{ session('status') }}
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    						<span aria-hidden="true">&times;</span>
  						</button>
					</div>
                    @endif
				<employees-component></employees-component>
		        </div>
            </div>
        </div>
    </div>
 	</div>
@endsection
