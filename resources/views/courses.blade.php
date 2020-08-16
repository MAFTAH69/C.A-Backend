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


            <!-- ACTIONS -->
            <section id="actions" class="py-2 mb-4 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="#" class="btn btn-primary btn-outline" data-toggle="modal"
                                data-target="#addCourseModal">
                                <i class="fas fa-plus"></i> Add Course
                            </a>
                        </div>
                    </div>
            </section>

            <!-- COURSES -->
            <section id="courses">
                @if (Session::has('message'))<button type="button" class="close"
                        data-dismiss="alert">×</button>
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <div class="container">

                    <div class="card">
                        <div class="card-header">
                            <h4>COURSES</h4>
                        </div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Course Code</th>
                                    <th>Title</th>
                                    <th>Credits</th>
                                    <th>Semester</th>
                                    <th>Year</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $index => $course)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $course->code }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->credits }}</td>
                                        <td>{{ $course->semester }}</td>
                                        <td>{{ $course->year }}</td>

                                        <td>
                                            <a href="{{ route('course', $course->id) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-info-circle">
                                                    View</i>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('delete_course', $course->id) }}"
                                                onclick="return confirm('Are you sure you want to delete ?')"
                                                class="btn btn-outline-danger">
                                                <i class="fas fa-trash"> Delete</i>
                                            </a>

                                        </td>
                                    </tr>
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
            <!-- ADD COURSE MODAL -->
            <div class="modal fade" id="addCourseModal">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Add Course</h5>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('add_course') }}">
                                @csrf
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control" name="code" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Credits</label>
                                        <input type="number" class="form-control" name="credits" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Year</label>
                                        <input type="number" class="form-control" name="year" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Semester</label>
                                        <input type="number" class="form-control" name="semester" required >
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Add</button>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



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
