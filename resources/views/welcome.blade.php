@extends('layouts.app')

@section('title', 'Blox Shop')

@section('content')
    @include('partials.navbar')

    <div id="shopSection">
        @include('partials.hero')
        @include('partials.history-modal')
        @include('partials.product-grid')
        @include('partials.cart-sidebar')
        @include('partials.login-modal')
    </div>

    @include('partials.founder-section')
    @include('partials.footer')
@endsection

@push('scripts')
    @if(session('error'))
        window.App.flash = { type: 'error', message: @json(session('error')) };
    @endif
    @if(session('success'))
        window.App.flash = { type: 'success', message: @json(session('success')) };
    @endif
@endpush
