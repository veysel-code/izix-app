<!DOCTYPE html>
<html>
<head>
    <title>Articles Listing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        h2 {
            color: #555;
        }

        div {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        p {
            color: #777;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        i {
            display: block;
            text-align: center;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <h1>Articles Listing</h1>

    @foreach($articles as $article)
        <div>
            <a href="{{ route('articles.show', $article) }}"><h2>{{ $article->title }}</h2></a>
            <p>{{ $article->author }}</p>
            <p>{{ $article->content }}</p>
        </div>
    @endforeach
    <br><br><br>
    <i><a href="{{ route('articles.create') }}">Create an article</a></i>
    <i><a href="{{ route('logs.index') }}">Show the comment logs</a></i>
</body>
</html>
