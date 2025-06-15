@include('layout/head')
{{-- NAVBAR berdasarkan guard --}}
@if(Auth::guard('bidan')->check())
    @include('layout/navbar-bidan')
@elseif(Auth::guard('kader')->check())
    @include('layout/navbar-kader')
@endif

{{-- HEADER berdasarkan guard --}}
@if(Auth::guard('bidan')->check())
    @include('layout/header-bidan')
@elseif(Auth::guard('kader')->check())
    @include('layout/header-kader')
@endif

@include($content)
@include('layout/footer')

