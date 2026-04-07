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

        @if($post->image)
            <div style="margin-bottom: 40px; border-radius: 24px; overflow: hidden; border: 1px solid var(--border); box-shadow: 0 20px 40px rgba(0,0,0,0.04);">
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: auto; display: block;">
            </div>
        @endif

        <p class="content">{{ $post->description }}</p>

        <div style="margin-top: 60px; padding-top: 40px; border-top: 1.5px solid #f1f5f9; margin-bottom: 40px;">
            <h2 style="font-size: 1.5rem; margin-bottom: 24px; font-weight: 700;">Comments ({{ $post->comments->count() }})</h2>

            <!-- Comments List -->
            <div style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 40px;">
                @forelse($post->comments as $comment)
                    <div style="padding: 20px; background: #f8fafc; border-radius: 16px; border: 1px solid var(--border);">
                        <p style="margin: 0; color: var(--text-main); line-height: 1.6;">
                            <strong style="color: var(--primary);">{{ $comment->user->name ?? 'User 1' }}:</strong> {{ $comment->content }}
                        </p>
                        <small style="display: block; margin-top: 10px; color: var(--text-muted);">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <p style="color: var(--text-muted); font-style: italic;">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>

            <!-- Add Comment Form -->
            <form action="{{ route('comments.store', $post->id) }}" method="POST" style="background: #ffffff; border: 1px solid var(--border); padding: 24px; border-radius: 20px;">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label for="user_id" style="display: block; margin-bottom: 8px; font-weight: 600;">Post as User</label>
                    <select name="user_id" id="user_id" style="width: 100%; padding: 12px; border-radius: 12px; border: 1.5px solid #e2e8f0; background: #fff; font-family: inherit; font-size: 1rem;" required>
                        <option value="" disabled selected>Select a user</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span style="color: #ef4444; font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 16px;">
                    <label for="content" style="display: block; margin-bottom: 8px; font-weight: 600;">Add a comment</label>
                    <textarea name="content" id="content" rows="3" style="width: 100%; padding: 12px; border-radius: 12px; border: 1.5px solid #e2e8f0; font-family: inherit; font-size: 1rem; resize: vertical;" placeholder="Write your thoughts..." required></textarea>
                    @error('content')
                        <span style="color: #ef4444; font-size: 0.85rem; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="button primary" style="width: fit-content; height: 44px; padding: 0 20px; font-size: 0.9rem;">Post Comment</button>
            </form>
        </div>

        <div class="actions">
            <a href="{{ route('dashboard') }}" class="button secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
