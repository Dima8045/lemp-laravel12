<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('posts.index') }}">Назад до списку</a>

    <h1>{{ $post->title }}</h1>
    <p>{{ $post->published_at }}</p>
    <p>{!! nl2br(e($post->body)) !!}</p>
</body>
</html>