<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
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
            background-image: radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.05), transparent 40%),
                              radial-gradient(circle at 100% 100%, rgba(56, 189, 248, 0.05), transparent 40%);
            font-family: 'Outfit', system-ui, sans-serif;
            color: var(--text-main);
        }

        .page {
            width: min(100%, 840px);
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 48px;
        }

        .title-block h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--text-main);
        }

        .title-block p {
            margin: 8px 0 0;
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 480px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 52px;
            padding: 0 28px;
            border-radius: 18px;
            border: none;
            background: var(--primary);
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
            cursor: pointer;
        }

        .button:hover {
            transform: translateY(-2px);
            background: var(--primary-hover);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
        }

        .button:active {
            transform: translateY(0);
        }

        .button.secondary {
            background: #ffffff;
            color: var(--text-main);
            border: 1px solid var(--border);
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .button.secondary:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .button.danger {
            background: #fee2e2;
            color: #ef4444;
            box-shadow: none;
        }

        .button.danger:hover {
            background: #ef4444;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        }

        .cards {
            display: grid;
            gap: 24px;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 32px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: rgba(99, 102, 241, 0.2);
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06);
        }

        .card.trashed {
            background: #f8fafc;
            opacity: 0.7;
            border-style: dashed;
            border-color: #cbd5e1;
        }

        .card-meta {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-meta .dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #cbd5e1;
        }

        .card-meta .author {
            color: var(--primary);
            font-weight: 700;
        }

        .card-title {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .card-title a {
            color: inherit;
            text-decoration: none;
        }

        .card-title a:hover {
            color: var(--primary);
        }

        .card-text {
            margin: 16px 0 0;
            color: #475569;
            line-height: 1.7;
            font-size: 1.05rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-actions {
            margin-top: 24px;
            display: flex;
            gap: 12px;
        }

        .pagination-wrapper {
            margin-top: 56px;
            display: flex;
            justify-content: center;
        }

        /* Pagination Overrides for Bootstrap theme */
        .pagination {
            display: flex;
            gap: 10px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
            padding: 0 16px;
            border-radius: 14px;
            background: #ffffff;
            color: var(--text-main);
            font-weight: 700;
            text-decoration: none;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }

        .page-item.active .page-link {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        .page-item:not(.active):not(.disabled) .page-link:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
            background: #f5f3ff;
        }

        .page-item.disabled .page-link {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f1f5f9;
        }

        @media (max-width: 640px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 32px;
            }
            .button {
                width: 100%;
            }
            .card {
                padding: 24px;
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
                <article class="card {{ $post->trashed() ? 'trashed' : '' }}">
                    <div class="card-meta">
                        <span class="author">{{ $post->user->name }}</span>
                        <span class="dot"></span>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <h2 class="card-title">
                        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                    </h2>
                    <p class="card-text">{{ $post->description }}</p>
                    <div class="card-actions">
                        @if(!$post->trashed())
                            <a href="{{ route('posts.edit', $post->id) }}" class="button secondary">Edit</a>
                            <button type="button" id="deleteButton{{ $post->id }}" class="button danger">Delete</button>
                        @else
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="button">Restore</button>
                            </form>
                        @endif
                    </div>
                </article>

                <div id="deleteModal{{ $post->id }}" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px; z-index: 9999;">
                        <div style="width: min(100%, 420px); max-width: 100%; background: #ffffff; border-radius: 24px; padding: 24px; box-shadow: 0 30px 60px rgba(15, 23, 42, 0.16);">
                            <p style="margin: 0 0 18px; color: #111827; font-size: 1rem; line-height: 1.6;">
                                Are you sure you want to delete this post? This action cannot be undone.
                            </p>

                             <div style="display: flex; gap: 0.75rem; justify-content: flex-end; flex-wrap: wrap;">
                                <button type="button" id="cancelDelete{{ $post->id }}" class="button secondary" style="min-height: 48px; border-radius: 14px; padding: 0 22px; background: #e2e8f0; color: #0f172a;">
                                    Cancel
                                </button>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="margin: 0;">
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
                            const deleteButton = document.getElementById('deleteButton{{ $post->id }}');
                            const deleteModal = document.getElementById('deleteModal{{ $post->id }}');
                            const cancelDelete = document.getElementById('cancelDelete{{ $post->id }}');

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

        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>
    </div>
</body>
</html>