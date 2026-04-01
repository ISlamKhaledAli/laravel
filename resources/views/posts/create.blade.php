<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        :root {
            color-scheme: dark light;
            color: #111827;
            background: #f8fafc;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: radial-gradient(circle at top, rgba(99, 102, 241, 0.12), transparent 28%),
                        radial-gradient(circle at bottom right, rgba(56, 189, 248, 0.16), transparent 26%),
                        #f8fafc;
        }

        .panel {
            width: min(100%, 520px);
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 28px;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.08);
            padding: 36px;
        }

        .panel h1 {
            margin: 0 0 10px;
            font-size: clamp(1.9rem, 2.2vw, 2.4rem);
            letter-spacing: -0.03em;
            color: #111827;
        }

        .panel p.subtitle {
            margin: 0 0 28px;
            color: #6b7280;
            line-height: 1.75;
        }

        .field {
            display: grid;
            gap: 10px;
            margin-bottom: 22px;
        }

        label {
            font-weight: 600;
            color: #111827;
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 14px 16px;
            font-size: 1rem;
            background: #ffffff;
            color: #111827;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.14);
        }

        textarea {
            min-height: 180px;
            resize: vertical;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
            justify-content: space-between;
            margin-top: 12px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 22px;
            border: none;
            border-radius: 14px;
            background: #4f46e5;
            color: #ffffff;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
            text-decoration: none;
        }

        .button:hover {
            background: #4338ca;
            transform: translateY(-1px);
        }

        .secondary-link {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        .secondary-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 520px) {
            body {
                padding: 16px;
            }

            .panel {
                padding: 28px 20px;
            }
        }
    </style>
</head>
<body>
    <main class="panel">
        <h1>Create a New Post</h1>
        <p class="subtitle">Quickly add a fresh post with a clean, modern form designed for readability and focus.</p>

        <form>
            <div class="field">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Enter post title">
            </div>

            <div class="field">
                <label for="content">Content</label>
                <textarea id="content" name="content" placeholder="Write your post content"></textarea>
            </div>

            <div class="actions">
                <button type="submit" class="button">Save Post</button>
                <a href="{{ route('posts.index') }}" class="secondary-link">Back to All Posts</a>
            </div>
        </form>
    </main>
</body>
</html>