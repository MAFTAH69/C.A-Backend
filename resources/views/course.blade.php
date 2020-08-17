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

            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

            <section id="actions" class="py-2 mb-4 bg-light">
                <div class="container">
                    <div class="row px-3 ">
                        <h4><b> {{ $course->code }}: {{ $course->title }}</b>
                        </h4>
                    </div>
            </section>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4>Course Information <a href="#" class="btn btn-light btn-outline" data-toggle="modal"
                                    data-target="#editCourseModal">
                                    <i class="fas fa-edit"></i>
                                </a></h4>
                        </div>
                        <div class="col-4">
                            <div class="">
                                <i class="fas fa-arrow-down"></i> Coursework Assessment
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4">
                                    <h5> Course Code:</h5>
                                </div>
                                <div class="col-8">
                                    <h5><b>{{ $course->code }}</b></h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <h5> Course Name:</h5>
                                </div>
                                <div class="col-8">
                                    <h5><b>{{ $course->title }}</b></h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <h5> Course Credits:</h5>
                                </div>
                                <div class="col-8">
                                    <h5><b>{{ $course->credits }}</b></h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <h5> Semester to be tought:</h5>
                                </div>
                                <div class="col-8">
                                    <h5><b>{{ $course->semester }}</b></h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <h5> Year to be tought:</h5>
                                </div>
                                <div class="col-8">
                                    <h5><b>{{ $course->year }}</b></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-4" style="background-color:rgb(224, 224, 228)">
                            @foreach ($course->tests as $test)
                                <a href="{{ route('test', $test->id) }}" class="btn btn-outline-primary  "
                                    style="margin-top: 5%">
                                    <h4><b> {{ $test->title }}</b></h4>
                                </a>
                            @endforeach
                            <br>
                            @foreach ($course->quizzes as $quiz)
                                <a href="{{ route('quiz', $quiz->id) }}" class="btn btn-outline-primary  "
                                    style="margin-top: 5%">
                                    <h4><b> {{ $quiz->title }}</b></h4>
                                </a>
                            @endforeach
                            <br>
                            @foreach ($course->practicals as $practical)
                                <a href="{{ route('practical', $practical->id) }}" class="btn btn-outline-primary  " style="margin-top: 5%">
                                    <h4><b> {{ $practical->title }}</b></h4>
                                </a>
                            @endforeach
                            <br>
                            @foreach ($course->assignments as $assignment)
                                <a href="{{ route('assignment', $assignment->id) }}" class="btn btn-outline-primary  " style="margin-top: 5%">
                                    <h4><b> {{ $assignment->title }}</b></h4>
                                </a>
                            @endforeach
                        </div>

                    </div>
                    <hr>
                    <div>
                        <div class="" style="text-align: center">
                            <h4><b>Users Enrolled to This Course</b></h4>
                        </div>
                        <div class="users-division">
                            <div class="row" style="text-align: center; background-color: rgb(244, 248, 248)">
                                <div class="col-6">
                                    <h4><b>Students</b></h4>

                                    <table class="table table-striped">
                                        <thead class="tbhd">
                                            <tr>
                                                <th>#</th>
                                                <th>Reg. Number</th>
                                                <th>Name</th>

                                            </tr>
                                            <hr>
                                        </thead>
                                        <tbody>
                                            @foreach ($course->users as $index => $user)
                                                @foreach ($user->roles as $role)
                                                    @if ($role->name == 'Student')
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $user->reg_number }}</td>
                                                            <td>{{ $user->surname }} {{ $user->first_name }}
                                                                {{ $user->middle_name }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <h4><b>Instructor</b></h4>
                                    <table class="table table-striped">
                                        <thead class="tbhd">
                                            <tr>
                                                <th>#</th>
                                                <th>Reg. Number</th>
                                                <th>Name</th>
                                            </tr>
                                            <hr>
                                        </thead>
                                        <tbody>
                                            @foreach ($course->users as $index => $user)

                                                @foreach ($user->roles as $role)
                                                    @if ($role->name == 'Instructor')
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $user->reg_number }}</td>
                                                            <td>{{ $user->surname }} {{ $user->first_name }}
                                                                {{ $user->middle_name }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            <!-- ADD COURSE MODAL -->
            <div class="modal fade" id="editCourseModal">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Course</h5>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="PUT" action="{{ route('edit_course', $course->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control" name="code" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Credits</label>
                                    <input type="text" class="form-control" name="credits" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Year</label>
                                    <input type="text" class="form-control" name="year" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Semester</label>
                                    <input type="text" class="form-control" name="semester" required>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


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
