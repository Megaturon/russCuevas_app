<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Manage Appointments, Quotes & Users</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f1f3f5;
            padding: 30px;
        }
<<<<<<< Updated upstream
        h1 {
            text-align: center;
            color: #000;
            padding: 15px 0;
            font-family: 'Georgia', serif;
            font-size: 28px;
            border-radius: 5px;
=======

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--grey-light);
        }
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--grey-text);
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: var(--black);
            color: var(--white);
            display: flex;
            flex-direction: column;
            z-index: 10;
        }

        .sidebar-header {
            padding: 25px 24px;
            border-bottom: 1px solid var(--grey-dark);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sidebar-header h2 {
            font-family: var(--font-sans);
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--white);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 30px 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 15px 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.85rem;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            border-left: 1px solid transparent;
            color: #999;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        .nav-item:hover {
            color: var(--white);
            background-color: rgba(255,255,255,0.03);
            padding-left: 35px;
        }

        .nav-item.active {
            color: var(--white);
            background-color: rgba(255,255,255,0.08);
            border-left-color: var(--white);
            padding-left: 35px;
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 20px 30px;
            border-top: 1px solid var(--grey-dark);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #999;
            text-decoration: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: color 0.3s;
        }

        .logout-btn:hover {
            color: var(--white);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background-color: var(--white);
        }

        .topbar {
            padding: 30px 40px;
            border-bottom: 1px solid var(--grey-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--white);
        }

        .topbar h1 {
            font-family: var(--font-sans);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--black);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .content-area {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            background-color: var(--white);
        }

        /* Pane Switching */
        .pane {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .pane.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Filter Container */
        .filter-container {
>>>>>>> Stashed changes
            margin-bottom: 30px;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px 5px 0 0;
            user-select: none;
        }
        .tab.active {
            background-color: #fff;
            border-bottom: none;
            font-weight: bold;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }

        table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        th {
<<<<<<< Updated upstream
            background: rgb(0, 0, 0);
            color: white;
=======
            font-family: var(--font-sans);
            color: var(--black);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 15px 20px;
            border-bottom: 2px solid var(--black);
        }

        td {
            padding: 20px;
            font-size: 0.85rem;
            color: var(--grey-dark);
            border-bottom: 1px solid var(--grey-border);
            vertical-align: top;
            line-height: 1.5;
        }

        tr {
            transition: background-color 0.2s ease;
        }

        tr:hover td {
            background-color: #fafafa;
        }

        strong {
            color: var(--black);
            font-weight: 600;
        }

        /* Status Pills (Minimalist Tags) */
        .status-pill {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--black);
            background-color: transparent;
            color: var(--black);
            white-space: nowrap;
        }

        .status-Confirmed { 
            background-color: var(--black); 
            color: var(--white); 
            border-color: var(--black);
        }
        
        .status-Rescheduled { 
            background-color: var(--grey-dark);
            color: var(--white);
            border-color: var(--grey-dark);
        }
        
        .status-Cancelled { 
            background-color: var(--grey-border);
            color: var(--grey-text);
            border-color: var(--grey-border);
            text-decoration: line-through;
            opacity: 0.7;
        }
        
        .status-Pending { 
            background-color: var(--white);
            color: var(--black);
            border: 1.5px solid var(--black);
        }

        /* Inputs & Buttons */
        .table-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
>>>>>>> Stashed changes
        }

        input[type="date"], input[type="time"], input.price-quote-input {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input.price-quote-input {
            width: 100px;
            margin-right: 6px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            vertical-align: middle;
            padding: 0;
        }

        /* Buttons */
        .btn {
<<<<<<< Updated upstream
            padding: 8px 12px;
            margin: 2px;
=======
            padding: 8px 16px;
            border: 1px solid var(--black);
            background: transparent;
            color: var(--black);
            font-family: var(--font-sans);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn:active {
            transform: scale(0.96);
        }

        .btn-primary { background-color: var(--black); color: var(--white); }
        .btn-primary:hover { background-color: transparent; color: var(--black); }
        
        .btn-secondary { border-color: var(--grey-border); color: var(--grey-text); }
        .btn-secondary:hover { border-color: var(--black); color: var(--black); background: transparent; }

        .btn-danger { border-color: var(--black); color: var(--black); }
        .btn-danger:hover { background-color: var(--black); color: var(--white); }

        .btn-success { background-color: var(--black); color: var(--white); }
        .btn-success:hover { background-color: transparent; color: var(--black); }

        .btn-warning { border-color: var(--black); color: var(--black); }
        .btn-warning:hover { background-color: var(--black); color: var(--white); }

        .custom-size-box {
            padding: 10px;
            border: 1px solid var(--grey-border);
            font-size: 0.75rem;
            line-height: 1.6;
            margin-top: 5px;
            background: var(--grey-light);
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        .modal-overlay.active {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background: var(--white);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid var(--grey-border);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
        }

        .modal-header {
            padding: 30px 40px;
            border-bottom: 1px solid var(--grey-border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            background: var(--white);
            z-index: 10;
        }

        .modal-header h2 {
            font-family: var(--font-sans);
            font-size: 1.25rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .close-modal-btn {
            background: none;
>>>>>>> Stashed changes
            border: none;
            border-radius: 6px;
            cursor: pointer;
<<<<<<< Updated upstream
            font-size: 0.9rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-reschedule {
            background-color: #5a5a5a;
            color: white;
            border: 1px solid #555;
        }
        .btn-reschedule:hover {
            background-color: #7d7d7d;
            box-shadow: 0 2px 4px rgba(0,0,0,0.4);
=======
            color: var(--grey-text);
            transition: color 0.3s;
        }
        .close-modal-btn:hover { color: var(--black); }

        .modal-body {
            padding: 40px;
        }

        .modal-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        @media(max-width: 768px) {
            .modal-grid { grid-template-columns: 1fr; }
        }

        .detail-group {
            margin-bottom: 25px;
        }

        .detail-label {
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--grey-text);
            margin-bottom: 8px;
            display: block;
        }

        .detail-value {
            font-size: 0.9rem;
            color: var(--black);
            line-height: 1.6;
        }

        /* KPI Cards Styling */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--grey-border);
            padding: 30px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .stat-card:hover {
            border-color: var(--black);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
>>>>>>> Stashed changes
        }

        .btn-confirm {
            background-color: #2e2e2e;
            color: white;
            border: 1px solid #444;
        }
        .btn-confirm:hover {
            background-color: #444;
            box-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .btn-cancel {
            background-color: #dcdcdc;
            color: #111;
            border: 1px solid #bbb;
        }
        .btn-cancel:hover {
            background-color: #cfcfcf;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .btn-delete {
            background-color: #555;
            color: white;
            border: 1px solid #444;
        }
        .btn-delete:hover {
            background-color: #444;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .btn-send-quote {
            background-color: #222;
            color: white;
            border: 1px solid #444;
        }
        .btn-send-quote:hover {
            background-color: #333;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        /* Status Styles */
        tr.row-status-Confirmed { background-color: #2e2e2e; color: #fff; }
        tr.row-status-Rescheduled { background-color: #5a5a5a; color: #fff; }
        tr.row-status-Cancelled { background-color: #dcdcdc; color: #111; }
        
        #filter-container {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        #filter-container label { font-weight: bold; }
        #filter-container input[type="date"] { padding: 5px; width: 160px; }
        #filter-container button {
            padding: 6px 14px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<h1>Manage Appointments, Quote Requests & Users</h1>

<<<<<<< Updated upstream
<div id="filter-container">
    <label for="filter-start-date">Start Date:</label>
    <input type="date" id="filter-start-date">
    <label for="filter-end-date">End Date:</label>
    <input type="date" id="filter-end-date">
    <button id="filter-btn">Filter</button>
    <button id="clear-filter-btn" onclick="location.reload()">Clear</button>
=======
<!-- Main Content -->
<main class="main-content">
    <header class="topbar">
        <h1 id="page-title">Appointments</h1>
    </header>

    <div class="content-area">

        <!-- Overview Pane -->
        <div class="pane active" id="overview">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Pending Revenue</span>
                    <span class="stat-value">₱{{ number_format($totalRevenuePending, 0) }}</span>
                    <div style="font-size: 0.7rem; color: var(--grey-text);">Total from sent quotes</div>
                </div>
                
                <div class="stat-card">
                    <span class="stat-label">Conversion Rate</span>
                    <span class="stat-value">{{ $conversionRate }}%</span>
                    <div style="font-size: 0.7rem; color: var(--grey-text);">Quotes to Appointments</div>
                </div>

                <div class="stat-card">
                    <span class="stat-label">Top Service</span>
                    <span class="stat-value" style="font-size: 1rem;">{{ $mostRequestedService ? $mostRequestedService->service_type : 'N/A' }}</span>
                    <div class="stat-chart-container">
                        <canvas id="serviceChart"></canvas>
                    </div>
                </div>

                <div class="stat-card">
                    <span class="stat-label">Weekly Traffic</span>
                    <div class="stat-chart-container">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Appointments Pane -->
        <div class="pane" id="appointments">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px; flex-wrap: wrap; gap: 20px;">
                <div class="filter-container" style="margin-bottom: 0;">
                    <div style="display: flex; gap: 10px;">
                        <button class="view-toggle-btn active" id="btn-list-view" onclick="switchAppointmentView('list')">List View</button>
                        <button class="view-toggle-btn" id="btn-calendar-view" onclick="switchAppointmentView('calendar')">Calendar View</button>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-left: 20px;">
                        <label for="filter-start-date">Filter Date:</label>
                        <input type="date" id="filter-start-date">
                        <input type="date" id="filter-end-date">
                        <button class="btn btn-primary" id="filter-btn" style="padding: 8px 15px;">Filter</button>
                    </div>
                </div>
                <div class="filter-container" style="margin-bottom: 0;">
                    <input type="text" id="appointment-search" placeholder="Search appointments..." onkeyup="filterTable('appointment-search', 'appointments')">
                </div>
            </div>

            <div class="table-container" id="appointment-list-view">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th><th>Email</th><th>Schedule</th><th>Notes</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $row)
                        <tr id="appointment-row-{{ $row->id }}">
                            <td><strong>{{ $row->name }}</strong></td>
                            <td>{{ $row->email }}</td>
                            <td>
                                <div style="font-weight: 600; font-family: var(--font-playfair); font-size: 1rem;">
                                    {{ \Carbon\Carbon::parse($row->date)->format('F d') }}
                                </div>
                                <div style="color: var(--grey-text); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ \Carbon\Carbon::parse($row->time)->format('g:i A') }}
                                </div>
                            </td>
                            <td style="max-width: 250px;">
                                <div class="customer-context">
                                    @php
                                        $note = strtolower($row->notes);
                                        $icon = 'fa-comment-alt';
                                        if(str_contains($note, 'fitting')) $icon = 'fa-scissors';
                                        if(str_contains($note, 'consultation') || str_contains($note, 'meeting')) $icon = 'fa-handshake';
                                        if(str_contains($note, 'pickup') || str_contains($note, 'claim')) $icon = 'fa-shopping-bag';
                                    @endphp
                                    <i class="fas {{ $icon }}" style="margin-right: 8px; color: var(--black); font-size: 0.8rem;"></i>
                                    <span style="font-size: 0.9rem; font-style: italic; color: var(--black);">"{{ $row->notes }}"</span>
                                </div>
                            </td>
                            <td>
                                <span class="status-pill status-{{ $row->status }}">{{ $row->status }}</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-warning" onclick="openRescheduleModal({{ $row->id }}, '{{ $row->date }}', '{{ $row->time }}')">Reschedule</button>
                                    <button class="btn btn-success" onclick="confirmAppointment({{ $row->id }})">Confirm</button>
                                    <button class="btn btn-secondary" onclick="cancelAppointment({{ $row->id }})">Cancel</button>
                                    <button class="btn btn-danger" onclick="deleteAppointment({{ $row->id }})">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="calendar-view"></div>
        </div>

        <!-- History Pane -->
        <div class="pane" id="history">
            <div class="filter-container" style="justify-content: flex-end;">
                <input type="text" id="history-search" placeholder="Search past records..." onkeyup="filterTable('history-search', 'history')">
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th><th>Email</th><th>Schedule</th><th>Notes</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pastAppointments as $row)
                        <tr>
                            <td><strong>{{ $row->name }}</strong></td>
                            <td>{{ $row->email }}</td>
                            <td>
                                <div style="font-weight: 600; font-family: var(--font-playfair); font-size: 1rem;">
                                    {{ \Carbon\Carbon::parse($row->date)->format('F d') }}
                                </div>
                                <div style="color: var(--grey-text); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ \Carbon\Carbon::parse($row->time)->format('g:i A') }}
                                </div>
                            </td>
                            <td>
                                <div class="customer-context">
                                    <span style="font-size: 0.9rem; font-style: italic; color: var(--black);">"{{ $row->notes }}"</span>
                                </div>
                            </td>
                            <td>
                                <span class="status-pill status-{{ $row->status }}">{{ $row->status }}</span>
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteAppointment({{ $row->id }})">Delete Record</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quotes Pane -->
        <div class="pane" id="quotes">
            <div class="filter-container">
                <label for="quote-search">Search Quotes:</label>
                <input type="text" id="quote-search" placeholder="Search by name, email, or service..." onkeyup="filterTable('quote-search', 'quotes')">
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Client Info</th>
                            <th>Service Details</th>
                            <th>Submitted Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quotes as $row)
                        <tr id="quote-row-{{ $row->id }}">
                            <td>
                                <strong>{{ $row->name }}</strong><br>
                                <span style="color: var(--text-muted); font-size: 0.8rem;">{{ $row->email }}</span><br>
                                <span style="color: var(--text-muted); font-size: 0.8rem;">{{ $row->phone }}</span>
                            </td>
                            <td>
                                <span class="status-pill">{{ $row->service_type }}</span>
                                @if($row->custom_service_type)
                                    <br><span style="font-size: 0.8rem; color: var(--grey-text);">{{ $row->custom_service_type }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $row->created_at->format('M d, Y') }}
                            </td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-primary" onclick='openQuoteModal(@json($row))'>View Details</button>
                                    <button class="btn btn-danger" onclick="deleteQuote({{ $row->id }})"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Users Pane -->
        <div class="pane" id="users">
            <div class="filter-container">
                <label for="user-search">Search Users:</label>
                <input type="text" id="user-search" placeholder="Search by name, email, or address..." onkeyup="filterTable('user-search', 'users')">
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>User Info</th>
                            <th>Contact & Address</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                        <tr id="user-row-{{ $row->id }}">
                            <td>
                                <strong>{{ $row->name }}</strong>
                                @if($row->is_admin)
                                    <span class="status-pill status-Confirmed" style="margin-left: 8px;">Admin</span>
                                @endif
                                <br>
                                <span style="color: var(--text-muted); font-size: 0.85rem;">{{ $row->email }}</span>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem;"><i class="fas fa-phone fa-fw" style="color:#9ca3af;"></i> {{ $row->contact }}</div>
                                <div style="font-size: 0.85rem;"><i class="fas fa-map-marker-alt fa-fw" style="color:#9ca3af;"></i> {{ $row->address }}</div>
                            </td>
                            <td>{{ $row->created_at->format('M d, Y') }}</td>
                            <td>
                                @if(!$row->is_admin)
                                    <button class="btn btn-danger" onclick="deleteUser({{ $row->id }}, '{{ $row->name }}')">Delete</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<!-- Quote Details Modal -->
<div class="modal-overlay" id="quoteModalOverlay" onclick="closeQuoteModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2>Quote Details</h2>
            <button class="close-modal-btn" onclick="closeQuoteModal()">&times;</button>
        </div>
        <div class="modal-body">
            
            <div class="modal-grid">
                <div>
                    <div class="detail-group">
                        <span class="detail-label">Client Name</span>
                        <div class="detail-value" id="modal-client-name"></div>
                    </div>
                    
                    <div class="detail-group">
                        <span class="detail-label">Contact Information</span>
                        <div class="detail-value">
                            <div id="modal-client-email"></div>
                            <div id="modal-client-phone"></div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <span class="detail-label">Service Type</span>
                        <div class="detail-value">
                            <strong id="modal-service-type"></strong>
                            <div id="modal-custom-service" style="color: var(--grey-text); font-size: 0.85rem;"></div>
                        </div>
                    </div>

                    <div class="detail-group">
                        <span class="detail-label">Sizing</span>
                        <div class="detail-value" id="modal-size"></div>
                    </div>

                    <div class="detail-group">
                        <span class="detail-label">Selected Materials</span>
                        <div class="detail-value" id="modal-materials"></div>
                    </div>

                    <div class="detail-group">
                        <span class="detail-label">Project Details / Notes</span>
                        <div class="detail-value" id="modal-details" style="white-space: pre-wrap; background: var(--grey-light); padding: 15px; border: 1px solid var(--grey-border);"></div>
                    </div>
                </div>

                <div>
                    <div class="detail-group">
                        <span class="detail-label">Inspiration Image</span>
                        <div class="detail-value" id="modal-image-container">
                            <!-- Image injected here -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="quote-action-box" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--grey-border); display: flex; align-items: flex-end; gap: 20px;">
                <div style="flex: 1;">
                    <div class="detail-group" style="border-top: 2px solid var(--black); padding-top: 20px;">
                        <span class="detail-label">Message to Client (Personal Touch)</span>
                        <textarea id="modal-message-input" placeholder="e.g. Based on the tulle fabric and intricate bodice work..." style="width: 100%; min-height: 100px; padding: 12px; border: 1px solid var(--grey-border); font-family: var(--font-sans); font-size: 0.85rem; margin-bottom: 20px;"></textarea>
                    </div>

                    <div class="detail-group">
                        <span class="detail-label">Final Price Quote (PHP)</span>
                        <input type="number" id="modal-price-input" class="price-quote-input" style="width: 100%; max-width: none; font-size: 1.1rem; font-weight: 600; padding: 12px;" placeholder="Enter amount (e.g. 40000)">
                    </div>

                    <div style="margin-top: 30px; text-align: center;">
                        <input type="hidden" id="modal-quote-id">
                        <button class="btn btn-primary" style="padding: 15px 50px; font-size: 0.9rem; width: 100%;" onclick="sendModalQuote()">Send Quotation</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
>>>>>>> Stashed changes
</div>

<div class="tabs">
    <div class="tab active" data-tab="appointments">Appointments</div>
    <div class="tab" data-tab="quotes">Quote Requests</div>
    <div class="tab" data-tab="users">User Accounts</div>
</div>

<!-- Appointments Tab -->
<div class="tab-content active" id="appointments">
    <table>
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Date</th><th>Time</th><th>Notes</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $row)
            <tr id="appointment-row-{{ $row->id }}" class="row-status-{{ $row->status }}">
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->date }}</td>
                <td>{{ $row->time }}</td>
                <td>{{ $row->notes }}</td>
                <td>{{ $row->status }}</td>
                <td>
                    <input type="date" id="date-{{ $row->id }}">
                    <input type="time" id="time-{{ $row->id }}">
                    <button class="btn btn-reschedule" onclick="reschedule({{ $row->id }})">Reschedule</button>
                    <button class="btn btn-confirm" onclick="confirmAppointment({{ $row->id }})">Confirm</button>
                    <button class="btn btn-cancel" onclick="cancelAppointment({{ $row->id }})">Cancel</button>
                    <button class="btn btn-delete" onclick="deleteAppointment({{ $row->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Quotes Tab -->
<div class="tab-content" id="quotes">
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Service Type</th>
                <th>Size</th><th>Image</th><th>Materials</th><th>Project Details</th><th>Price Quote</th><th>Submitted At</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotes as $row)
            <tr id="quote-row-{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->service_type }}</td>
                <td>
                    @if($row->size === 'custom')
                        <small><strong>Custom:</strong><br>{{ $row->custom_size }}</small>
                    @else
                        {{ $row->size }}
                    @endif
                </td>
                <td>
                    @if($row->inspiration_image)
                        <a href="{{ asset('storage/' . $row->inspiration_image) }}" target="_blank" title="Click to view full image">
                            <img src="{{ asset('storage/' . $row->inspiration_image) }}" style="max-height: 40px; border-radius: 4px; border: 1px solid #ccc;">
                        </a>
                    @else
                        <span style="color:#aaa;font-size:0.8rem;">None</span>
                    @endif
                </td>
                <td>{{ $row->selected_materials }}</td>
                <td>{{ $row->details }}</td>
                <td>
                    <input type="number" id="price-quote-{{ $row->id }}" class="price-quote-input" value="{{ $row->price_quote }}">
                    <button class="btn btn-send-quote" onclick="sendQuote({{ $row->id }})">Send Quote</button>
                </td>
                <td>{{ $row->created_at }}</td>
                <td><button class="btn btn-delete" onclick="deleteQuote({{ $row->id }})">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Users Tab -->
<div class="tab-content" id="users">
    <table>
        <thead>
            <tr>
                <th>Full Name</th><th>Email</th><th>Address</th><th>Contact</th><th>Created At</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $row)
            <tr id="user-row-{{ $row->id }}">
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->contact }}</td>
                <td>{{ $row->created_at }}</td>
                <td><button class="btn btn-delete" onclick="deleteUser({{ $row->id }}, '{{ $row->name }}')">Delete User</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function showToast(message, success) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.cssText = `position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); background-color: ${success ? '#28a745' : '#dc3545'}; color: white; padding: 10px 20px; border-radius: 4px; z-index: 10000;`;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }

    // Appointment actions
    function sendAppointmentAction(id, action, date=null, time=null) {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('appointment_action', action);
        if(date) formData.append('new_date', date);
        if(time) formData.append('new_time', time);

        fetch("{{ route('admin.appointment.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.message, true);
            location.reload();
        });
    }

    function reschedule(id) {
        const date = document.getElementById('date-'+id).value;
        const time = document.getElementById('time-'+id).value;
        if(!date || !time) return showToast('Select date and time', false);
        sendAppointmentAction(id, 'reschedule', date, time);
    }
    function confirmAppointment(id) { sendAppointmentAction(id, 'confirm'); }
    function cancelAppointment(id) { sendAppointmentAction(id, 'cancel'); }
    function deleteAppointment(id) { if(confirm('Delete?')) sendAppointmentAction(id, 'delete'); }

    // Quote actions
<<<<<<< Updated upstream
    function sendQuote(id) {
        const price = document.getElementById('price-quote-'+id).value;
=======
    function deleteQuote(id) {
        if(!confirm('Are you sure you want to delete this quote request?')) return;
        const formData = new FormData();
        formData.append('id', id);
        formData.append('quote_action', 'delete');
        fetch("{{ route('admin.quote.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        }).then(() => location.reload());
    }

    // Modal Logic
    const quoteModalOverlay = document.getElementById('quoteModalOverlay');

    function openQuoteModal(quote) {
        document.getElementById('modal-client-name').textContent = quote.name;
        document.getElementById('modal-client-email').textContent = quote.email;
        document.getElementById('modal-client-phone').textContent = quote.phone || 'N/A';
        
        document.getElementById('modal-service-type').textContent = quote.service_type;
        document.getElementById('modal-custom-service').textContent = quote.custom_service_type || '';
        
        if (quote.size === 'custom') {
            document.getElementById('modal-size').innerHTML = `<strong>Custom Measurements:</strong><br>${quote.custom_size}`;
        } else {
            document.getElementById('modal-size').textContent = `Standard Size: ${quote.size}`;
        }

        document.getElementById('modal-materials').textContent = quote.selected_materials || 'None specified';
        document.getElementById('modal-details').textContent = quote.details;
        
        const imageContainer = document.getElementById('modal-image-container');
        if (quote.inspiration_image) {
            const imgUrl = `/storage/${quote.inspiration_image}`;
            imageContainer.innerHTML = `<a href="${imgUrl}" target="_blank" title="Click to view full image"><img src="${imgUrl}" style="max-width: 100%; border: 1px solid var(--grey-border);"></a>`;
        } else {
            imageContainer.innerHTML = '<span style="color: var(--grey-text); font-style: italic;">No inspiration image provided.</span>';
        }

        document.getElementById('modal-price-input').value = quote.price_quote || '';
        document.getElementById('modal-quote-id').value = quote.id;

        quoteModalOverlay.classList.add('active');
    }

    function closeQuoteModal(e) {
        if (e && e.target !== quoteModalOverlay && !e.target.classList.contains('close-modal-btn')) {
            return;
        }
        quoteModalOverlay.classList.remove('active');
    }

    function sendModalQuote() {
        const id = document.getElementById('modal-quote-id').value;
        const price = document.getElementById('modal-price-input').value;
        const message = document.getElementById('modal-message-input').value;
        const btn = event.target;

        if(!price) return showToast('Please enter a price quote first', false);

        btn.disabled = true;
        btn.textContent = 'Sending Quotation...';

>>>>>>> Stashed changes
        const formData = new FormData();
        formData.append('id', id);
        formData.append('quote_action', 'send_quote');
        formData.append('price_quote', price);
        formData.append('message_to_client', message);

        fetch("{{ route('admin.quote.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.json())
<<<<<<< Updated upstream
        .then(data => showToast(data.message, true));
    }

    function deleteQuote(id) {
        if(!confirm('Delete?')) return;
        const formData = new FormData();
        formData.append('id', id);
        formData.append('quote_action', 'delete');
        fetch("{{ route('admin.quote.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        }).then(() => location.reload());
=======
        .then(data => {
            showToast(data.message, true);
            closeQuoteModal();
            setTimeout(() => location.reload(), 1500);
        })
        .catch(err => {
            btn.disabled = false;
            btn.textContent = 'Send Quotation';
            showToast('Error sending quotation', false);
        });
>>>>>>> Stashed changes
    }

    // User actions
    function deleteUser(id, name) {
        if(!confirm('Delete '+name+'?')) return;
        const formData = new FormData();
        formData.append('user_id', id);
        formData.append('user_action', 'delete');
        fetch("{{ route('admin.user.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        }).then(() => location.reload());
    }

    // Tabs
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.tab, .tab-content').forEach(el => el.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');
        });
    });

    // Filter
    document.getElementById('filter-btn').addEventListener('click', () => {
        const start = document.getElementById('filter-start-date').value;
        const end = document.getElementById('filter-end-date').value;
        const formData = new FormData();
        formData.append('filter_start_date', start);
        formData.append('filter_end_date', end);

        fetch("{{ route('admin.filter.appointments') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.text())
        .then(html => document.querySelector('#appointments tbody').innerHTML = html);
    });
</script>

</body>
</html>
