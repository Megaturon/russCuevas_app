@extends('layouts.portal')

@section('title', 'My Receipts')

@section('content')
<div class="portal-header" style="margin-top: 30px">
    My Receipts
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
                        <div style="font-weight: 600; font-family: var(--font-inter, sans-serif); letter-spacing: 1px;">{{ $receipt->reference }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $receipt->service }}</div>
                        <div style="font-size: 0.75rem; color: #888; margin-top: 4px; text-transform: uppercase; letter-spacing: 1px;">{{ $receipt->type }}</div>
                    </td>
                    <td>
                        <div style="font-weight: 500;">{{ \Carbon\Carbon::parse($receipt->date_issued)->format('M j, Y') }}</div>
                    </td>
                    <td>
                        @if($receipt->amount)
                            <div style="font-weight: 600;">₱{{ number_format($receipt->amount, 2) }}</div>
                        @else
                            <div style="font-size: 0.75rem; color: #aaa; font-style: italic;">No Charge</div>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('receipts.show', $receipt->reference) }}" class="btn-secondary">View</a>
                            <a href="{{ route('receipts.show', ['reference' => $receipt->reference, 'download' => 'pdf']) }}" class="btn-primary" style="padding: 0.6rem 1.2rem; font-size: 0.7rem;"><i class="fas fa-download" style="margin-right: 6px;"></i> PDF</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <h3 style="font-size: 2rem; margin-bottom: 1rem; color: #ddd;">&mdash;</h3>
            <h3>No Receipts Yet</h3>
            <p>Your transaction records will appear here automatically once a payment is processed or an appointment is confirmed.</p>
        </div>
    @endif
</div>
@endsection
