<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
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
            --panel-bg: #ffffff;
            --border: rgba(15, 23, 42, 0.08);
            --error: #ef4444;
        }

        * {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            background-color: var(--bg);
            background-image: radial-gradient(circle at top, rgba(99, 102, 241, 0.05), transparent 40%),
                              radial-gradient(circle at bottom right, rgba(56, 189, 248, 0.05), transparent 40%);
            font-family: 'Outfit', system-ui, sans-serif;
            color: var(--text-main);
        }

        .panel {
            width: min(100%, 560px);
            background: var(--panel-bg);
            border: 1px solid var(--border);
            border-radius: 32px;
            box-shadow: 0 40px 100px rgba(15, 23, 42, 0.08);
            padding: 48px;
            transition: transform 0.3s ease;
        }

        .panel h1 {
            margin: 0 0 12px;
            font-size: 2.25rem;
            font-weight: 800;
            letter-spacing: -0.04em;
            color: var(--text-main);
        }

        .panel p.subtitle {
            margin: 0 0 40px;
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 1.05rem;
        }

        .field {
            display: grid;
            gap: 10px;
            margin-bottom: 28px;
        }

        label {
            font-weight: 700;
            color: var(--text-main);
            font-size: 0.95rem;
            margin-left: 2px;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: 18px;
            padding: 16px 20px;
            font-size: 1rem;
            background: #ffffff;
            color: var(--text-main);
            font-family: inherit;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            appearance: none;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2.5' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 20px center;
            background-size: 18px;
            padding-right: 48px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 5px rgba(99, 102, 241, 0.12);
            background: #fff;
        }

        input:hover,
        textarea:hover,
        select:hover {
            border-color: #cbd5e1;
        }

        .error-msg {
            color: var(--error);
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 4px;
            margin-left: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        textarea {
            min-height: 160px;
            resize: vertical;
            line-height: 1.6;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 36px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 56px;
            padding: 0 32px;
            border: none;
            border-radius: 20px;
            background: var(--primary);
            color: #ffffff;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.2);
            text-decoration: none;
        }

        .button:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.3);
        }

        .button:active {
            transform: translateY(0);
        }

        .secondary-link {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }

        .secondary-link:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        @media (max-width: 560px) {
            .panel {
                padding: 32px 24px;
                border-radius: 0;
                border: none;
                box-shadow: none;
                background: transparent;
            }
            .actions {
                flex-direction: column;
            }
            .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="panel">
        <h1>Create a New Post</h1>
        <p class="subtitle">Quickly add a fresh post with a clean, modern form designed for readability and focus.</p>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Enter post title">
                @error('title')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Write your post description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="user_id">Post Creator</label>
                <select id="user_id" name="user_id">
                    <option value="" disabled selected>Select a creator</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="image">Post Image</label>
                <input type="file" id="image" name="image" accept="image/*" style="padding: 12px;">
                @error('image')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="actions">
                <button type="submit" class="button">Save Post</button>
                <a href="{{ route('dashboard') }}" class="secondary-link">Back to Dashboard</a>
            </div>
        </form>
    </main>
</body>
</html>