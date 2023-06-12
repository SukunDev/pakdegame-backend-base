@extends('admin.layouts.main')
@section('content')
    @component('admin.layouts.partials.components.posteditor', [
        'posts' => '',
        'categories' => $categories,
        'type' => 'write',
    ])
    @endcomponent
@endsection
