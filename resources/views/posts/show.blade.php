<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>{{ $post['title'] }}</title>
    <style>
        :root {
            color-scheme: dark light;
            color: #0f172a;
            background: #eef2ff;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top left, rgba(59, 130, 246, 0.16), transparent 24%),
                        radial-gradient(circle at bottom right, rgba(99, 102, 241, 0.18), transparent 28%),
                        #eef2ff;
        }

        .page {
            width: min(100%, 760px);
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 28px;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.08);
            padding: 32px;
        }

        .page header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 28px;
        }

        .page h1 {
            margin: 0;
            font-size: clamp(2rem, 2.4vw, 2.6rem);
            line-height: 1.05;
            color: #111827;
        }

        .meta {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            color: #475569;
            font-size: 0.95rem;
        }

        .meta span {
            background: #eef2ff;
            border-radius: 999px;
            padding: 10px 14px;
        }

        .content {
            color: #334155;
            line-height: 1.85;
            margin: 0 0 28px;
            white-space: pre-line;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
        }

        .button,
        .secondary-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 22px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.2s ease, filter 0.2s ease, box-shadow 0.2s ease;
        }

        .button {
            background: linear-gradient(135deg, #4338ca, #2563eb);
            color: #ffffff;
            border: none;
        }

        .button:hover {
            transform: translateY(-1px);
            filter: brightness(1.05);
        }

        .secondary-link {
            background: #f8fafc;
            color: #334155;
            border: 1px solid rgba(148, 163, 184, 0.35);
        }

        .secondary-link:hover {
            background: #eef2ff;
        }

        @media (max-width: 640px) {
            .page {
                padding: 24px;
            }

            .page header {
                flex-direction: column;
                align-items: stretch;
            }

            .actions {
                justify-content: stretch;
            }

            .button,
            .secondary-link {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header>
            <div>
                <h1>{{ $post['title'] }}</h1>
                <div class="meta">
                    <span>Post ID: {{ $post['id'] }}</span>
                </div>
            </div>
            <div class="actions">
                <a href="{{ route('posts.index') }}" class="secondary-link">Back to All Posts</a>
                <a href="{{ route('posts.edit', $post['id']) }}" class="secondary-link">Edit Post</a>
                <button type="button" id="deleteButton" class="button" style="background: #ef4444; box-shadow: 0 12px 24px rgba(239, 68, 68, 0.2);">
                    Delete
                </button>
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

                    <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="margin: 0;">
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


        <p class="content">{{ $post['content'] }}</p>
    </div>
</body>
</html>
