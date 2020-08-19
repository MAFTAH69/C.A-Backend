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
            @if (session('errors'))
                <div class="alert alert-success" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
            <div class="card" style="margin-left: 250px; margin-right: 250px;">
                <div class="card-header">
                    <h4><b>{{ $test->title }} Scores</b> / <b>{{ $test->weight }}</b></h4>
                </div>
                <table class="table table-striped">
                    <tr>
                        <thead class="thead-dark">
                            <th>#</th>
                            <th>Reg. Number</th>
                            {{-- <th>Student Name</th> --}}
                            <th>Marks</th>
                        </thead>
                    </tr>
                    <tbody>
                        @foreach ($test->scores as $index => $score)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $score->reg_number }}</td>
                                        {{-- <td>{{ $user->surname }} {{ $user->first_name }} {{ $user->middle_name }}</td> --}}
                                        <td><b>{{ $score->test_score }}</b></td>
                                    </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

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


            <style>
            </style>
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
