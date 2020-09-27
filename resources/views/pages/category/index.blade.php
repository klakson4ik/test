@extends('layouts.base')

@section('content')
    <div data-app>
        <category-index-component
            :categories="{{json_encode($categories)}}"
            :category-nesting = "{{json_encode($categoryNesting)}}"
        >
        </category-index-component>
    </div>
@endsection
