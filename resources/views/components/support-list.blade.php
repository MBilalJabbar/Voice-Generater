@if(count($messages) == 0)
    <p>No support messages found.</p>
@else
    @foreach($messages as $msg)
        <div class="border rounded p-3 mb-3">
            <strong>{{ $msg->first_name }} {{ $msg->last_name }}</strong><br>
            <small>Email: {{ $msg->email }}</small><br>
            <small>Phone: {{ $msg->phone_number }}</small>
            <p class="mt-2">{{ $msg->message }}</p>
            <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
@endif
