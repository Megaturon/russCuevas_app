@extends('layouts.portal')

@section('title', 'My Appointments')

@section('content')
<div class="portal-header">
    My Appointments
</div>

<div class="portal-card">
    @if($appointments->count() > 0)
        <table class="portal-table">
            <thead>
                <tr>
                    <th>Service Type</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $app)
                <tr>
                    <td>
                        <div style="font-weight: 600;">Fitting / Consultation</div>
                        @if($app->notes)
                        <div style="font-size: 0.75rem; color: #888; margin-top: 4px; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $app->notes }}</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 500;">{{ \Carbon\Carbon::parse($app->date)->format('F j, Y') }}</div>
                        <div style="font-size: 0.75rem; color: #888; margin-top: 2px; text-transform: uppercase; letter-spacing: 1px;">{{ \Carbon\Carbon::parse($app->time)->format('g:i A') }}</div>
                    </td>
                    <td>
                        <span class="status-pill status-{{ strtolower($app->status ?? 'pending') }}">
                            {{ $app->status ?? 'Pending' }}
                        </span>
                    </td>
                    <td>
                        @if(($app->status ?? 'Pending') === 'Confirmed')
                            @php
                                $ref = 'RC-APP-' . str_pad($app->id, 5, '0', STR_PAD_LEFT);
                            @endphp
                            <a href="{{ route('receipts.show', $ref) }}" class="btn-secondary">View Receipt</a>
                        @elseif(($app->status ?? 'Pending') === 'Cancelled')
                            <span style="font-size: 0.75rem; color: #aaa; font-style: italic;">No actions available</span>
                        @else
                            <span style="font-size: 0.75rem; color: #aaa; font-style: italic;">Pending Admin Review</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <h3 style="font-size: 2rem; margin-bottom: 1rem; color: #ddd;">&mdash;</h3>
            <h3>No Appointments Yet</h3>
            <p>You haven't scheduled any fitting or consultation sessions with us. Begin your bespoke journey today.</p>
            <a href="{{ route('appointments.index') }}" class="btn-primary">Book an Appointment</a>
        </div>
    @endif
</div>
@endsection
