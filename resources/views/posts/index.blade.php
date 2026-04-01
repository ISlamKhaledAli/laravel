<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <style>
        :root {
            color-scheme: dark light;
            color: #111827;
            background: #eef2ff;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 24px;
            background: radial-gradient(circle at top left, rgba(59, 130, 246, 0.16), transparent 24%),
                        radial-gradient(circle at bottom right, rgba(99, 102, 241, 0.18), transparent 28%),
                        #eef2ff;
        }

        .page {
            width: min(100%, 980px);
            margin: 0 auto;
        }

        .header {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .title-block h1 {
            margin: 0;
            font-size: clamp(2rem, 2.4vw, 2.8rem);
            letter-spacing: -0.04em;
            color: #0f172a;
        }

        .title-block p {
            margin: 10px 0 0;
            color: #475569;
            line-height: 1.75;
            max-width: 560px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 22px;
            border-radius: 16px;
            border: none;
            background: linear-gradient(135deg, #4338ca, #2563eb);
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
            filter: brightness(1.05);
        }

        .cards {
            display: grid;
            gap: 18px;
        }

        .card {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.08);
            padding: 24px;
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            border-color: rgba(59, 130, 246, 0.25);
        }

        .card-title {
            margin: 0;
            font-size: 1.25rem;
            color: #1e293b;
        }

        .card-title a {
            color: inherit;
            text-decoration: none;
        }

        .card-title a:hover {
            color: #2563eb;
        }

        .card-text {
            margin: 12px 0 0;
            color: #475569;
            line-height: 1.75;
        }

        @media (max-width: 640px) {
            .header {
                align-items: stretch;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="header">
            <div class="title-block">
                <h1>All Posts</h1>
                <p>Browse a modern collection of posts with quick access to create new content.</p>
            </div>
            <a href="{{ route('posts.create') }}" class="button">Create New Post</a>
        </header>

        <div class="cards">
            @foreach ($posts as $post)
                <article class="card">
                    <h2 class="card-title">
                        <a href="{{ route('posts.show', $post['id']) }}">{{ $post['title'] }}</a>
                    </h2>
                    <p class="card-text">{{ $post['content'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</body>
</html>