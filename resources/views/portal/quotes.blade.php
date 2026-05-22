@extends('layouts.portal')

@section('title', 'My Quote Requests')

@section('content')
<div class="portal-header">
    My Quote Requests
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
                        <div style="font-weight: 600;">{{ $quote->service_type }}</div>
                        <div style="font-size: 0.75rem; color: #888; margin-top: 4px; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $quote->details }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 500;">{{ $quote->created_at->format('F j, Y') }}</div>
                        <div style="font-size: 0.75rem; color: #888; margin-top: 2px; text-transform: uppercase; letter-spacing: 1px;">{{ $quote->created_at->diffForHumans() }}</div>
                    </td>
                    <td>
                        @php
                            $statusClass = strtolower(str_replace(' ', '-', $quote->status));
                        @endphp
                        <span class="status-pill status-{{ $statusClass }}">
                            {{ $quote->status }}
                        </span>
                    </td>
                    <td>
                        @if($quote->status === 'Quoted' && $quote->token)
                            <a href="{{ route('checkout.pay', $quote->token) }}" class="btn-primary">View Quote & Pay</a>
                        @elseif($quote->status === 'Partially Paid' || $quote->status === 'Paid')
                            @php
                                $ref = 'RC-QTE-' . str_pad($quote->id, 5, '0', STR_PAD_LEFT);
                            @endphp
                            <a href="{{ route('receipts.show', $ref) }}" class="btn-secondary">View Receipt</a>
                        @else
                            <span style="font-size: 0.75rem; color: #aaa; font-style: italic;">No actions available</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <h3 style="font-size: 2rem; margin-bottom: 1rem; color: #ddd;">&mdash;</h3>
            <h3>No Quote Requests</h3>
            <p>You haven't requested any bespoke quotations. Describe your dream design and let us bring it to life.</p>
            <a href="{{ route('quote.index') }}" class="btn-primary">Get a Quote</a>
        </div>
    @endif
</div>
@endsection
