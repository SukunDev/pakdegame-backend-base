@extends('admin.layouts.main')
@section('content')
    @component('admin.layouts.partials.components.pageseditor', [
        'pages' => $pages,
        'type' => 'change',
    ])
    @endcomponent
@endsection
