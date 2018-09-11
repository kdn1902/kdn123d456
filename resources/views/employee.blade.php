@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$empl->lastname}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<div id=app>
 							<employee-component :empl='{!! $empl !!}' ></employee-component>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
