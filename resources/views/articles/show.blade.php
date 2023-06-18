<!DOCTYPE html>
<html>
<head>
    <title>Article Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            margin-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        h2 {
            color: #333;
            margin: 20px 0;
        }

        .comment {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment p {
            margin-bottom: 5px;
        }

        form {
            margin-top: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
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
    </style>
</head>
<body>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <a href="{{ route('articles.index') }}">< Back to the Articles</a>
    <h1>{{ $article->title }}</h1>
    <p>Author: {{ $article->author }}</p>
    <p>{{ $article->content }}</p>

    <h2>Comments</h2>

    @foreach($article->comments as $comment)
        <div class="comment">
            <p><u>User</u>: {{ $comment->user }}</p>
            <p><u>Comment</u>: {{ $comment->comment }}</p>
        </div>
    @endforeach

    <br><br><br><br>

    <form id="commentForm" action="{{ route('comments.store', $article) }}" method="POST">
        @csrf

        <label for="user">User</label>
        <br>
        <input type="text" name="user" id="user">
        <br>
        <label for="comment">Comment area:</label>
        <br>
        <textarea name="comment" id="comment" rows="4"></textarea>
        <br>
        <button type="submit">Add Comment</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var commentForm = $('#commentForm');
            var commentInput = commentForm.find('#comment');
            var userInput = commentForm.find('#user');
            var isActivityLogged = false;

            // Force to go in user if user is empty
            commentInput.on('input', function() {
                if (userInput.val() === '') {
                    document.getElementById("comment").value = "";
                    userInput.focus();
                }
            });

            // Log activity when user leaves the page
            $(window).on('beforeunload', function() {
                if (!isActivityLogged) {
                    logActivity();
                }
            });

            // Function to log the activity
            function logActivity() {
                var comment = commentInput.val();
                var user = userInput.val();

                $.ajax({
                    url: "{{ route('comments.log') }}",
                    method: 'POST',
                    data: {
                        comment: comment,
                        user: user,
                        article: "{{ $article->id }}"
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response.message);
                        isActivityLogged = true; // Set the flag to true after logging
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error:", errorThrown);
                    }
                });
            }
        });
    </script>
</body>
</html>
