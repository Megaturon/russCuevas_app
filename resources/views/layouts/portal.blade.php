<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Client Portal') - Russ Cuevas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/styles2.css'])
    <style>
        body {
            background-color: #faf9f6;
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex-grow: 1;
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        .portal-header {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 400;
            font-style: italic;
            color: #1a1a1a;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .portal-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .portal-table {
            width: 100%;
            border-collapse: collapse;
        }
        .portal-table th {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            color: #888;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            text-align: left;
            background: #fdfdfd;
        }
        .portal-table td {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
            color: #333;
        }
        .portal-table tr:last-child td {
            border-bottom: none;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pending, .status-received { background: #fdf6e3; color: #b58900; }
        .status-confirmed, .status-accepted { background: #e8f5e9; color: #2e7d32; }
        .status-rescheduled { background: #e3f2fd; color: #1565c0; }
        .status-cancelled, .status-declined, .status-expired { background: #ffebee; color: #c62828; text-decoration: line-through; opacity: 0.7; }
        .status-quoted { background: #fff3e0; color: #e65100; font-weight: 600; border: 1px solid #ffe0b2; }

        .btn-primary {
            display: inline-block;
            background: #1a1a1a;
            color: #fff;
            padding: 0.75rem 1.5rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            border: 1px solid #1a1a1a;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: transparent;
            color: #1a1a1a;
        }
        .btn-secondary {
            display: inline-block;
            background: transparent;
            color: #1a1a1a;
            padding: 0.75rem 1.5rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            border: 1px solid #eee;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            border-color: #1a1a1a;
        }
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
            color: #666;
        }
        .empty-state i {
            font-size: 3rem;
            color: #ccc;
            margin-bottom: 1rem;
        }
        .empty-state p {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

<header>
    <x-nav-bar></x-nav-bar>
</header>

<main>
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    @yield('content')
</main>

<x-footer></x-footer>

</body>
</html>
