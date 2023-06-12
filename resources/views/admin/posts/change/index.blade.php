@extends('admin.layouts.main')
@section('content')
    @component('admin.layouts.partials.components.posteditor', [
        'posts' => $posts,
        'categories' => $categories,
        'type' => 'change',
    ])
    @endcomponent
@endsection
