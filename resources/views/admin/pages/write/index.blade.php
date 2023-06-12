@extends('admin.layouts.main')
@section('content')
    @component('admin.layouts.partials.components.pageseditor', [
        'pages' => '',
        'type' => 'write',
    ])
    @endcomponent
@endsection
