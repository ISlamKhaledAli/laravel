<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>{{ $post->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --card-bg: #ffffff;
            --border: rgba(15, 23, 42, 0.08);
        }

        * {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 40px 24px;
            background-color: var(--bg);
            background-image: radial-gradient(circle at top left, rgba(59, 130, 246, 0.05), transparent 40%),
                              radial-gradient(circle at bottom right, rgba(99, 102, 241, 0.05), transparent 40%);
            font-family: 'Outfit', system-ui, sans-serif;
            color: var(--text-main);
        }

        .page {
            width: min(100%, 800px);
            margin: 0 auto;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 32px;
            box-shadow: 0 40px 100px rgba(15, 23, 42, 0.08);
            padding: 48px;
        }

        .page header {
            margin-bottom: 40px;
            border-bottom: 1.5px solid #f1f5f9;
            padding-bottom: 32px;
        }

        .page h1 {
            margin: 0 0 16px;
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -0.04em;
            color: var(--text-main);
        }

        .meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--text-muted);
            font-size: 1rem;
            font-weight: 500;
        }

        .meta .author {
            color: var(--primary);
            font-weight: 700;
        }

        .meta .dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #cbd5e1;
        }

        .content {
            color: #334155;
            font-size: 1.15rem;
            line-height: 1.8;
            margin: 0 0 48px;
            white-space: pre-line;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 32px;
            border-top: 1.5px solid #f1f5f9;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 52px;
            padding: 0 24px;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
        }

        .button.primary {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .button.primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        .button.secondary {
            background: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border);
        }

        .button.secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .button.danger {
            background: #fee2e2;
            color: #ef4444;
        }

        .button.danger:hover {
            background: #ef4444;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2);
        }

        @media (max-width: 640px) {
            .page {
                padding: 32px 24px;
                border-radius: 0;
            }
            .page h1 {
                font-size: 2.25rem;
            }
            .actions {
                flex-direction: column;
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
        <header>
            <h1>{{ $post->title }}</h1>
            <div class="meta">
                <span class="author">By {{ $post->user->name }}</span>
                <span class="dot"></span>
                <span>Post ID: {{ $post->id }}</span>
                <span class="dot"></span>
                <span>Created {{ $post->created_at->diffForHumans() }}</span>
            </div>
        </header>

        <div id="deleteModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px; z-index: 999;">
            <div style="width: min(100%, 420px); background: #ffffff; border-radius: 24px; padding: 24px; box-shadow: 0 30px 60px rgba(15, 23, 42, 0.16);">
                <p style="margin: 0 0 18px; color: #111827; font-size: 1rem; line-height: 1.6;">
                    Are you sure you want to delete this post? This action cannot be undone.
                </p>

                <div style="display: flex; gap: 0.75rem; justify-content: flex-end; flex-wrap: wrap;">
                    <button type="button" id="cancelDelete" class="secondary-link" style="min-height: 48px; border-radius: 14px; padding: 0 22px;">
                        Cancel
                    </button>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button" style="background: #ef4444; min-height: 48px; border-radius: 14px; padding: 0 22px;">
                            Confirm Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const deleteButton = document.getElementById('deleteButton');
            const deleteModal = document.getElementById('deleteModal');
            const cancelDelete = document.getElementById('cancelDelete');

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
        </script>


        <p class="content">{{ $post->description }}</p>

        <div class="actions">
            <a href="{{ route('posts.index') }}" class="button secondary">Back to All Posts</a>
            <a href="{{ route('posts.edit', $post->id) }}" class="button secondary">Edit Post</a>
            <button type="button" id="deleteButton" class="button danger">
                Delete Post
            </button>
        </div>
    </div>
</body>
</html>
