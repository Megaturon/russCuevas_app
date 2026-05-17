@extends('layouts.portal')

@section('title', 'My Quote Requests')

@section('content')
<div class="portal-header">
    <i class="fas fa-file-invoice-dollar text-gray-400"></i> My Quote Requests
</div>

<div class="portal-card">
    @if($quotes->count() > 0)
        <table class="portal-table">
            <thead>
                <tr>
                    <th>Service & Details</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotes as $quote)
                <tr>
                    <td>
                        <div class="font-medium text-sm">{{ $quote->service_type }}</div>
                        <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $quote->details }}</div>
                    </td>
                    <td>
                        <div class="font-medium text-sm">{{ $quote->created_at->format('F j, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $quote->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        <span class="status-pill status-{{ strtolower($quote->status) }}">
                            {{ $quote->status }}
                        </span>
                    </td>
                    <td>
                        @if($quote->status === 'Quoted' && $quote->token)
                            <a href="{{ route('checkout.pay', $quote->token) }}" class="btn-primary text-xs py-2 px-3">View Quote & Pay</a>
                        @elseif($quote->status === 'Accepted' || $quote->status === 'Paid')
                            @php
                                $ref = 'RC-QTE-' . str_pad($quote->id, 5, '0', STR_PAD_LEFT);
                            @endphp
                            <a href="{{ route('receipts.show', $ref) }}" class="btn-secondary text-xs py-2 px-3">View Receipt</a>
                        @else
                            <span class="text-xs text-gray-400 italic">No actions available</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="far fa-clipboard"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No quote requests yet</h3>
            <p>You haven't requested any bespoke quotations. Describe your dream design to get started.</p>
            <a href="{{ route('quote.index') }}" class="btn-primary">Get a Quote &rarr;</a>
        </div>
    @endif
</div>
@endsection
