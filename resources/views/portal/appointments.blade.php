@extends('layouts.portal')

@section('title', 'My Appointments')

@section('content')
<div class="portal-header">
    <i class="far fa-calendar-alt text-gray-400"></i> My Appointments
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
                        <div class="font-medium">Fitting / Consultation</div>
                        @if($app->notes)
                        <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $app->notes }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="font-medium">{{ \Carbon\Carbon::parse($app->date)->format('F j, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($app->time)->format('g:i A') }}</div>
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
                            <a href="{{ route('receipts.show', $ref) }}" class="btn-secondary text-xs py-2 px-3">View Receipt</a>
                        @elseif(($app->status ?? 'Pending') === 'Cancelled')
                            <span class="text-xs text-gray-400 italic">No actions available</span>
                        @else
                            <span class="text-xs text-gray-400 italic">Pending Admin Review</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            <i class="far fa-calendar-times"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No appointments found</h3>
            <p>You have no appointments yet. Schedule your first fitting or consultation today.</p>
            <a href="{{ route('appointments.index') }}" class="btn-primary">Book an Appointment &rarr;</a>
        </div>
    @endif
</div>
@endsection
