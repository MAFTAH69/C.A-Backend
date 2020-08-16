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


            <!-- POSTPONEMENTS -->
            <section id="postponements">
                <div class="container">
                    @if (Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>POSTPONEMENTS</h4>
                        </div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Reg. Number</th>
                                    <th>Student Name</th>
                                    <th>Type of Postponement</th>
                                    <th>Status</th>
                                    <th>Attachements</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postponements as $index => $postponement)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $postponement->user['reg_number'] }}</td>
                                        <td>{{ $postponement->user['surname'] }} {{ $postponement->user['first_name'] }}
                                            {{ $postponement->user['second_name'] }}</td>
                                        <td>{{ $postponement->postponable_type }}</td>
                                        <td>Waiting</td>

                                        <td>
                                            {{-- <a
                                                href="{{ route('postponement', $postponement->id) }}"
                                                --}} <a href="#" class="btn btn-outline-primary"
                                                data-toggle="modal" data-target="#openPostponementModal">
                                                <i class="fas fa-file">
                                                    Open</i>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('delete_postponement', $postponement->id) }}"
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

            <!-- OPEN POSTPONEMENT MODAL -->
            <div class="modal fade" id="openPostponementModal">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-light text-dark">
                            <h5 class="modal-title">Postponement Attachements</h5>
                            <button class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="attachements bg-primary" style="padding: 10px">
                            <a href="{{ route('postponement', 'attachement', $postponement->id) }}"
                                class="btn btn-lg btn-outline-light" target="_blank">Attachement
                                {{ $postponement->id }}</a>

                                <button class="btn btn-lg btn-outline-light" data-dismiss="modal">Attachement 3</button>
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
