@extends('admin.layouts.app')



@section('body')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="d-flex justify-content-between align-items-center my-4">
    <h2 class="my-4">Support Notifications</h2>
    <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
    </div>
    <div class="my-4">
        @if (count($messages) == 0)
            <p>No support messages found.</p>
        @else
            @foreach ($messages as $msg)
                <div class="border rounded p-3 mb-3">
                    <strong>{{ $msg->first_name }} {{ $msg->last_name }}</strong><br>
                    <small>Email: {{ $msg->email }}</small><br>
                    <small>Phone: {{ $msg->phone_number }}</small>
                    <p class="mt-2">{{ $msg->message }}</p>
                    <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
