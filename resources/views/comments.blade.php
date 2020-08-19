@extends('layouts.app')
@section('sidebar')
    <div class="col-md-2">
        @include('components.left_nav')
    </div>
@endsection

@section('content')
    <div class="col-md-10 py-3">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


            <!-- Comments -->
            <section id="comments">
                <div class="container">
                    @if (Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>COMMENTS</h4>
                        </div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Reg. Number</th>
                                    <th>Staff Name</th>
                                    <th>Postponement Id</th>
                                    <th>Body</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $index => $comment)
                                    @foreach ($users as $user)
                                        @if ($user->id == $comment->user_id)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->reg_number }}</td>
                                                <td>{{ $user->surname }} {{ $user->first_name }} {{ $user->middle_name }}
                                                </td>
                                                <td>{{ $comment->postponement_id }}</td>
                                                <td style="max-width: 300px"><b>{{ $comment->body }}</b></td>
                                                <td>
                                                    <a href="{{ route('delete_comment', $comment->id) }}"
                                                        onclick="return confirm('This comment will be deleted')"
                                                        class="btn btn-outline-danger">
                                                        <i class="fas fa-trash"> Delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!--FOOTER  -->
            <footer id="main-footer" class="bg-light text-dark mb-3">
                <div class="container">
                    <div class="col">
                        <hr>
                        <p class="lead text-center">
                            Copyright &copy; <span id="year"></span> UDSM
                        </p>
                    </div>
                </div>
            </footer>
            <!-- MODALS -->


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
                integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
                crossorigin="anonymous" />

            <script>
                // Get the current year for the copyright
                $('#year').text(new Date().getFullYear());

                CKEDITOR.replace('editor1');

            </script>
        </div>
    </div>
@endsection
