@extends('layouts.portal')

@section('title', 'My Receipts')

@section('content')
<div class="portal-header">
    <i class="fas fa-receipt text-gray-400"></i> My Receipts
</div>

<div class="portal-card">
    @if($receipts->count() > 0)
        <table class="portal-table">
            <thead>
                <tr>
                    <th>Reference No.</th>
                    <th>Service</th>
                    <th>Date Issued</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($receipts as $receipt)
                <tr>
                    <td>
                        <div class="font-bold text-gray-800 text-sm tracking-wider">{{ $receipt->reference }}</div>
                    </td>
                    <td>
                        <div class="font-medium text-sm">{{ $receipt->service }}</div>
                        <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">{{ $receipt->type }}</div>
                    </td>
                    <td>
                        <div class="font-medium text-sm">{{ \Carbon\Carbon::parse($receipt->date_issued)->format('M j, Y') }}</div>
                    </td>
                    <td>
                        @if($receipt->amount)
                            <div class="font-bold text-gray-900">₱{{ number_format($receipt->amount, 2) }}</div>
                        @else
                            <div class="text-sm text-gray-500 italic">No Charge</div>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('receipts.show', $receipt->reference) }}" class="btn-secondary text-xs py-2 px-3 text-center inline-block">View</a>
                            <a href="{{ route('receipts.show', ['reference' => $receipt->reference, 'download' => 'pdf']) }}" class="btn-primary text-xs py-2 px-3 text-center inline-block"><i class="fas fa-download mr-1"></i> PDF</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="fas fa-file-invoice"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No receipts yet</h3>
            <p>They will appear here automatically after a confirmed appointment or an accepted quote.</p>
        </div>
    @endif
</div>
@endsection
