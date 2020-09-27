@extends('layouts.base')

@section('content')
    <div data-app>
        <currency-index-component
            :currencies="{{json_encode($currencies)}}"
        >
        </currency-index-component>
    </div>
@endsection
