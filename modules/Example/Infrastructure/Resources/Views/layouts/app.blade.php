<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Example Module')</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --error-color: #db3434;
            --gray-color: #ced4da;
            --green-color: #155724;
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
        .items-list {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            margin-top: 2em;
        }
        .item-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }
        .item-title {
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
            margin-top: 2em;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        .alert-success {
            background: #d4edda;
            color: var(--green-color);
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-primary {
            background: var(--accent-color);
            color: white;
        }
        .btn-create-new {
            margin-bottom: 20px;
        }
        .text-danger{
            color: var(--error-color);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--gray-color);
            border-radius: 4px;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: var(--accent-color);
            outline: 0;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.25);
        }
        .form-control::placeholder {
            color: var(--error-color);
        }
        .pagination-container {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            gap: 0.5rem;
        }
        .page-item {
            margin: 0;
        }
        .page-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid var(--gray-color);
        }
        .page-link:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }
        .page-item.active .page-link {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }
        .page-item.disabled .page-link {
            color: #666;
            cursor: default;
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
