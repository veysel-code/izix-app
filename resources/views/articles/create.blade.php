<!DOCTYPE html>
<html>
<head>
    <title>Create Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin: 30px auto;
            max-width: 500px;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <a href="{{ route('articles.index') }}">< Back to the Articles</a>
    <br>
    <br>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="author">Author</label>
        <input type="text" name="author" id="author">
        <br>
        <label for="content">Content</label>
        <textarea name="content" id="content" rows="4"></textarea>
        <br>
        <button type="submit">Add Article</button>
    </form>
</body>
</html>
