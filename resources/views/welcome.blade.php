<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel-FYP</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Times New Roman', Times, serif;
            font-weight: 200;
            height: 100vh;
            /* margin: 0; */
        }

        .content {
            text-align: center;

        }

        .full-height {
            height: 80vh;
        }

        .title {
            font-size: 30px;
        }

        .main-form {
            max-width: 330px;
            margin-top: 5%;
            text-align: center;

        }

        .form-container {
            background-color: rgb(202, 198, 198);
            margin: auto;
        }

        form {
            padding: 0px 15px 1px 15px;
        }

        .form-container h3 {
            margin: 0;
            padding: 5px;
            text-align: center;
            background-color: rgb(102, 101, 99);
            color: #fff;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 80px;
            /* margin-right: 20px; */
        }

        .reg-btn {
            margin-top: 20px;
            margin-left: 90%;
            margin-bottom: 200px;

            color: brown;
        }

    </style>
</head>

<body>
    <div class="reg-btn">
        <div class="btn btn-default">Register</div>

    </div>
    <div class="full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                COURSEWORK ASSESSMENT AND POSTPONEMENT SYSTEM
            </div>
            <div class="main-form">
                <div class="form-container">
                    <h3>Login</h3>
                    <form action="">
                        <p></p>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" id='username'>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id='password'>
                        </div>
                        <div class="form-group login-buttons">
                            <label>&nbsp;</label>
                            <button @click.prevent="submitFunction()" type="submit"
                                class="btn btn-primary"><b>Login</b></button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
