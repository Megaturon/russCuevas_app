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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <style>
        :root {
            --black: #111111;
            --white: #ffffff;
            --grey-light: #f5f5f3;
            --grey-border: #e5e5e5;
            --grey-text: #888888;
            --grey-dark: #333333;
            
            --bg-body: #f5f5f3;
            --bg-main: #f5f5f3;
            --bg-topbar: #ffffff;
            --bg-sidebar: #111111;
            --bg-table-header: #f5f5f3;
            --text-main: #111111;
            --text-sidebar: #888888;
            
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-serif-display: 'Cormorant Garamond', serif;
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
            background: var(--bg-body);
            color: var(--text-main);
            font-family: var(--font-sans);
            display: flex;
            height: 100vh;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            padding: 15px;
            gap: 15px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--bg-sidebar);
            color: var(--text-sidebar);
            display: flex;
            flex-direction: column;
            z-index: 10;
            padding: 20px 0 0 0;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .sidebar-header {
            padding: 0 20px 30px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #333;
            margin-bottom: 10px;
        }

        .sidebar-header img {
            width: 60px !important;
            height: auto !important;
            mix-blend-mode: screen;
        }

        .sidebar-header h2 {
            font-family: var(--font-sans);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--white);
            margin: 0;
            text-align: center;
        }
        
        .sidebar-header p {
            font-size: 0.75rem;
            color: var(--grey-text);
            margin: 0;
            text-align: center;
        }

        .sidebar-nav {
            flex: 1;
            padding: 0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            padding: 12px 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            color: var(--text-sidebar);
            position: relative;
            border-left: 3px solid transparent;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            color: var(--grey-text);
            transition: all 0.2s ease;
        }

        .nav-item:hover {
            color: var(--white);
            background-color: #222;
        }

        .nav-item.active {
            color: var(--white);
            background-color: transparent;
            border-left: 3px solid var(--white); 
            font-weight: 600;
        }
        
        .nav-item.active i {
            color: var(--white);
        }

        .sidebar-footer {
            padding: 20px;
            margin-top: auto;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--grey-text);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s;
            padding: 12px 25px;
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
            background-color: var(--bg-main);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .topbar {
            padding: 15px 40px;
            background-color: var(--bg-topbar);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--grey-border);
        }

        .topbar h1 {
            font-family: var(--font-sans);
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--black);
            margin: 0;
        }
        
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
        }

        .search-wrapper input {
            padding: 10px 20px;
            border-radius: 8px 0 0 8px;
            border: 1px solid var(--grey-border);
            border-right: none;
            background: var(--grey-light);
            font-size: 0.85rem;
            outline: none;
            width: 300px;
            transition: border-color 0.3s;
        }

        .search-wrapper input:focus {
            border-color: var(--black);
        }

        .search-btn {
            background: var(--black);
            color: var(--white);
            border: none;
            padding: 0 20px;
            height: 38px; /* match input approx */
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .search-btn:hover {
            background: #000;
        }
        
        .topbar-icons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .topbar-icons i {
            font-size: 1.1rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            background: #f1f5f9;
            transition: background 0.3s;
        }

        .topbar-icons i:hover {
            background: #e2e8f0;
        }

        .content-area {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            background: var(--bg-main);
        }

        #mainInboundChart {
            background: transparent !important;
            max-height: 220px;
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
            margin-bottom: 2rem !important;
        }
        
        .fc-toolbar-title {
            font-family: var(--font-serif) !important;
            font-size: 1.4rem !important;
            font-weight: 600 !important;
            letter-spacing: 2px !important;
            color: var(--black) !important;
        }

        .fc-button-primary {
            background-color: var(--black) !important;
            border: 1px solid var(--black) !important;
            border-radius: 0 !important;
            text-transform: uppercase !important;
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            letter-spacing: 1.5px !important;
            padding: 10px 18px !important;
            transition: all 0.3s ease !important;
            box-shadow: none !important;
        }

        .fc-button-primary:hover {
            background-color: var(--grey-dark) !important;
            border-color: var(--grey-dark) !important;
        }

        .fc-button-primary:disabled {
            background-color: #ccc !important;
            border-color: #ccc !important;
            opacity: 0.5 !important;
        }

        .fc-button-active {
            background-color: var(--grey-dark) !important;
            border-color: var(--grey-dark) !important;
        }

        .fc-theme-standard td, .fc-theme-standard th {
            border: 1px solid var(--grey-border) !important;
        }

        .fc-col-header-cell {
            background-color: var(--white) !important;
            padding: 12px 0 !important;
        }

        .fc-col-header-cell-cushion {
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 1.5px !important;
            color: var(--black) !important;
            text-decoration: none !important;
        }

        .fc-day-today {
            background-color: var(--grey-light) !important;
        }

        .fc-daygrid-day-number {
            font-size: 0.9rem !important;
            color: var(--black) !important;
            padding: 10px !important;
            font-weight: 500 !important;
            text-decoration: none !important;
        }

        .fc-event {
            border-radius: 0 !important;
            border: none !important;
            padding: 4px 8px !important;
            font-size: 0.65rem !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            cursor: pointer !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        }

        .fc-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        }

        .fc-daygrid-event-dot {
            border-color: var(--black) !important;
        }

        .fc-daygrid-more-link {
            font-size: 0.7rem !important;
            font-weight: 600 !important;
            color: var(--black) !important;
            text-decoration: none !important;
        }

        .fc-scrollgrid {
            border-radius: 0 !important;
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            position: sticky;
            top: 0;
            background-color: var(--bg-table-header);
            z-index: 10;
            font-family: var(--font-sans);
            color: var(--grey-text);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 15px 20px;
            border-bottom: 1px solid var(--grey-border);
        }

        td {
            padding: 15px 20px;
            font-size: 0.85rem;
            color: var(--text-main);
            border-bottom: 1px solid var(--grey-border);
            vertical-align: middle;
        }

        tr {
            transition: background-color 0.2s ease;
        }

        tr:hover td {
            background-color: var(--grey-light);
        }

        strong {
            color: var(--black);
            font-weight: 600;
        }

        /* Status Pills */
        .status-pill {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 0;
            display: inline-flex;
            align-items: center;
        }

        .status-Confirmed { 
            color: #10b981; /* Green */
        }
        
        .status-Rescheduled { 
            color: #3b82f6; /* Blue */
        }
        
        .status-Cancelled { 
            color: #ef4444; /* Red */
        }
        
        .status-Pending { 
            color: #f59e0b; /* Orange */
        }

        /* Inputs & Buttons */
        .table-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
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
            font-size: 2rem;
            line-height: 1;
            cursor: pointer;
            color: var(--grey-text);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
        }
        .close-modal-btn:hover { color: var(--black); transform: scale(1.1); }

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
        <img src="/images/RC_logo.jpg" alt="Russ Cuevas Logo">
        <h2>Administrator</h2>
        <p>admin@russcuevas.com</p>
    </div>
    <nav class="sidebar-nav">
        <div style="padding: 15px 25px 10px; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; color: var(--grey-text); font-weight: 700;">Main Menu</div>
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
        <div class="nav-item" data-target="payments">
            <i class="fas fa-wallet"></i>
            Payments
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
        <div class="topbar-right">
            <div class="search-wrapper">
                <input type="text" id="global-search" placeholder="Search information" oninput="performGlobalSearch()">
                <button class="search-btn" onclick="performGlobalSearch()"><i class="fas fa-search"></i></button>
            </div>
            <div class="topbar-icons" style="position: relative;">
                <i class="fas fa-bell" onclick="toggleNotificationDropdown()" style="cursor: pointer; position: relative;">
                    @if($tomorrowAppointments->count() + $pendingAppointmentsCount > 0)
                        <span style="position: absolute; top: -5px; right: -8px; background: var(--black); color: var(--white); border: 2px solid var(--white); border-radius: 50%; font-size: 0.55rem; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; font-family: sans-serif; font-weight: bold; box-sizing: content-box;">
                            {{ $tomorrowAppointments->count() + $pendingAppointmentsCount }}
                        </span>
                    @endif
                </i>
                
                <!-- Notification Dropdown -->
                <div id="notification-dropdown" style="display: none; position: absolute; top: 40px; right: 0; width: 450px; max-width: 90vw; max-height: 80vh; background: var(--white); box-shadow: 0 10px 40px rgba(0,0,0,0.15); border: 1px solid var(--grey-border); border-radius: 12px; z-index: 2000; overflow-y: auto; padding: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h2 style="font-family: var(--font-sans); font-size: 1.2rem; font-weight: 700; color: var(--black); margin: 0;">Notifications</h2>
                        <div style="font-size: 0.8rem; color: var(--grey-text);">{{ $tomorrowAppointments->count() + $pendingAppointmentsCount }} Unread</div>
                    </div>
                    
                    @if($pendingAppointments->count() > 0)
                        <div style="margin-bottom: 20px;">
                            <h3 style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--grey-text); margin-bottom: 10px;">Action Required</h3>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @foreach($pendingAppointments as $app)
                                    <div class="notification-card" style="flex-direction: column; padding: 15px; gap: 10px;">
                                        <div style="display: flex; justify-content: space-between;">
                                            <strong>{{ $app->name }}</strong>
                                            <span style="color: #f59e0b; font-size: 0.75rem; font-weight: bold;">Pending</span>
                                        </div>
                                        <div style="font-size: 0.8rem; color: var(--grey-text);">{{ \Carbon\Carbon::parse($app->date)->format('M d') }} • {{ \Carbon\Carbon::parse($app->time)->format('g:i A') }}</div>
                                        <div style="display: flex; gap: 8px; margin-top: 5px;">
                                            <button class="btn btn-success" style="padding: 4px 8px; font-size: 0.65rem;" onclick="confirmAppointment({{ $app->id }})">Confirm</button>
                                            <button class="btn btn-danger" style="padding: 4px 8px; font-size: 0.65rem;" onclick="deleteAppointment({{ $app->id }})">Decline</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($tomorrowAppointments->count() > 0)
                        <div style="margin-bottom: 20px;">
                            <h3 style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--grey-text); margin-bottom: 10px;">Tomorrow</h3>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @foreach($tomorrowAppointments as $app)
                                    <div class="notification-card" style="flex-direction: column; padding: 15px; gap: 5px;">
                                        <div style="display: flex; justify-content: space-between;">
                                            <strong>{{ $app->name }}</strong>
                                            <span style="color: #10b981; font-size: 0.75rem; font-weight: bold;">Confirmed</span>
                                        </div>
                                        <div style="font-size: 0.8rem; color: var(--grey-text);">{{ \Carbon\Carbon::parse($app->time)->format('g:i A') }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if($newTodayQuotes->count() > 0)
                        <div>
                            <h3 style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--grey-text); margin-bottom: 10px;">Recent Inquiries</h3>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                @foreach($newTodayQuotes as $quote)
                                    <div class="notification-card" style="padding: 15px; display: flex; justify-content: space-between; align-items: center; cursor: pointer;" onclick='toggleNotificationDropdown(); document.querySelector("[data-target=\"quotes\"]").click(); openQuoteModal(@json($quote))'>
                                        <div>
                                            <strong style="font-size: 0.9rem;">New Quote: {{ $quote->name }}</strong>
                                            <div style="font-size: 0.8rem; color: var(--grey-text);">{{ $quote->created_at->diffForHumans() }}</div>
                                        </div>
                                        <i class="fas fa-chevron-right" style="color: var(--grey-text); font-size: 0.8rem;"></i>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($tomorrowAppointments->count() == 0 && $pendingAppointments->count() == 0 && $newTodayQuotes->count() == 0)
                        <div style="text-align: center; padding: 30px 10px; color: var(--grey-text);">
                            <i class="fas fa-bell-slash" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.5;"></i>
                            <p style="font-size: 0.9rem;">You're all caught up!</p>
                        </div>
                    @endif
                </div>
                
                <div style="width: 1px; height: 30px; background: var(--grey-border); margin: 0 10px;"></div>
                
                <!-- User Profile Chip Removed -->
            </div>
        </div>
    </header>

    <div class="content-area">

        <!-- Overview Pane -->
        <div class="pane active" id="overview">
            @include('admin.overview')
        </div>

        <!-- Overview Pane -->

        <style>
            .notification-card {
                background: var(--white);
                border: 1px solid var(--grey-border);
                display: flex;
                align-items: stretch;
                transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            }
            .notification-card:hover {
                border-color: var(--black);
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            }
            .time-col, .date-col {
                min-width: 100px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-right: 1px solid var(--grey-border);
                padding: 20px;
                text-align: center;
            }
            .time-main { font-size: 1.3rem; font-weight: 700; color: var(--black); line-height: 1; }
            .time-ampm { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--grey-text); margin-top: 4px; }
            .date-month { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--grey-text); margin-bottom: 2px; }
            .date-day { font-size: 1.5rem; font-weight: 700; color: var(--black); line-height: 1; }
            
            .info-col { flex: 1; padding: 20px 30px; display: flex; flex-direction: column; justify-content: center; }
            .info-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
            .client-name { font-size: 1.15rem; font-weight: 700; color: var(--black); }
            .client-email { font-size: 0.85rem; color: var(--grey-text); margin-bottom: 15px; }
            .client-email i { margin-right: 8px; width: 14px; text-align: center; }
            
            .card-notes { padding: 12px 15px; border-left: 3px solid var(--black); background: var(--grey-light); border-radius: 0 4px 4px 0; }
            .notes-label { display: block; font-size: 0.55rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--grey-text); margin-bottom: 4px; }
            .card-notes p { font-size: 0.9rem; font-style: italic; color: var(--black); line-height: 1.4; margin: 0; }
            
            .action-col { padding: 20px; display: flex; flex-direction: column; gap: 8px; justify-content: center; border-left: 1px solid var(--grey-border); background: #fafafa; }
            .btn-sm-compact { padding: 8px 12px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; width: 120px; }
            
            .activity-card { display: flex; align-items: center; gap: 20px; padding: 15px 25px; border: 1px solid var(--grey-border); background: var(--white); transition: all 0.3s ease; }
            .activity-card:hover { border-color: var(--black); }
            .icon-circle { width: 42px; height: 42px; background: var(--black); color: var(--white); display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 0.9rem; }
            .activity-info { flex: 1; }
            .activity-title { font-size: 0.95rem; color: var(--black); margin-bottom: 2px; }
            .activity-meta { font-size: 0.75rem; color: var(--grey-text); }
            .btn-outline-sm { background: transparent; color: var(--black); border: 1px solid var(--black); font-size: 0.7rem; padding: 6px 12px; }
            .btn-outline-sm:hover { background: var(--black); color: var(--white); }
            
            .empty-state-card { text-align: center; padding: 50px; border: 2px dashed var(--grey-border); color: var(--grey-text); border-radius: 4px; }
            .empty-state-card i { font-size: 2rem; margin-bottom: 15px; opacity: 0.3; }
            .empty-state-card p { font-style: italic; font-size: 0.95rem; margin: 0; }
            
            /* Status Filter Buttons */
            .status-filter-btn {
                background: var(--bg-body);
                border: 1px solid transparent;
                color: var(--grey-text);
                padding: 8px 18px;
                font-size: 0.85rem;
                font-family: var(--font-sans);
                font-weight: 500;
                cursor: pointer;
                transition: all 0.2s ease;
                border-radius: 20px;
                text-transform: capitalize;
            }
            .status-filter-btn:hover {
                background: #e5e7eb;
                color: var(--black);
            }
            .status-filter-btn.active {
                background: var(--black);
                color: var(--white);
                font-weight: 600;
            }

            /* Unified Filter Bar */
            .unified-filter-bar {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 15px;
                background: transparent;
                padding-bottom: 15px;
                border-bottom: 1px solid var(--grey-border);
                margin-bottom: 20px;
            }

            /* Status Pills Overhaul */
            .status-pill {
                display: inline-flex;
                align-items: center;
                padding: 4px 0;
                font-size: 0.75rem;
                font-weight: 600;
            }
            .status-Pending {
                color: #b7791f;
            }
            .status-Confirmed {
                color: #10b981;
            }
            .status-Rescheduled {
                color: #3b82f6;
            }
            .status-Cancelled {
                color: #ef4444;
            }
            
            /* Quote Statuses */
            .status-Received {
                color: #4b5563;
            }
            .status-Quoted {
                color: #6b21a8;
            }
            .status-PartiallyPaid {
                color: #b7791f;
            }
            .status-Accepted {
                color: #10b981;
            }
            .status-Paid {
                color: #059669;
            }

            /* Dropdown Actions */
            .action-dropdown {
                position: relative;
                display: inline-block;
            }
            .action-dropdown-content {
                display: none;
                position: absolute;
                left: 100%;
                top: -10px;
                margin-left: 10px;
                background-color: #fff;
                min-width: 140px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
                z-index: 100;
                border: 1px solid var(--grey-border);
                border-radius: 4px;
                overflow: hidden;
            }
            .action-dropdown-content a {
                color: var(--black);
                padding: 10px 16px;
                text-decoration: none;
                display: block;
                font-size: 0.8rem;
                text-align: left;
                font-weight: 500;
            }
            .action-dropdown-content a:hover {
                background-color: var(--grey-light);
            }
            .action-dropdown-content a.danger {
                color: #dc3545;
            }
            .action-dropdown-content a.danger:hover {
                background-color: #ffeeee;
            }
            .action-dropdown.show .action-dropdown-content {
                display: block;
            }

            /* Table Hover Accent */
            table tbody tr {
                transition: background-color 0.2s ease;
            }
            table tbody tr td:first-child {
                position: relative;
            }
            table tbody tr td:first-child::before {
                content: "";
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 0;
                background: #c5a880; /* Gold accent */
                transition: width 0.2s ease;
            }
            table tbody tr:hover {
                background-color: #fffdf5; /* Warm tint */
            }
            table tbody tr:hover td:first-child::before {
                width: 4px;
            }

            /* Skeleton Loading */
            .skeleton-row td {
                padding: 15px;
            }
            .skeleton-box {
                height: 20px;
                background: #eee;
                background: linear-gradient(110deg, #ececec 8%, #f5f5f5 18%, #ececec 33%);
                border-radius: 4px;
                background-size: 200% 100%;
                animation: 1.5s shimmer linear infinite;
            }
            @keyframes shimmer {
                to { background-position-x: -200%; }
            }
        </style>
        
        <!-- Appointments Pane -->
        <div class="pane" id="appointments">
            <div class="unified-filter-bar">
                <!-- Status Filters -->
                <div style="display: flex; gap: 8px; flex-wrap: wrap;" class="appointment-status-filters">
                    <button class="status-filter-btn active" onclick="setStatusFilter(this, 'appointments', 'global-search', 'appointment-status-filters')">All</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'appointments', 'global-search', 'appointment-status-filters')">Pending</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'appointments', 'global-search', 'appointment-status-filters')">Confirmed</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'appointments', 'global-search', 'appointment-status-filters')">Rescheduled</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'appointments', 'global-search', 'appointment-status-filters')">Cancelled</button>
                </div>
                
                <div style="flex: 1;"></div>

                <!-- Date Presets & Range -->
                <div id="date-filter-controls" style="display: flex; align-items: center; gap: 10px; border-left: 1px solid var(--grey-border); padding-left: 15px;">
                    <div style="display: flex; gap: 5px; align-items: center;">
                        <input type="date" id="filter-start-date" onchange="triggerDateFilter()" style="margin: 0; padding: 6px; font-size: 0.8rem;">
                        <span style="color: var(--grey-text); font-size: 0.8rem;">to</span>
                        <input type="date" id="filter-end-date" onchange="triggerDateFilter()" style="margin: 0; padding: 6px; font-size: 0.8rem;">
                    </div>
                </div>

                <!-- View Toggle -->
                <div style="display: flex; gap: 0; border-left: 1px solid var(--grey-border); padding-left: 15px;">
                    <button class="view-toggle-btn active" id="btn-list-view" onclick="switchAppointmentView('list')" style="border-radius: 4px 0 0 4px; margin: 0; padding: 6px 12px; font-size: 0.75rem;">List</button>
                    <button class="view-toggle-btn" id="btn-calendar-view" onclick="switchAppointmentView('calendar')" style="border-radius: 0 4px 4px 0; margin: 0; border-left: none; padding: 6px 12px; font-size: 0.75rem;">Calendar</button>
                </div>
            </div>

            <div class="table-container" id="appointment-list-view">
                <table>
                    <thead>
                        <tr>
                            <th>Client Info</th><th>Schedule</th><th>Notes</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $row)
                        <tr id="appointment-row-{{ $row->id }}">
                            <td>
                                <strong>{{ $row->name }}</strong><br>
                                <span style="color:var(--grey-text); font-size: 0.85rem;">{{ $row->email }}</span>
                            </td>
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
                            <td style="overflow: visible;">
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    @if($row->status === 'Pending')
                                    <button class="btn btn-success" onclick="confirmAppointment({{ $row->id }})" style="padding: 6px 12px; font-size: 0.75rem;">Confirm</button>
                                    @elseif($row->status === 'Rescheduled')
                                    <button class="btn" disabled style="padding: 6px 12px; font-size: 0.75rem; background-color: #9ca3af; color: white; border: none; cursor: not-allowed;">Pending Client</button>
                                    @elseif($row->status === 'Confirmed')
                                    <button class="btn btn-warning" onclick="openRescheduleModal({{ $row->id }}, '{{ $row->date }}', '{{ $row->time }}', '{{ addslashes($row->name) }}', '{{ addslashes($row->email) }}')" style="padding: 6px 12px; font-size: 0.75rem;">Reschedule</button>
                                    @endif
                                    <div class="action-dropdown">
                                        <button class="btn btn-secondary action-dropdown-btn" onclick="toggleDropdown(event, {{ $row->id }})" style="padding: 6px 10px;"><i class="fas fa-ellipsis-h"></i></button>
                                        <div class="action-dropdown-content" id="dropdown-{{ $row->id }}">
                                            @if($row->status === 'Pending' || $row->status === 'Confirmed')
                                            <a href="#" onclick="event.preventDefault(); openRescheduleModal({{ $row->id }}, '{{ $row->date }}', '{{ $row->time }}', '{{ addslashes($row->name) }}', '{{ addslashes($row->email) }}')">Reschedule</a>
                                            @endif
                                            <a href="#" onclick="event.preventDefault(); cancelAppointment({{ $row->id }})">Cancel</a>
                                            <a href="#" class="danger" onclick="event.preventDefault(); deleteAppointment({{ $row->id }})">Delete</a>
                                        </div>
                                    </div>
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
            <div class="unified-filter-bar">
                <div style="display: flex; gap: 8px; flex-wrap: wrap;" class="history-status-filters">
                    <button class="status-filter-btn active" onclick="setStatusFilter(this, 'history', 'global-search', 'history-status-filters')">All</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'history', 'global-search', 'history-status-filters')">Confirmed</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'history', 'global-search', 'history-status-filters')">Cancelled</button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Client Info</th><th>Schedule</th><th>Notes</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pastAppointments as $row)
                        <tr>
                            <td>
                                <strong>{{ $row->name }}</strong><br>
                                <span style="color:var(--grey-text); font-size: 0.85rem;">{{ $row->email }}</span>
                            </td>
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
                            <td style="overflow: visible;">
                                <div class="action-dropdown">
                                    <button class="btn btn-secondary action-dropdown-btn" onclick="toggleDropdown(event, 'hist-{{ $row->id }}')" style="padding: 6px 10px;"><i class="fas fa-ellipsis-h"></i></button>
                                    <div class="action-dropdown-content" id="dropdown-hist-{{ $row->id }}">
                                        <a href="#" class="danger" onclick="event.preventDefault(); deleteAppointment({{ $row->id }})">Delete Record</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quotes Pane -->
        <div class="pane" id="quotes">
            <div class="unified-filter-bar">
                <div style="display: flex; gap: 8px; flex-wrap: wrap;" class="quote-status-filters">
                    <button class="status-filter-btn active" onclick="setStatusFilter(this, 'quotes', 'global-search', 'quote-status-filters')">All</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'quotes', 'global-search', 'quote-status-filters')">Received</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'quotes', 'global-search', 'quote-status-filters')">Quoted</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'quotes', 'global-search', 'quote-status-filters')">Quote Records</button>
                </div>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Client Info</th>
                            <th>Service Details</th>
                            <th>Submitted Date</th>
                            <th>Status</th>
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
                                <span style="background: var(--grey-bg); color: var(--black); padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">{{ $row->service_type }}</span>
                                @if($row->custom_service_type)
                                    <br><span style="font-size: 0.8rem; color: var(--grey-text);">{{ $row->custom_service_type }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $row->created_at->format('M d, Y') }}
                            </td>
                            <td>
                                @php
                                    $qStatus = $row->status ?? 'Received';
                                    $statusClass = $qStatus;
                                @endphp
                                <span class="status-pill status-{{ str_replace(' ', '', $qStatus) }}">{{ $qStatus }}</span>
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

        <!-- Payments Pane -->
        <div class="pane" id="payments">
            <div class="unified-filter-bar">
                <div style="display: flex; gap: 8px; align-items: center;" class="payment-status-filters">
                    <button class="status-filter-btn active" onclick="setStatusFilter(this, 'payments', 'global-search', 'payment-status-filters')">All</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'payments', 'global-search', 'payment-status-filters')">Full Payment</button>
                    <button class="status-filter-btn" onclick="setStatusFilter(this, 'payments', 'global-search', 'payment-status-filters')">Partial Payment</button>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Client Info</th>
                            <th>Service Type</th>
                            <th>Amount Paid / Total</th>
                            <th>Payment Type</th>
                            <th>Status</th>
                            <th>Date Received</th>
                            <th>Receipt</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $pay)
                        <tr class="table-row">
                            <td>
                                <strong>{{ $pay->name }}</strong><br>
                                <span style="color: var(--grey-text); font-size: 0.8rem;">{{ $pay->email }}</span>
                            </td>
                            <td>{{ $pay->service_type }}</td>
                            <td>
                                @php
                                    $paid = $pay->amount_paid ?? 0;
                                    $total = $pay->price_quote;
                                @endphp
                                <strong>₱{{ number_format($paid, 2) }}</strong><br>
                                <span style="color: var(--grey-text); font-size: 0.8rem;">of ₱{{ number_format($total, 2) }}</span>
                            </td>
                            <td>
                                @php
                                    if ($paid >= $total) {
                                        $pType = 'Full Payment';
                                    } elseif ($paid > 0) {
                                        $pType = 'Partial Payment';
                                    } else {
                                        $pType = 'Unpaid';
                                    }
                                @endphp
                                {{ $pType }}
                            </td>
                            <td class="status-cell" data-status="{{ $pType }}">
                                <span class="status-pill status-{{ str_replace(' ', '', $pay->status ?? 'Pending') }}">{{ $pay->status ?? 'Pending' }}</span>
                            </td>
                            <td>
                                @if($pay->paid_at)
                                <div style="font-weight: 600; color: var(--black);">
                                    {{ \Carbon\Carbon::parse($pay->paid_at)->format('M d, Y') }}
                                </div>
                                <div style="color: var(--grey-text); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ \Carbon\Carbon::parse($pay->paid_at)->format('g:i A') }}
                                </div>
                                @else
                                <span style="color: var(--grey-text);">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($paid > 0)
                                    @php
                                        $ref = 'RC-QTE-' . str_pad($pay->id, 5, '0', STR_PAD_LEFT);
                                    @endphp
                                    <button onclick="openReceiptModal('{{ route('receipts.show', $ref) }}')" class="btn btn-secondary" style="padding: 6px 12px; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-file-invoice"></i> View
                                    </button>
                                @else
                                    <span style="color: var(--grey-text); font-size: 0.8rem; font-style: italic;">No Receipt</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    @if($paid < $total)
                                    <button class="btn btn-primary" onclick='openUpdatePaymentModal({{ $pay->id }}, {{ $total }}, {{ $paid }})'>Update Payment</button>
                                    @else
                                    <button class="btn btn-secondary" disabled>Fully Paid</button>
                                    @endif
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
            <div class="table-container" style="margin-top: 20px;">
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

            <div id="modal-payment-history-container" style="display: none; margin-top: 40px; border-top: 2px solid var(--black); padding-top: 20px;">
                <h3 style="font-family: var(--font-playfair); font-size: 1.2rem; margin-bottom: 15px;">Payment History</h3>
                <div id="modal-payment-details" style="font-size: 0.9rem; line-height: 1.6; color: var(--grey-text);"></div>
                <div id="modal-balance-container" style="margin-top: 15px; font-weight: 600;"></div>
            </div>

            <div id="modal-quote-action-box" class="quote-action-box" style="margin-top: 40px; padding-top: 30px; border-top: 1px solid var(--grey-border); display: flex; align-items: flex-end; gap: 20px;">
                <div style="flex: 1;">
                    <div class="detail-group" style="border-top: 2px solid var(--black); padding-top: 20px;">
                        <span class="detail-label">Message to Client (Personal Touch)</span>
                        <textarea id="modal-message-input" placeholder="e.g. Based on the tulle fabric and intricate bodice work..." style="width: 100%; min-height: 100px; padding: 12px; border: 1px solid var(--grey-border); font-family: var(--font-sans); font-size: 0.85rem; margin-bottom: 20px;"></textarea>
                    </div>

                    <div class="detail-group">
                        <span class="detail-label">Final Price Quote (PHP)</span>
                        <input type="text" id="modal-price-input" class="price-quote-input" style="width: 100%; max-width: none; font-size: 1.1rem; font-weight: 600; padding: 12px;" placeholder="Enter amount (e.g. 40,000.00)">
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
            <div style="margin-bottom: 20px; padding: 15px; background: #f9fafb; border-left: 3px solid #000;">
                <div style="font-weight: 600; font-size: 1.1rem; margin-bottom: 5px; color: var(--black);" id="reschedule-client-name"></div>
                <div style="color: #6b7280; font-size: 0.85rem; margin-bottom: 10px;" id="reschedule-client-email"></div>
                <div style="font-size: 0.9rem;">
                    <span style="color: #6b7280;">Current Schedule:</span> <strong id="reschedule-current-datetime"></strong>
                </div>
            </div>
            <div style="display: flex; gap: 15px;">
                <div class="detail-group" style="flex: 1;">
                    <span class="detail-label">New Date</span>
                    <input type="date" id="reschedule-date" class="price-quote-input" style="width: 100%; margin: 0; background: var(--white); border: 1px solid var(--black); padding: 10px;">
                </div>
                <div class="detail-group" style="flex: 1;">
                    <span class="detail-label">New Time</span>
                    <input type="time" id="reschedule-time" class="price-quote-input" style="width: 100%; margin: 0; background: var(--white); border: 1px solid var(--black); padding: 10px;">
                </div>
            </div>
            <div class="detail-group" style="margin-top: 15px;">
                <span class="detail-label">Reason for Reschedule (Required)</span>
                <textarea id="reschedule-reason" class="price-quote-input" style="width: 100%; margin: 0; background: var(--white); border: 1px solid var(--black); padding: 10px; min-height: 80px;" placeholder="Briefly explain why the appointment is being rescheduled..." required></textarea>
            </div>
            <div style="margin-top: 30px;">
                <button class="btn btn-primary" style="width: 100%; padding: 15px;" onclick="submitReschedule()">Save New Schedule</button>
            </div>
        </div>
    </div>
</div>

<!-- Day Appointments Modal -->
<div class="modal-overlay" id="dayAppointmentsModalOverlay" onclick="closeDayModal(event)">
    <div class="modal-content" style="max-width: 500px;" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 id="day-modal-title">Appointments for May 14</h2>
            <button class="close-modal-btn" onclick="closeDayModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="day-appointments-list" style="display: flex; flex-direction: column; gap: 15px;">
                <!-- Appointments injected here -->
            </div>
            <div id="no-appointments-msg" style="display: none; text-align: center; padding: 20px; color: var(--grey-text); font-style: italic;">
                No appointments scheduled for this day.
            </div>
        </div>
    </div>
</div>

<!-- Custom Confirm Modal -->
<div class="modal-overlay" id="confirmModalOverlay" onclick="closeConfirmModal(event)">
    <div class="modal-content" style="max-width: 450px;" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 id="confirm-modal-title">Confirm Action</h2>
            <button class="close-modal-btn" onclick="closeConfirmModal(null, true)">&times;</button>
        </div>
        <div class="modal-body" style="padding: 40px; text-align: center;">
            <div style="margin-bottom: 20px;">
                <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: var(--black);"></i>
            </div>
            <p id="confirm-modal-message" style="color: var(--grey-text); font-size: 1.05rem; margin-bottom: 35px; line-height: 1.6;">This action cannot be undone.</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <button class="btn btn-secondary" style="flex: 1; padding: 14px; font-size: 0.9rem;" onclick="closeConfirmModal(event, true)">Cancel</button>
                <button class="btn btn-primary" id="confirm-modal-action-btn" style="flex: 1; padding: 14px; font-size: 0.9rem;">Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- View Receipt Modal -->
<div class="modal-overlay" id="viewReceiptModalOverlay" onclick="closeReceiptModal(event)">
    <div class="modal-content" style="max-width: 800px; width: 90%; height: 90vh; display: flex; flex-direction: column;" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2>View Receipt</h2>
            <button class="close-modal-btn" onclick="closeReceiptModal()">&times;</button>
        </div>
        <div class="modal-body" style="flex: 1; padding: 0; overflow: hidden; background: #f3f4f6;">
            <iframe id="receiptIframe" src="" style="width: 100%; height: 100%; border: none;"></iframe>
        </div>
    </div>
</div>

<!-- Update Payment Modal -->
<div class="modal-overlay" id="updatePaymentModalOverlay" onclick="closeUpdatePaymentModal(event)">
    <div class="modal-content" style="max-width: 400px;" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2>Update Payment</h2>
            <button class="close-modal-btn" onclick="closeUpdatePaymentModal()">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="update-payment-id">
            
            <div style="background: var(--grey-light); padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: var(--grey-text); font-size: 0.85rem;">Total Price Quote</span>
                    <strong id="modal-payment-total"></strong>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: var(--grey-text); font-size: 0.85rem;">Currently Paid</span>
                    <strong id="modal-payment-paid" style="color: #059669;"></strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-top: 1px solid var(--grey-border); padding-top: 8px; margin-top: 8px;">
                    <span style="color: var(--grey-text); font-size: 0.85rem; font-weight: 600;">Pending Balance</span>
                    <strong id="modal-payment-balance" style="color: var(--black);"></strong>
                </div>
            </div>

            <div class="detail-group">
                <span class="detail-label">Amount Received Today (PHP)</span>
                <input type="text" id="update-payment-amount" oninput="formatPaymentAmount(this)" class="price-quote-input" style="width: 100%; max-width: none; font-size: 1.1rem; font-weight: 600; padding: 12px; background: var(--white); border: 1px solid var(--black);" placeholder="Enter amount">
            </div>
            
            <div style="margin-top: 30px;">
                <button class="btn btn-primary" style="width: 100%; padding: 15px;" onclick="submitPaymentUpdate(event)">Log Payment</button>
            </div>
        </div>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let confirmActionCallback = null;

    function showConfirmModal(title, message, callback) {
        document.getElementById('confirm-modal-title').textContent = title;
        document.getElementById('confirm-modal-message').textContent = message;
        confirmActionCallback = callback;
        document.getElementById('confirmModalOverlay').classList.add('active');
    }

    function closeConfirmModal(e, forceClose = false) {
        if (forceClose || (e && e.target.id === 'confirmModalOverlay')) {
            document.getElementById('confirmModalOverlay').classList.remove('active');
            confirmActionCallback = null;
        }
    }

    document.getElementById('confirm-modal-action-btn').addEventListener('click', () => {
        if (confirmActionCallback) {
            confirmActionCallback();
        }
        // Do not close modal here! Let the action handle it so the spinner is visible.
    });

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

    // Global Search Logic
    function handleGlobalSearch(event) {
        if (event.key === 'Enter') {
            performGlobalSearch();
        }
    }

    function performGlobalSearch() {
        const activePane = document.querySelector('.pane.active');
        if (activePane) {
            const paneId = activePane.id;
            let groupClass = null;
            if (paneId === 'appointments') groupClass = 'appointment-status-filters';
            if (paneId === 'history') groupClass = 'history-status-filters';
            if (paneId === 'quotes') groupClass = 'quote-status-filters';
            if (paneId === 'payments') groupClass = 'payment-status-filters';
            
            filterTable('global-search', paneId, groupClass);
        }
    }

    // Notifications Dropdown Logic
    function toggleNotificationDropdown() {
        const dropdown = document.getElementById('notification-dropdown');
        if (dropdown.style.display === 'none' || dropdown.style.display === '') {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notification-dropdown');
        const bellIcon = document.querySelector('.fa-bell');
        if (dropdown.style.display === 'block' && !dropdown.contains(event.target) && event.target !== bellIcon) {
            dropdown.style.display = 'none';
        }
    });

    // Sidebar navigation logic
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

            // Clear global search and reset table
            const globalSearch = document.getElementById('global-search');
            if (globalSearch) {
                globalSearch.value = '';
                performGlobalSearch(); // Reset filter
            }

            // Keep track of active tab in URL
            if (history.pushState) {
                history.pushState(null, null, '#' + targetId);
            } else {
                window.location.hash = targetId;
            }
        });
    });

    // Check hash on load to restore active tab
    if (window.location.hash) {
        const hash = window.location.hash.substring(1);
        const targetNav = document.querySelector(`.nav-item[data-target="${hash}"]`);
        if (targetNav) {
            targetNav.click();
        }
    }

    // Appointment actions
    function sendAppointmentAction(id, action, date=null, time=null, reason=null, buttonElement = null) {
        // Handle case where reason is omitted but buttonElement is provided (e.g. from confirm/cancel)
        if (typeof reason === 'object' && reason !== null && buttonElement === null) {
            buttonElement = reason;
            reason = null;
        }

        if (buttonElement) {
            buttonElement.disabled = true;
            buttonElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        }

        const formData = new FormData();
        formData.append('id', id);
        formData.append('appointment_action', action);
        if(date) formData.append('new_date', date);
        if(time) formData.append('new_time', time);
        if(reason) formData.append('reschedule_reason', reason);

        fetch("{{ route('admin.appointment.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.message, true);
            setTimeout(() => {
                const activePane = document.querySelector('.pane.active');
                if (activePane) {
                    window.location.hash = activePane.id;
                }
                window.location.reload();
            }, 1000);
        })
        .catch(err => {
            if (buttonElement) {
                buttonElement.disabled = false;
                buttonElement.textContent = 'Try Again';
            }
            showToast('Error processing request', false);
        });
    }

    function openRescheduleModal(id, date, time, name, email) {
        document.getElementById('reschedule-id').value = id;
        document.getElementById('reschedule-date').value = date;
        document.getElementById('reschedule-time').value = time;
        
        // Display client details
        if(document.getElementById('reschedule-client-name')) {
            document.getElementById('reschedule-client-name').textContent = name;
            document.getElementById('reschedule-client-email').textContent = email;
            
            // Format current datetime for display
            try {
                let d = new Date(date + 'T' + time);
                let formatted = d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ' at ' + 
                                d.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
                document.getElementById('reschedule-current-datetime').textContent = formatted;
            } catch(e) {
                document.getElementById('reschedule-current-datetime').textContent = date + ' ' + time;
            }
        }
        
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
        const reason = document.getElementById('reschedule-reason').value.trim();
        
        if(!date || !time) return showToast('Select date and time', false);
        if(!reason) return showToast('Reason is required', false);
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        
        sendAppointmentAction(id, 'reschedule', date, time, reason, btn);
        // Do not close modal here! Let the action handle it so the spinner is visible.
    }

    function confirmAppointment(id) { 
        showConfirmModal('Confirm Appointment', 'Are you sure you want to confirm this schedule?', () => {
            sendAppointmentAction(id, 'confirm', null, null, document.getElementById('confirm-modal-action-btn'));
        }); 
    }
    
    function cancelAppointment(id) { 
        showConfirmModal('Cancel Appointment', 'Are you sure you want to cancel this appointment?', () => {
            sendAppointmentAction(id, 'cancel', null, null, document.getElementById('confirm-modal-action-btn'));
        }); 
    }
    
    function deleteAppointment(id) { 
        showConfirmModal('Delete Appointment', 'Are you sure you want to delete this appointment record?', () => {
            sendAppointmentAction(id, 'delete', null, null, document.getElementById('confirm-modal-action-btn'));
        }); 
    }

    function deleteQuote(id) {
        showConfirmModal('Delete Quote', 'Are you sure you want to delete this quote request?', () => {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('quote_action', 'delete');
            fetch("{{ route('admin.quote.action') }}", {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(() => location.reload());
        });
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

        const priceInput = document.getElementById('modal-price-input');
        const priceVal = quote.price_quote || '';
        priceInput.value = priceVal;
        
        // Trigger formatting for existing value
        if (priceVal) {
            const event = new Event('input', { bubbles: true });
            priceInput.dispatchEvent(event);
        }

        document.getElementById('modal-quote-id').value = quote.id;

        // Payment History Logic
        if (quote.amount_paid && parseFloat(quote.amount_paid) > 0) {
            document.getElementById('modal-payment-history-container').style.display = 'block';
            
            const amtStr = '₱' + parseFloat(quote.amount_paid).toLocaleString('en-US', {minimumFractionDigits: 2});
            let typeStr = quote.payment_type === 'deposit' ? 'Deposit' : 'Full Payment';
            let dateStr = quote.paid_at ? quote.paid_at.substring(0,10) : '';
            let refStr = 'QT-' + quote.created_at.substring(0, 10).replace(/-/g, '') + '-' + String(quote.id).padStart(4, '0');

            document.getElementById('modal-payment-details').innerHTML = `
                <div><strong>Transaction Date:</strong> ${dateStr}</div>
                <div><strong>Amount Paid:</strong> ${amtStr}</div>
                <div><strong>Type:</strong> ${typeStr}</div>
                <div><strong>Reference:</strong> ${refStr} <span class="status-pill status-Confirmed" style="font-size:0.6rem; padding: 2px 6px; margin-left:8px;">Success</span></div>
            `;

            if (quote.payment_type === 'deposit' && parseFloat(quote.price_quote) > parseFloat(quote.amount_paid)) {
                const bal = parseFloat(quote.price_quote) - parseFloat(quote.amount_paid);
                document.getElementById('modal-balance-container').innerHTML = `
                    <div style="font-size: 1.1rem; color: var(--black); margin-bottom: 10px;">Balance Remaining: ₱${bal.toLocaleString('en-US', {minimumFractionDigits: 2})}</div>
                    <button class="btn btn-secondary" style="font-size: 0.8rem; padding: 8px 12px;" onclick="alert('Balance reminder email sent to ${quote.email}')">Send balance reminder email</button>
                `;
            } else {
                document.getElementById('modal-balance-container').innerHTML = `
                    <div style="font-size: 1.1rem; color: #059669;"><i class="fas fa-check-circle"></i> Paid in Full</div>
                `;
            }
            
            if (quote.payment_type === 'full' || quote.status === 'Paid') {
                 document.getElementById('modal-quote-action-box').style.display = 'none';
            } else {
                 document.getElementById('modal-quote-action-box').style.display = 'flex';
                 document.getElementById('modal-price-input').disabled = true;
                 document.getElementById('modal-price-input').style.background = '#f3f4f6';
                 document.getElementById('modal-price-input').title = 'Cannot change price after partial payment';
            }
        } else {
            document.getElementById('modal-payment-history-container').style.display = 'none';
            document.getElementById('modal-quote-action-box').style.display = 'flex';
            document.getElementById('modal-price-input').disabled = false;
            document.getElementById('modal-price-input').style.background = 'transparent';
            document.getElementById('modal-price-input').title = '';
        }

        quoteModalOverlay.classList.add('active');
    }

    // Auto-format Price Input
    document.getElementById('modal-price-input').addEventListener('input', function(e) {
        let cursorPosition = e.target.selectionStart;
        let originalLength = e.target.value.length;
        
        let value = e.target.value.replace(/[^0-9.]/g, '');
        let parts = value.split('.');
        
        // Handle thousands separator
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        
        // Limit to 2 decimal places and prevent multiple decimals
        if (parts.length > 2) {
            parts = [parts[0], parts[1]];
        }
        if (parts[1]) {
            parts[1] = parts[1].substring(0, 2);
        }
        
        e.target.value = parts.join('.');
        
        // Maintain cursor position
        let newLength = e.target.value.length;
        cursorPosition = cursorPosition + (newLength - originalLength);
        e.target.setSelectionRange(cursorPosition, cursorPosition);
    });

    function closeQuoteModal(e) {
        if (e && e.target !== quoteModalOverlay && !e.target.classList.contains('close-modal-btn')) {
            return;
        }
        quoteModalOverlay.classList.remove('active');
    }

    function sendModalQuote() {
        const id = document.getElementById('modal-quote-id').value;
        const price = document.getElementById('modal-price-input').value.replace(/,/g, '');
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
            
            // Instantly update the status pill in the DOM
            const quoteRow = document.getElementById('quote-row-' + id);
            if (quoteRow) {
                const statusCell = quoteRow.cells[3]; // 4th column is Status
                if (statusCell) {
                    statusCell.innerHTML = '<span class="status-pill status-Quoted">Quoted</span>';
                }
            }
            
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
        showConfirmModal('Delete User', 'Are you sure you want to delete user: ' + name + '?', () => {
            const formData = new FormData();
            formData.append('user_id', id);
            formData.append('user_action', 'delete');
            fetch("{{ route('admin.user.action') }}", {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': csrfToken }
            }).then(() => location.reload());
        });
    }

    // Payment Actions
    function openUpdatePaymentModal(id, total, paid) {
        document.getElementById('update-payment-id').value = id;
        
        const balance = total - paid;
        
        document.getElementById('modal-payment-total').textContent = '₱' + parseFloat(total).toLocaleString('en-US', {minimumFractionDigits: 2});
        document.getElementById('modal-payment-paid').textContent = '₱' + parseFloat(paid).toLocaleString('en-US', {minimumFractionDigits: 2});
        document.getElementById('modal-payment-balance').textContent = '₱' + parseFloat(balance).toLocaleString('en-US', {minimumFractionDigits: 2});
        
        document.getElementById('update-payment-amount').value = ''; // Reset
        document.getElementById('update-payment-amount').max = balance; // Recommend not overpaying, but HTML5 max doesn't strictly prevent typing
        
        document.getElementById('updatePaymentModalOverlay').style.display = 'flex';
    }

    function closeUpdatePaymentModal(e) {
        if (!e || e.target.id === 'updatePaymentModalOverlay' || e.target.classList.contains('close-modal-btn')) {
            document.getElementById('updatePaymentModalOverlay').style.display = 'none';
        }
    }

    function openReceiptModal(url) {
        document.getElementById('receiptIframe').src = url;
        document.getElementById('viewReceiptModalOverlay').style.display = 'flex';
    }

    function closeReceiptModal(e) {
        if (!e || e.target.id === 'viewReceiptModalOverlay' || e.target.classList.contains('close-modal-btn')) {
            document.getElementById('viewReceiptModalOverlay').style.display = 'none';
            document.getElementById('receiptIframe').src = '';
        }
    }

    function formatPaymentAmount(input) {
        let val = input.value.replace(/[^0-9.]/g, '');
        const parts = val.split('.');
        let whole = parts[0];
        if (whole) {
            whole = parseInt(whole, 10).toLocaleString('en-US');
        }
        let decimal = parts.length > 1 ? '.' + parts.slice(1).join('').replace(/\./g, '') : '';
        input.value = whole + decimal;
    }

    function submitPaymentUpdate(event) {
        const btn = event.target;
        const id = document.getElementById('update-payment-id').value;
        const amountStr = document.getElementById('update-payment-amount').value;
        const amount = parseFloat(amountStr.replace(/,/g, ''));
        
        if(isNaN(amount) || amount <= 0) return showToast('Enter a valid amount greater than 0', false);
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        
        const formData = new FormData();
        formData.append('id', id);
        formData.append('amount_received', amount);

        fetch("{{ route('admin.payment.action') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': csrfToken }
        })
        .then(res => res.json())
        .then(data => {
            showToast(data.message, true);
            setTimeout(() => {
                const activePane = document.querySelector('.pane.active');
                if (activePane) {
                    window.location.hash = activePane.id;
                }
                window.location.reload();
            }, 1000);
        })
        .catch(err => {
            btn.disabled = false;
            btn.textContent = 'Log Payment';
            showToast('Error recording payment', false);
        });
    }

    // Real-time Table Filtering with Status
    function filterTable(inputId, paneId, groupClass = null) {
        const input = document.getElementById(inputId);
        const filter = input ? input.value.toLowerCase() : '';
        const pane = document.getElementById(paneId);
        if (!pane) return;

        let activeStatus = 'All';
        if (groupClass) {
            const group = pane.querySelector('.' + groupClass);
            if (group) {
                const activeBtn = group.querySelector('.status-filter-btn.active');
                if (activeBtn) activeStatus = activeBtn.textContent.trim();
            }
        }

        const table = pane.querySelector('table');
        if (!table) return;
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) {
            let rowStatusEl = tr[i].querySelector('.status-pill');
            let dataStatusEl = tr[i].querySelector('.status-cell');
            let showByStatus = true;
            
            if (activeStatus === 'Quote Records') {
                showByStatus = true;
            } else if (activeStatus === 'All') {
                if (paneId === 'quotes') {
                    let statusText = '';
                    if (dataStatusEl && dataStatusEl.hasAttribute('data-status')) {
                        statusText = dataStatusEl.getAttribute('data-status').toLowerCase();
                    } else if (rowStatusEl) {
                        statusText = rowStatusEl.textContent.trim().toLowerCase();
                    }
                    if (statusText === 'paid' || statusText === 'partially paid' || statusText === 'pending balance') {
                        showByStatus = false;
                    }
                }
            } else {
                let statusText = '';
                if (dataStatusEl && dataStatusEl.hasAttribute('data-status')) {
                    statusText = dataStatusEl.getAttribute('data-status').toLowerCase();
                } else if (rowStatusEl) {
                    statusText = rowStatusEl.textContent.trim().toLowerCase();
                }
                
                if (statusText) {
                    showByStatus = (statusText === activeStatus.toLowerCase());
                } else {
                    showByStatus = false;
                }
            }

            let showBySearch = filter === '';
            if (!showBySearch) {
                const td = tr[i].getElementsByTagName("td");
                for (let j = 0; j < td.length - 1; j++) { // Skip the Actions column
                    if (td[j] && td[j].textContent.toLowerCase().indexOf(filter) > -1) {
                        showBySearch = true;
                        break;
                    }
                }
            }

            tr[i].style.display = (showBySearch && showByStatus) ? "" : "none";
        }
    }

    function setStatusFilter(btn, paneId, searchInputId, groupClass) {
        const group = btn.closest('.' + groupClass);
        if (group) {
            group.querySelectorAll('.status-filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        filterTable(searchInputId, paneId, groupClass);

        // Update Calendar if it's the appointments pane
        if (calendar && paneId === 'appointments') {
            let activeStatus = btn.textContent.trim();
            let filteredEvents = allCalendarEvents;
            if (activeStatus !== 'All') {
                filteredEvents = allCalendarEvents.filter(e => e.extendedProps.status.toLowerCase() === activeStatus.toLowerCase());
            }
            calendar.removeAllEventSources();
            calendar.addEventSource(filteredEvents);
        }
    }

    // Appointment View Switcher
    let calendar;
    function switchAppointmentView(view) {
        const listView = document.getElementById('appointment-list-view');
        const calView = document.getElementById('calendar-view');
        const btnList = document.getElementById('btn-list-view');
        const btnCal = document.getElementById('btn-calendar-view');
        const dateControls = document.getElementById('date-filter-controls');

        if (view === 'list') {
            listView.style.display = 'block';
            calView.style.display = 'none';
            btnList.classList.add('active');
            btnCal.classList.remove('active');
            
            if (dateControls) {
                dateControls.style.opacity = '1';
                dateControls.querySelectorAll('button, input').forEach(el => el.disabled = false);
            }
        } else {
            listView.style.display = 'none';
            calView.style.display = 'block';
            btnList.classList.remove('active');
            btnCal.classList.add('active');
            
            if (dateControls) {
                dateControls.style.opacity = '0.4';
                dateControls.querySelectorAll('button, input').forEach(el => el.disabled = true);
            }
            
            if (!calendar) {
                initCalendar();
            }
            setTimeout(() => calendar.render(), 100);
        }
    }

    let allCalendarEvents = [];

    function initCalendar() {
        const calendarEl = document.getElementById('calendar-view');
        const appointments = @json($allAppointments);
        
        allCalendarEvents = appointments.map(app => {
            let bgColor = '#000000'; // Confirmed
            let textColor = '#ffffff';
            
            if (app.status === 'Pending') {
                bgColor = '#666666';
            } else if (app.status === 'Rescheduled') {
                bgColor = '#333333';
            } else if (app.status === 'Cancelled') {
                bgColor = '#e5e5e5';
                textColor = '#666666';
            }

            return {
                title: app.name.split(' ')[0] + ' (' + app.status.charAt(0) + ')',
                start: app.date + 'T' + app.time,
                backgroundColor: bgColor,
                textColor: textColor,
                extendedProps: app
            };
        });

        let activeStatus = 'All';
        const group = document.querySelector('.appointment-status-filters');
        if (group) {
            const activeBtn = group.querySelector('.status-filter-btn.active');
            if (activeBtn) activeStatus = activeBtn.textContent.trim();
        }
        
        let initialEvents = allCalendarEvents;
        if (activeStatus !== 'All') {
            initialEvents = allCalendarEvents.filter(e => e.extendedProps.status.toLowerCase() === activeStatus.toLowerCase());
        }

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: initialEvents,
            dayMaxEvents: true,
            dateClick: function(info) {
                showDayAppointments(info.dateStr);
            },
            eventClick: function(info) {
                const app = info.event.extendedProps;
                showDayAppointments(app.date);
            }
        });
        calendar.render();
    }
    // Real-time Polling for New Appointments & Quotes
    let lastPollAppId = {{ $allAppointments->max('id') ?? 0 }};
    let lastPollQuoteId = {{ $quotes->max('id') ?? 0 }};
    let lastUpdatedStr = '{{ now()->format("Y-m-d H:i:s") }}';
    
    setInterval(() => {
        fetch(`{{ route('admin.latest.appointments') }}?last_app_id=${lastPollAppId}&last_quote_id=${lastPollQuoteId}&last_updated=${encodeURIComponent(lastUpdatedStr)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(data => {
            let delayIndex = 0;
            
            if (data.appointments && data.appointments.length > 0) {
                data.appointments.forEach((app) => {
                    setTimeout(() => {
                        showToast(`New Appointment: ${app.name} requested ${app.service_type || 'a service'}`, true);
                    }, delayIndex * 2000); 
                    delayIndex++;
                });
                
                const maxAppId = Math.max(...data.appointments.map(a => a.id));
                lastPollAppId = maxAppId > lastPollAppId ? maxAppId : lastPollAppId;
            }

            if (data.quotes && data.quotes.length > 0) {
                data.quotes.forEach((quote) => {
                    setTimeout(() => {
                        showToast(`New Quote Request: ${quote.name} for ${quote.service_type || 'a service'}`, true);
                    }, delayIndex * 2000); 
                    delayIndex++;
                });
                
                const maxQuoteId = Math.max(...data.quotes.map(q => q.id));
                lastPollQuoteId = maxQuoteId > lastPollQuoteId ? maxQuoteId : lastPollQuoteId;
            }

            if (data.updated_quotes && data.updated_quotes.length > 0) {
                data.updated_quotes.forEach((quote) => {
                    if (quote.updated_at > lastUpdatedStr) {
                        lastUpdatedStr = quote.updated_at.replace('T', ' ').substring(0, 19);
                    }

                    // Update UI if row exists
                    const row = document.getElementById('quote-row-' + quote.id);
                    if (row) {
                        const statusCell = row.cells[3];
                        if (statusCell) {
                            const statusStr = quote.status.replace(/\s+/g, '');
                            statusCell.innerHTML = `<span class="status-pill status-${statusStr}">${quote.status}</span>`;
                        }

                        // Add Payment Badge next to name if paid
                        if (quote.status === 'Paid' || quote.status === 'Partially Paid') {
                            const nameCell = row.cells[0];
                            const badgeStr = quote.payment_type === 'deposit' ? `Deposit ₱${parseFloat(quote.amount_paid).toLocaleString()}` : 'Paid in full';
                            const badgeHtml = `<span style="display:inline-block; margin-left: 8px; background: #ecfdf5; color: #059669; font-size: 0.7rem; padding: 2px 6px; border-radius: 12px; font-weight: 600;"><i class="fas fa-check-circle" style="margin-right: 4px;"></i>${badgeStr}</span>`;
                            
                            // Check if badge already exists
                            if (!nameCell.innerHTML.includes('fa-check-circle')) {
                                nameCell.querySelector('strong').insertAdjacentHTML('afterend', badgeHtml);
                            }

                            // Toast notification
                            const ref = 'QT-' + quote.created_at.substring(0, 10).replace(/-/g, '') + '-' + String(quote.id).padStart(4, '0');
                            setTimeout(() => {
                                showToast(`💳 ${quote.name} paid a ${quote.payment_type === 'deposit' ? 'deposit' : 'full balance'} of ₱${parseFloat(quote.amount_paid).toLocaleString()} — ${quote.service_type} · ${ref}`, true);
                            }, delayIndex * 2000);
                            delayIndex++;
                        }

                        // Update the button's JSON string so the modal gets the latest data
                        const viewBtn = row.querySelector('button.btn-primary');
                        if (viewBtn) {
                            viewBtn.setAttribute('onclick', `openQuoteModal(${JSON.stringify(quote).replace(/"/g, '&quot;')})`);
                        }
                    }
                });
            }
        })
        .catch(err => console.error('Polling error:', err));
    }, 10000); // Poll every 10 seconds

    // Show missed/pending notifications immediately on login/page load
    setTimeout(() => {
        const pendingApps = @json($pendingAppointments);
        const pendingQuotes = @json($newTodayQuotes);
        
        let initialDelay = 0;
        
        if (pendingApps && pendingApps.length > 0) {
            pendingApps.forEach((app) => {
                setTimeout(() => {
                    showToast(`Pending Appointment: ${app.name} requested ${app.service_type || 'a service'}`, true);
                }, initialDelay * 1500);
                initialDelay++;
            });
        }

        if (pendingQuotes && pendingQuotes.length > 0) {
            pendingQuotes.forEach((quote) => {
                setTimeout(() => {
                    showToast(`New Quote Request: ${quote.name} for ${quote.service_type || 'a service'}`, true);
                }, initialDelay * 1500);
                initialDelay++;
            });
        }
    }, 1000); // Slight delay to ensure page is fully rendered

    // Filter & Presets Logic
    function setDatePreset(preset, startId, endId) {
        const start = document.getElementById(startId);
        const end = document.getElementById(endId);
        const today = new Date();
        let s = new Date(), e = new Date();

        if (preset === 'today') {
            // Already today
        } else if (preset === 'week') {
            s.setDate(today.getDate() - today.getDay()); // Sunday
            e.setDate(s.getDate() + 6); // Saturday
        } else if (preset === 'month') {
            s = new Date(today.getFullYear(), today.getMonth(), 1);
            e = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        }

        // Adjust for timezone offset to prevent date shifting
        start.value = new Date(s.getTime() - (s.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
        end.value = new Date(e.getTime() - (e.getTimezoneOffset() * 60000)).toISOString().split('T')[0];

        // Trigger filter immediately after setting preset
        triggerDateFilter();
    }

    function triggerDateFilter() {
        const start = document.getElementById('filter-start-date').value;
        const end = document.getElementById('filter-end-date').value;
        if(!start || !end) return;

        const tbody = document.querySelector('#appointments tbody');
        
        // Skeleton Loading state
        tbody.innerHTML = Array(3).fill(`
            <tr class="skeleton-row">
                <td><div class="skeleton-box" style="width: 150px; margin-bottom: 5px;"></div><div class="skeleton-box" style="width: 100px;"></div></td>
                <td><div class="skeleton-box" style="width: 80px; margin-bottom: 5px;"></div><div class="skeleton-box" style="width: 60px;"></div></td>
                <td><div class="skeleton-box" style="width: 200px;"></div></td>
                <td><div class="skeleton-box" style="width: 80px;"></div></td>
                <td><div class="skeleton-box" style="width: 100px;"></div></td>
            </tr>
        `).join('');

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
            tbody.innerHTML = html;
            // Re-apply status filter if active
            const activeStatusBtn = document.querySelector('.appointment-status-filters .active');
            if(activeStatusBtn) {
                setStatusFilter(activeStatusBtn, 'appointments', 'appointment-search', 'appointment-status-filters');
            }
        });
    }

    // Dropdown Actions
    function toggleDropdown(e, id) {
        e.stopPropagation();
        const currentDropdown = document.getElementById('dropdown-' + id);
        
        // Close others
        document.querySelectorAll('.action-dropdown').forEach(el => {
            if (el !== currentDropdown.parentElement) {
                el.classList.remove('show');
            }
        });
        
        currentDropdown.parentElement.classList.toggle('show');
    }

    document.addEventListener('click', function() {
        document.querySelectorAll('.action-dropdown').forEach(el => el.classList.remove('show'));
    });

    // KPI Charts Initialization
    window.addEventListener('DOMContentLoaded', () => {
        const sparklineOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: { enabled: false } },
            scales: { x: { display: false }, y: { display: false } },
            elements: { 
                line: { borderColor: '#000', borderWidth: 1.5, tension: 0.4 },
                point: { radius: 0 }
            }
        };

        const sparklineData = @json($sparklineData);

        // Sparkline: Revenue
        new Chart(document.getElementById('sparkline-revenue').getContext('2d'), {
            type: 'line',
            data: { labels: sparklineData.map((_, i) => i), datasets: [{ data: sparklineData }] },
            options: sparklineOptions
        });

        // Sparkline: Quotes
        new Chart(document.getElementById('sparkline-quotes').getContext('2d'), {
            type: 'line',
            data: { labels: sparklineData.map((_, i) => i), datasets: [{ data: sparklineData }] },
            options: sparklineOptions
        });

        // Sparkline: Appointments
        new Chart(document.getElementById('sparkline-apps').getContext('2d'), {
            type: 'line',
            data: { labels: sparklineData.map((_, i) => i), datasets: [{ data: sparklineData.map(v => v * 0.4) }] },
            options: sparklineOptions
        });

        // Sparkline: Conversion
        new Chart(document.getElementById('sparkline-conv').getContext('2d'), {
            type: 'line',
            data: { labels: sparklineData.map((_, i) => i), datasets: [{ data: sparklineData.map(v => Math.sin(v) * 10 + 20) }] },
            options: sparklineOptions
        });

        // Main Traffic Chart
        const trafficData = @json($trafficData);
        new Chart(document.getElementById('mainInboundChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: Object.keys(trafficData),
                datasets: [{
                    label: 'Inquiries',
                    data: Object.values(trafficData),
                    backgroundColor: '#111',
                    borderRadius: 4,
                    borderWidth: 0,
                    barPercentage: 0.5,
                    maxBarThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    x: { grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { font: { size: 10 }, color: '#888' } }, 
                    y: { 
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { stepSize: 1, font: { size: 10 }, color: '#888' }
                    } 
                }
            }
        });

        // Status Donut Chart
        const statusData = @json($statusBreakdown);
        
        // Define monochrome colors based on status
        const getColorForStatus = (status) => {
            const s = status.toLowerCase();
            if(s.includes('confirm')) return '#111111'; // Dark ink for confirmed
            if(s.includes('reschedule')) return '#888888'; // Medium gray for rescheduled
            if(s.includes('pend')) return '#cccccc'; // Light gray for pending
            return '#eeeeee'; // Very light gray for others
        };

        new Chart(document.getElementById('appointmentStatusDonut').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: statusData.map(d => d.status),
                datasets: [{
                    data: statusData.map(d => d.total),
                    backgroundColor: statusData.map(d => getColorForStatus(d.status)),
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 10, font: { size: 10, weight: '500' }, color: '#111', padding: 20 }
                    }
                }
            }
        });
    });

    function showDayAppointments(dateStr) {
        const appointments = @json($allAppointments);
        let filtered = appointments.filter(app => app.date === dateStr);
        
        let activeStatus = 'All';
        const group = document.querySelector('.appointment-status-filters');
        if (group) {
            const activeBtn = group.querySelector('.status-filter-btn.active');
            if (activeBtn) activeStatus = activeBtn.textContent.trim();
        }
        
        if (activeStatus !== 'All') {
            filtered = filtered.filter(app => app.status.toLowerCase() === activeStatus.toLowerCase());
        }

        const listEl = document.getElementById('day-appointments-list');
        const msgEl = document.getElementById('no-appointments-msg');
        const modal = document.getElementById('dayAppointmentsModalOverlay');
        const titleEl = document.getElementById('day-modal-title');

        const date = new Date(dateStr);
        titleEl.textContent = 'Schedule: ' + date.toLocaleDateString([], { month: 'long', day: 'numeric', year: 'numeric' });

        listEl.innerHTML = '';
        if (filtered.length > 0) {
            msgEl.style.display = 'none';
            filtered.forEach(app => {
                const timeStr = new Date(app.date + 'T' + app.time).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const item = document.createElement('div');
                item.style.cssText = `padding: 15px; border: 1px solid var(--grey-border); border-left: 4px solid var(--black);`;
                item.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <strong style="font-size: 1.15rem;">${app.name}</strong>
                        <span class="status-pill status-${app.status}" style="font-size: 0.65rem;">${app.status}</span>
                    </div>
                    <div style="font-size: 0.9rem; color: var(--grey-text); margin-top: 5px;">
                        <i class="fas fa-clock" style="margin-right: 5px;"></i> ${timeStr}
                    </div>
                    <div style="font-size: 0.95rem; margin-top: 8px; font-style: italic;">"${app.notes || 'No notes'}"</div>
                `;
                listEl.appendChild(item);
            });
        } else {
            msgEl.style.display = 'block';
        }

        modal.classList.add('active');
    }

    function closeDayModal(e) {
        if (!e || e.target.id === 'dayAppointmentsModalOverlay' || e.target.classList.contains('close-modal-btn')) {
            document.getElementById('dayAppointmentsModalOverlay').classList.remove('active');
        }
    }
</script>

</body>
</html>
