@extends('layouts.base')

@section('content')
    <div data-app>
        <user-index-component
            :users="{{json_encode($users)}}"
        >
        </user-index-component>
    </div>
@endsection
