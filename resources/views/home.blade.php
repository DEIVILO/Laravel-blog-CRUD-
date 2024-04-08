<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            border: 3px solid black;
            margin: 10px;
            padding: 10px;
        }
        .post {
            background-color: #f0f0f0;
            padding: 10px;
            margin: 10px 0;
        }
        .post h3 {
            margin: 0;
        }
        .post p {
            margin: 5px 0;
        }
        form input[type="text"],
        form input[type="password"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        form button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    @auth
    <div class="container">
        <p>Congrats, you're logged in!</p>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Log Out</button>
        </form>
    </div>

    <div class="container">
        <h2>Create a new post!</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Post title">
            <textarea name="body" placeholder="Body content"></textarea>
            <button>Post</button>
        </form>
    </div>

    <div class="container">
        <h2>All posts:</h2>
        @foreach($posts as $post)
        <div class="post">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            <p>{{$post['body']}}</p>
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>

    @else
    <div class="container">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Name">
            <input name="email" type="text" placeholder="Email">
            <input name="password" type="password" placeholder="Password">
            <button>Register!</button>
        </form>
    </div>
    <div class="container">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="Name">
            <input name="loginpassword" type="password" placeholder="Password">
            <button>Login!</button>
        </form>
    </div>
    @endauth

</body>
</html>
