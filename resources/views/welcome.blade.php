<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
            color: #111827;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        header .logo {
            font-size: 24px;
            font-weight: 600;
            color: #111827;
        }
        header nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #111827;
            font-weight: 500;
        }
        header nav a:hover {
            color: #3b82f6;
        }
        .hero {
            text-align: center;
            padding: 100px 0;
        }
        .hero h1 {
            font-size: 48px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 18px;
            color: #4b5563;
            max-width: 600px;
            margin: 0 auto;
        }
        .hero .cta {
            margin-top: 30px;
        }
        .hero .cta a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3b82f6;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
        }
        .hero .cta a:hover {
            background-color: #2563eb;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 80px 0;
        }
        .feature {
            text-align: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .feature p {
            font-size: 16px;
            color: #4b5563;
        }
        footer {
            text-align: center;
            padding: 20px 0;
            border-top: 1px solid #e5e7eb;
            margin-top: 80px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">MyWebsite</div>
            <nav>
                <a href="">Home</a>
                <a href="post">post</a>
                <a href="friend">friend</a>
                <a href="friendRequest">request</a>
            </nav>
        </header>

        <section class="hero">
            <h1>Welcome to MyWebsite</h1>
            <p>Your one-stop destination for amazing content, services, and more. Explore what we have to offer and join our community today!</p>
            <div class="cta">
                <a href="#">Get Started</a>
            </div>
        </section>

        <section class="features">
            <div class="feature">
                <h2>Feature One</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
            </div>
            <div class="feature">
                <h2>Feature Two</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
            </div>
            <div class="feature">
                <h2>Feature Three</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
            </div>
        </section>

        <footer>
            &copy; 2023 MyWebsite. All rights reserved.
        </footer>
    </div>
</body>
</html>