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
                        <h4><b> {{ $user->surname }} {{ $user->first_name }} {{ $user->middle_name }}
                                ({{ $user->reg_number }})</b>
                        </h4>
                    </div>
            </section>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-7">
                            <h4>Student Information <a href="#" class="btn btn-light btn-outline" data-toggle="modal"
                                    data-target="#editStudentModal">
                                    <i class="fas fa-edit"></i>
                                </a></h4>
                        </div>
                        <div class="col-5">

                            <a href="#" class="btn btn-primary btn-outline" data-toggle="modal"
                                data-target="#enrolCourseModal">
                                Enroll Course
                            </a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <div class="row">
                                <div class="col-3">
                                    <h5> Reg. Number:</h5>
                                </div>
                                <div class="col-9">
                                    <h5><b>{{ $user->reg_number }}</b></h5>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    <h5> Sudent Name:</h5>
                                </div>
                                <div class="col-9">
                                    <h5><b>{{ $user->surname }} {{ $user->middle_name }} {{ $user->first_name }}</b></h5>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    <h5> Department:</h5>
                                </div>
                                <div class="col-9">
                                    <h5><b>{{ $user->department }}</b></h5>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    <h5> Program:</h5>
                                </div>
                                <div class="col-9">
                                    <h5><b>{{ $user->program }}</b></h5>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    <h5> Year:</h5>
                                </div>
                                <div class="col-9">
                                    <h5><b>{{ $user->year }}</b></h5>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-5" style="background-color:rgb(224, 224, 228); text-align:center">
                            <div class="bg-dark text-white" style="padding: 10px; margin-bottom:8px">
                                <h4><b>Courses Enrolled to This Student</b> <span
                                        style="color: rgb(43, 255, 0)">({{ count($user->courses) }})</span></h4>
                            </div>
                            @foreach ($user->courses as $index => $course)
                                <div class="row">
                                    <div class="col-10">
                                        <form method="get" action="{{ route('course', $course->id) }}">
                                            <button class="crs-btn  btn-outline-dark btn-sm attachements "
                                                style="margin-top: 5px;">
                                                <h5><b> {{ $course->code }}: {{ $course->title }}</b></h5>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-2">
                                        <form method="post" action="{{ route('detach_course', 'detach') }}">
                                            @csrf
                                            <input type="text" value="{{ $user->id }}" name="user_id" hidden>
                                            <input type="text" value="{{ $course->id }}" name="course_id" hidden>
                                            <button class="btn btn-outline-danger" type="submit"
                                                onclick="return confirm('This course will be removed')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
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
                <!-- ENROLL COURSE MODAL -->
                <div class="modal fade" id="enrolCourseModal">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Enroll Course</h5>
                                <button class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('attach_course', 'attach') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="role"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Course to enroll') }}</label>
                                        <div class="col-md-6">
                                            <select required name="course_id" class="dropdown-select form-control">
                                                <option value="">Select Course</option>
                                                @foreach ($allCourses as $allCourse)
                                                        <option value="{{ $allCourse->id }}">{{ $allCourse->code }}:
                                                            {{ $allCourse->title }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <input type="text" value="{{ $user->id }}" name="user_id" hidden>

                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Enroll</button>
                                    </div>
                                </form>
                            </div>

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
