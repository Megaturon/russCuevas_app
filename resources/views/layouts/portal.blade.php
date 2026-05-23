<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Client Portal') - Russ Cuevas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/styles2.css'])
    <style>
        body {
            background-color: #ffffff;
            font-family: var(--font-inter, 'Inter', sans-serif);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: #111;
        }
        main {
            flex-grow: 1;
            padding: 4rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
            width: 100%;
        }
        .portal-header {
            font-family: var(--font-playfair, 'Playfair Display', serif);
            font-size: 2rem;
            font-weight: 400;
            color: #111;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 1.5rem;
        }
        .portal-header i {
            display: none; /* Hide generic icons for a cleaner look */
        }
        .portal-card {
            background: #fff;
            border: 1px solid #eaeaea;
            border-radius: 0;
        }
        .portal-table {
            width: 100%;
            border-collapse: collapse;
        }
        .portal-table th {
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: #111;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #111;
            text-align: left;
            background: #fff;
        }
        .portal-table td {
            padding: 1.5rem;
            border-bottom: 1px solid #eaeaea;
            vertical-align: middle;
            font-size: 0.85rem;
            color: #333;
        }
        .portal-table tr:hover td {
            background-color: #fdfdfd;
        }
        .portal-table tr:last-child td {
            border-bottom: none;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 2px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid transparent;
        }
        .status-pending, .status-received { background: transparent; color: #888; border-color: #ccc; }
        .status-confirmed, .status-accepted, .status-paid { background: #111; color: #fff; }
        .status-rescheduled { background: #f5f5f5; color: #111; border-color: #111; }
        .status-cancelled, .status-declined, .status-expired { background: transparent; color: #999; text-decoration: line-through; border-color: #eee; }
        .status-quoted { background: #fff; color: #111; border-color: #111; }
        .status-partially-paid, .status-partiallypaid { background: transparent; color: #111; border-color: #111; }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #111;
            color: #fff;
            padding: 0.8rem 1.8rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            text-decoration: none;
            border: 1px solid #111;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #fff;
            color: #111;
        }
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #111;
            padding: 0.6rem 1.2rem;
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            border: 1px solid #eaeaea;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-secondary:hover {
            border-color: #111;
        }
        .empty-state {
            padding: 5rem 2rem;
            text-align: center;
            color: #555;
            background: #fcfcfc;
            border: 1px dashed #eaeaea;
        }
        .empty-state h3 {
            font-family: var(--font-playfair, 'Playfair Display', serif);
            font-size: 1.5rem;
            color: #111;
            margin-bottom: 0.5rem;
            font-weight: 400;
        }
        .empty-state p {
            font-size: 0.85rem;
            color: #777;
            margin-bottom: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        
        .portal-alert {
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            font-size: 0.85rem;
            border: 1px solid #eaeaea;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .portal-alert-success { background: #fff; border-left: 3px solid #111; }
        .portal-alert-error { background: #fff; border-left: 3px solid #e53e3e; }
    </style>
</head>
<body>

<header>
    <x-nav-bar></x-nav-bar>
</header>

<main>
    @if(session('success'))
    <div class="portal-alert portal-alert-success">
        <i class="fas fa-check" style="color: #111;"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="portal-alert portal-alert-error">
        <i class="fas fa-exclamation-triangle" style="color: #e53e3e;"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    @yield('content')
</main>

<x-footer></x-footer>

</body>
</html>

