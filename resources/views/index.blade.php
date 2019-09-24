@extends('layouts.app')

@section('content')
<div class="container">
    <div id="appVue">
        <indice></indice>
    </div>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection
