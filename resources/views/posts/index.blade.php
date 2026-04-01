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

        .button.secondary {
            background: #e2e8f0;
            color: #0f172a;
        }

        .button.secondary:hover {
            filter: brightness(0.95);
        }

        .button.danger {
            background: #ef4444;
            color: #ffffff;
        }

        .button.danger:hover {
            filter: brightness(1.1);
        }

        .card-actions {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
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
                    <div class="card-actions">
                        <a href="{{ route('posts.edit', $post['id']) }}" class="button secondary">Edit</a>
                        <button type="button" id="deleteButton{{ $post['id'] }}" class="button danger">Delete</button>
                    </div>
                </article>

                <div id="deleteModal{{ $post['id'] }}" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px; z-index: 9999;">
                        <div style="width: min(100%, 420px); max-width: 100%; background: #ffffff; border-radius: 24px; padding: 24px; box-shadow: 0 30px 60px rgba(15, 23, 42, 0.16);">
                            <p style="margin: 0 0 18px; color: #111827; font-size: 1rem; line-height: 1.6;">
                                Are you sure you want to delete this post? This action cannot be undone.
                            </p>

                            <div style="display: flex; gap: 0.75rem; justify-content: flex-end; flex-wrap: wrap;">
                                <button type="button" id="cancelDelete{{ $post['id'] }}" class="button secondary" style="min-height: 48px; border-radius: 14px; padding: 0 22px; background: #e2e8f0; color: #0f172a;">
                                    Cancel
                                </button>

                                <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button danger" style="min-height: 48px; border-radius: 14px; padding: 0 22px;">
                                        Confirm Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        (function() {
                            const deleteButton = document.getElementById('deleteButton{{ $post['id'] }}');
                            const deleteModal = document.getElementById('deleteModal{{ $post['id'] }}');
                            const cancelDelete = document.getElementById('cancelDelete{{ $post['id'] }}');

                            if (!deleteButton || !deleteModal || !cancelDelete) return;

                            deleteButton.addEventListener('click', () => {
                                deleteModal.style.display = 'flex';
                            });

                            cancelDelete.addEventListener('click', () => {
                                deleteModal.style.display = 'none';
                            });

                            deleteModal.addEventListener('click', (event) => {
                                if (event.target === deleteModal) {
                                    deleteModal.style.display = 'none';
                                }
                            });
                        })();
                    </script>
            @endforeach
        </div>
    </div>
</body>
</html>