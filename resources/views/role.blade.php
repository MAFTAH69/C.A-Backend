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
            <section id="actions" class="py-2 mb-4 bg-light">
                <div class="container">
                    <div class="row px-3 ">
                        <h4><b> {{ $role->name }} Role</b>
                        </h4>
                    </div>
            </section>
            <section id="users">
                <div class="container">
                    @if (Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>USERS ASSIGNED TO THIS ROLE</h4>
                        </div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Reg. Number</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Second Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($role->users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->reg_number }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->middle_name }}</td>

                                        <td>
                                            <form method="post" action="{{ route('detach_role', 'detach') }}">
                                                @csrf
                                            <input type="text" value="{{$user->id}}" name="user_id" hidden>
                                            <input type="text" value="{{$role->id}}" name="role_id" hidden>
                                                <button class="btn btn-outline-danger" type="submit" onclick="return confirm('This user will be removed')">
                                                    <i class="fas fa-trash"> Remove</i>
                                                </button>
                                            </form>
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
