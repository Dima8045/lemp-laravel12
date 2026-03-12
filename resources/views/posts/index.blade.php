<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Posts</h1>
    <div>
        @foreach ($posts as $post)
            <div>
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->published_at }}</p>
                <p>{{ Str::limit($post->excerpt, 150) }}</p>
                <a href="{{ route('posts.show', $post->slug) }}">Читати далі</a>
            </div>
        @endforeach
        <div>
            {{ $posts->links() }}
        </div>
    </div>
</body>
</html>