@extends('layouts.base')

@section('content')
    <div data-app>
@if (Auth::user())
        <products-index-component
				:products="{{json_encode($products)}}"
				:currency="{{json_encode($currency)}}"
				:auth="true"
        >
        </products-index-component>
@else
        <products-index-component
				:products="{{json_encode($products)}}"
				:currency="{{json_encode($currency)}}"
				:auth="false"
        >
        </products-index-component>
@endif
    </div>
	@section('pagination')
		@include('vendor.pagination.main')
	@show
@endsection
