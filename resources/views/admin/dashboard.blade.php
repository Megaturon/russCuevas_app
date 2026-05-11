<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Manage Appointments, Quotes & Users</title>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    
    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <style>
        :root {
            --black: #000000;
            --white: #ffffff;
            --grey-light: #f5f5f5;
            --grey-border: #e5e5e5;
            --grey-text: #666666;
            --grey-dark: #333333;
            
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans: 'Inter', sans-serif;
        }

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


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--grey-light);
            color: var(--black);
            font-family: var(--font-sans);
            display: flex;
            height: 100vh;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
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
        }

        .nav-item.active {
            color: var(--white);
            background-color: rgba(255,255,255,0.05);
            border-left-color: var(--white);
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
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-container label {
            font-weight: 500;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--grey-text);
        }

        .filter-container input[type="date"], .filter-container input[type="text"] {
            padding: 8px 12px;
            border: 1px solid var(--black);
            background: transparent;
            font-family: var(--font-sans);
            font-size: 0.85rem;
            outline: none;
            color: var(--black);
        }

        .filter-container input[type="text"] {
            min-width: 300px;
        }

        /* Calendar View */
        #calendar-view {
            margin-top: 20px;
            background: var(--white);
            padding: 20px;
            border: 1px solid var(--grey-border);
            display: none;
        }
        
        .fc-header-toolbar {
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }
        
        .fc-button-primary {
            background-color: var(--black) !important;
            border-color: var(--black) !important;
            border-radius: 0 !important;
            text-transform: uppercase;
            font-size: 0.7rem !important;
            letter-spacing: 1px;
        }

        .view-toggle-btn {
            padding: 8px 15px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid var(--black);
            background: transparent;
            cursor: pointer;
            transition: all 0.3s;
        }
        .view-toggle-btn.active {
            background: var(--black);
            color: var(--white);
        }

        /* Table Styles */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {

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
        }
        }

        input[type="date"], input[type="time"], input.price-quote-input {
            padding: 8px 10px;
            border: 1px solid var(--grey-border);
            font-family: var(--font-sans);
            font-size: 0.8rem;
            outline: none;
            margin-bottom: 8px;
            width: 100%;
            max-width: 130px;
            background: transparent;
        }
        
        input[type="date"]:focus, input[type="time"]:focus, input.price-quote-input:focus {
            border-color: var(--black);
        }

        .btn {
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

        .btn:hover {
            background-color: var(--black);
            color: var(--white);
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
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
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
            font-size: 0.7rem;
            font-weight: 600;
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
            border: none;
            border-radius: 6px;
            cursor: pointer;
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
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: var(--black);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
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

        }


        .stat-label {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--grey-text);
        }

        .stat-value {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--black);
        }

        .stat-chart-container {
            height: 60px;
            margin-top: 10px;
        }



    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <img src="/images/RC_logo.jpg" alt="Russ Cuevas Logo" style="width: 40px; height: 40px;">
        <h2>Administrator</h2>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-item active" data-target="overview">
            <i class="fas fa-chart-line"></i>
            Business Overview
        </div>
        <div class="nav-item" data-target="appointments">
            <i class="fas fa-calendar-alt"></i>
            Appointments
        </div>
        <div class="nav-item" data-target="history">
            <i class="fas fa-history"></i>
            Appointment Records
        </div>
        <div class="nav-item" data-target="quotes">
            <i class="fas fa-file-invoice-dollar"></i>
            Quote Requests
        </div>
        <div class="nav-item" data-target="users">
            <i class="fas fa-users"></i>
            User Accounts
        </div>
    </nav>
    <div class="sidebar-footer">
        <a href="/logout" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            Sign Out
        </a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>


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
</div>

<!-- Reschedule Modal -->
<div class="modal-overlay" id="rescheduleModalOverlay" onclick="closeRescheduleModal(event)">
    <div class="modal-content" style="max-width: 400px;" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2>Reschedule Appointment</h2>
            <button class="close-modal-btn" onclick="closeRescheduleModal()">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="reschedule-id">
            <div class="detail-group">
                <span class="detail-label">New Date</span>
                <input type="date" id="reschedule-date" class="price-quote-input" style="width: 100%; margin: 0; background: var(--white); border: 1px solid var(--black); padding: 10px;">
            </div>
            <div class="detail-group">
                <span class="detail-label">New Time</span>
                <input type="time" id="reschedule-time" class="price-quote-input" style="width: 100%; margin: 0; background: var(--white); border: 1px solid var(--black); padding: 10px;">
            </div>
            <div style="margin-top: 30px;">
                <button class="btn btn-primary" style="width: 100%; padding: 15px;" onclick="submitReschedule()">Save New Schedule</button>
            </div>
        </div>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function showToast(message, success) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.cssText = `position: fixed; bottom: 30px; right: 30px; background-color: var(--black); color: var(--white); padding: 15px 30px; font-family: var(--font-sans); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; z-index: 10000; border: 1px solid var(--white); box-shadow: 0 5px 15px rgba(0,0,0,0.2); animation: slideIn 0.4s ease;`;
        document.body.appendChild(toast);
        
        // Add animation keyframes dynamically if not exists
        if(!document.getElementById('toast-styles')) {
            const style = document.createElement('style');
            style.id = 'toast-styles';
            style.innerHTML = `@keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }`;
            document.head.appendChild(style);
        }

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(10px)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Sidebar Navigation Logic
    const navItems = document.querySelectorAll('.nav-item');
    const panes = document.querySelectorAll('.pane');
    const pageTitle = document.getElementById('page-title');

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            // Remove active from all
            navItems.forEach(nav => nav.classList.remove('active'));
            panes.forEach(pane => pane.classList.remove('active'));
            
            // Add active to clicked
            item.classList.add('active');
            const targetId = item.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
            
            // Update Title
            pageTitle.textContent = item.textContent.trim();
        });
    });

    // Appointment actions
    function sendAppointmentAction(id, action, date=null, time=null, buttonElement = null) {
        if (buttonElement) {
            buttonElement.disabled = true;
            buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        }

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
            setTimeout(() => location.reload(), 1000);
        })
        .catch(err => {
            if (buttonElement) {
                buttonElement.disabled = false;
                buttonElement.textContent = 'Try Again';
            }
            showToast('Error processing request', false);
        });
    }

    function openRescheduleModal(id, date, time) {
        document.getElementById('reschedule-id').value = id;
        document.getElementById('reschedule-date').value = date;
        document.getElementById('reschedule-time').value = time;
        document.getElementById('rescheduleModalOverlay').style.display = 'flex';
    }

    function closeRescheduleModal(e) {
        if (!e || e.target.id === 'rescheduleModalOverlay' || e.target.classList.contains('close-modal-btn')) {
            document.getElementById('rescheduleModalOverlay').style.display = 'none';
        }
    }

    function submitReschedule() {
        const btn = event.target;
        const id = document.getElementById('reschedule-id').value;
        const date = document.getElementById('reschedule-date').value;
        const time = document.getElementById('reschedule-time').value;
        if(!date || !time) return showToast('Select date and time', false);
        
        btn.disabled = true;
        btn.textContent = 'Processing...';
        
        sendAppointmentAction(id, 'reschedule', date, time, btn);
        closeRescheduleModal();
    }

    function confirmAppointment(id) { sendAppointmentAction(id, 'confirm', null, null, event.target); }
    function cancelAppointment(id) { if(confirm('Cancel?')) sendAppointmentAction(id, 'cancel'); }
    function deleteAppointment(id) { if(confirm('Delete?')) sendAppointmentAction(id, 'delete'); }

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
    }

    // User actions
    function deleteUser(id, name) {
        if(!confirm('Are you sure you want to delete user: ' + name + '?')) return;
        const formData = new FormData();
        formData.append('user_id', id);
        formData.append('user_action', 'delete');
        fetch("{{ route('admin.user.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        }).then(() => location.reload());
    }

    // Real-time Table Filtering
    function filterTable(inputId, paneId) {
        const input = document.getElementById(inputId);
        const filter = input.value.toLowerCase();
        const pane = document.getElementById(paneId);
        const table = pane.querySelector(`table`);
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) {
            let visible = false;
            const td = tr[i].getElementsByTagName("td");
            for (let j = 0; j < td.length - 1; j++) { // Skip the Actions column
                if (td[j]) {
                    if (td[j].textContent.toLowerCase().indexOf(filter) > -1) {
                        visible = true;
                        break;
                    }
                }
            }
            tr[i].style.display = visible ? "" : "none";
        }
    }

    // Appointment View Switcher
    let calendar;
    function switchAppointmentView(view) {
        const listView = document.getElementById('appointment-list-view');
        const calView = document.getElementById('calendar-view');
        const btnList = document.getElementById('btn-list-view');
        const btnCal = document.getElementById('btn-calendar-view');

        if (view === 'list') {
            listView.style.display = 'block';
            calView.style.display = 'none';
            btnList.classList.add('active');
            btnCal.classList.remove('active');
        } else {
            listView.style.display = 'none';
            calView.style.display = 'block';
            btnList.classList.remove('active');
            btnCal.classList.add('active');
            
            if (!calendar) {
                initCalendar();
            }
            setTimeout(() => calendar.render(), 100);
        }
    }

    function initCalendar() {
        const calendarEl = document.getElementById('calendar-view');
        const appointments = @json($appointments);
        
        const events = appointments.map(app => ({
            title: app.name + ' (' + app.status + ')',
            start: app.date + 'T' + app.time,
            color: app.status === 'Confirmed' ? '#000' : (app.status === 'Cancelled' ? '#ccc' : '#666'),
            extendedProps: app
        }));

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: events,
            eventClick: function(info) {
                const app = info.event.extendedProps;
                alert('Appointment for: ' + app.name + '\nStatus: ' + app.status + '\nNotes: ' + app.notes);
            }
        });
        calendar.render();
    }

    // Filter Logic
    document.getElementById('filter-btn').addEventListener('click', () => {
        const start = document.getElementById('filter-start-date').value;
        const end = document.getElementById('filter-end-date').value;
        if(!start || !end) return showToast('Please select both start and end dates', false);

        const formData = new FormData();
        formData.append('filter_start_date', start);
        formData.append('filter_end_date', end);

        fetch("{{ route('admin.filter.appointments') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.text())
        .then(html => {
            document.querySelector('#appointments tbody').innerHTML = html;
            showToast('Filter applied', true);
        });
    });

    // KPI Charts Initialization
    window.addEventListener('DOMContentLoaded', () => {
        // Traffic Chart
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        const trafficData = @json($trafficData);
        new Chart(trafficCtx, {
            type: 'line',
            data: {
                labels: Object.keys(trafficData),
                datasets: [{
                    data: Object.values(trafficData),
                    borderColor: '#000',
                    borderWidth: 2,
                    pointRadius: 0,
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    x: { display: false }, 
                    y: { display: false } 
                }
            }
        });

        // Service Chart (Mini Bar)
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        new Chart(serviceCtx, {
            type: 'bar',
            data: {
                labels: ['Request'],
                datasets: [{
                    data: [{{ $mostRequestedService ? $mostRequestedService->total : 0 }}],
                    backgroundColor: '#000',
                    barThickness: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    x: { display: false }, 
                    y: { display: false, min: 0 } 
                }
            }
        });
    });
</script>

</body>
</html>
