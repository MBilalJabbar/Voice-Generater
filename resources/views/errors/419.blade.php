@extends('layouts.app')

@section('body')
<div class="text-center" style="padding:50px;">
    <h2>Session Expired</h2>
    <p>Your session has expired. Please login again.</p>
    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Login Again</a>
</div>
@endsection
