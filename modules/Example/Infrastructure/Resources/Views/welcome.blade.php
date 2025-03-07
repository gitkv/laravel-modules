<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example Module</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --background: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: var(--background);
            line-height: 1.6;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
            border-bottom: 2px solid var(--accent-color);
        }

        .examples-list {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .example-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .example-card:hover {
            transform: translateY(-2px);
        }

        .example-title {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="header">
        <h1>{{ $welcomeMessage }}</h1>
    </header>

    @if(count($examples) > 0)
        <div class="examples-list">
            @foreach($examples as $example)
                <article class="example-card">
                    <h2 class="example-title">{{ $example['name'] }}</h2>
                    <p>{{ $example['description'] }}</p>
                </article>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p>No examples found. Start by creating your first item!</p>
        </div>
    @endif
</div>
</body>
</html>
