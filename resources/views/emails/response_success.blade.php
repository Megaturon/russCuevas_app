<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | Russ Cuevas</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --black: #000000;
            --white: #ffffff;
            --grey-light: #f9f9f9;
            --grey-border: #eeeeee;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Inter', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: var(--font-sans);
            background-color: var(--white);
            color: var(--black);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            width: 90%;
            text-align: center;
            padding: 60px 40px;
            border: 1px solid var(--grey-border);
            box-shadow: 0 20px 40px rgba(0,0,0,0.03);
            background: var(--white);
        }
        .icon-box {
            width: 80px;
            height: 80px;
            background: var(--black);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            font-size: 2rem;
        }
        h1 {
            font-family: var(--font-serif);
            font-size: 2.2rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666666;
            margin-bottom: 40px;
        }
        .btn {
            display: inline-block;
            background: var(--black);
            color: var(--white);
            text-decoration: none;
            padding: 18px 45px;
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            border: 1px solid var(--black);
        }
        .btn:hover {
            background: transparent;
            color: var(--black);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon-box">
            @if(str_contains(strtolower($title), 'confirmed'))
                <i class="fas fa-check"></i>
            @else
                <i class="fas fa-times"></i>
            @endif
        </div>
        <h1>{{ $title }}</h1>
        <p>{{ $message }}</p>
        <a href="/" class="btn">Return to Homepage</a>
    </div>
</body>
</html>
