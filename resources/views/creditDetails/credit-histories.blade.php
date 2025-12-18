@extends('layouts.app')


@section('title')
    Credit Histories
@endsection

@section('body')
    <div class="container mt-4">
        <h4>Credits Details</h4>

        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Expiry Date</th>
                    <th>Purchase Date</th>
                </tr>
            </thead>

            <tbody>
    @forelse ($credits as $credit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ number_format($credit->total_credits ?? 0) }}</td>
            <td>
                @if ($credit->status === 'available')
                    <span class="badge bg-success">Available</span>
                @else
                    <span class="badge bg-secondary">Expired</span>
                @endif
            </td>
            <td>{{ $credit->expiry_date ? \Carbon\Carbon::parse($credit->expiry_date)->format('d M Y, H:i') : '-' }}</td>
            <td>{{ $credit->purchase_date ? \Carbon\Carbon::parse($credit->purchase_date)->format('d M Y, H:i') : '-' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No credits found.</td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>
@endsection
