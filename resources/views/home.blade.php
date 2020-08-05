@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center"> --}}
            {{-- <div class="col-md-8">
                <div class="card"> --}}
                    {{-- <div class="card-header">{{ __('Dashboard') }}</div>
                    --}}

                    {{-- <div class="card-body"> --}}
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- {{ __('You are logged in!') }} --}}
                        {{-- </div> --}}
                    {{-- </div>
            </div> --}}
            {{-- </div> --}}


        <!-- HEADER -->

        <header id="main-header" class="py-2 bg-white text-dark">
            <div class="container">
                <div class="row">
                    <h2 style="padding-left: 20px">
                        <i class="fas fa-cog"> Admin Dashboard</i>
                    </h2>
                </div>
            </div>
        </header>


        <!-- ACTIONS -->
        <section id="actions" class="py-4 mb-4 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="#" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#addUserModal">
                            <i class="fas fa-plus"></i> Add User
                        </a>

                    </div>
                </div>
        </section>

        <!-- USERS -->
        <section id="users">
            <div class="container">

                <div class="card">
                    <div class="card-header">
                        <h4>Users</h4>
                    </div>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Reg. Number</th>
                                <th>Surname</th>
                                <th>First Name</th>
                                <th>Second Name</th>
                                <th>Role</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2017-04-07374</td>
                                <td>Maftah  </td>
                                <td>Ally</td>
                                <td>Waziri</td>
                                <td>Admin</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2017-04-00000</td>
                                <td>Nawal </td>
                                <td>Ally</td>
                                <td>Waziri</td>
                                <td>Principle</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2017-04-07377</td>
                                <td>Gordon </td>
                                <td>Ally</td>
                                <td>Waziri</td>
                                <td>Student</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2017-04-07374</td>
                                <td>Maftah</td>
                                <td>Ally</td>
                                <td>Waziri</td>
                                <td>Admin</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2017-04-00000</td>
                                <td>Nawal Hemed</td>
                                <td>Ally</td>
                                <td>Waziri</td>
                                <td>Principle</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2017-04-07377</td>
                                <td>Gordon Nchy</td><td>Ally</td>
                                <td>Waziri</td>
                                <td>Student</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2017-04-07374</td>
                                <td>Maftah Ally Waziri</td><td>Ally</td>
                                <td>Waziri</td>
                                <td>Admin</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2017-04-00000</td>
                                <td>Nawal Hemed</td><td>Ally</td>
                                <td>Waziri</td>
                                <td>Principle</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2017-04-07377</td>
                                <td>Gordon Nchy</td><td>Ally</td>
                                <td>Waziri</td>
                                <td>Student</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#editUserModal"> Update</i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
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

        <!-- ADD USER MODAL -->
        <div class="modal fade" id="addUserModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add User</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="second_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Second Name') }}</label>

                                <div class="col-md-6">
                                    <input id="second_name" type="text"
                                        class="form-control @error('second_name') is-invalid @enderror" name="second_name"
                                        value="{{ old('second_name') }}" required autocomplete="second_name" autofocus>

                                    @error('second_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="surname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reg_number"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Registration Number') }}</label>

                                <div class="col-md-6">
                                    <input id="reg_number" type="text"
                                        class="form-control @error('reg_number') is-invalid @enderror" name="reg_number"
                                        value="{{ old('reg_number') }}" required autocomplete="reg_number">

                                    @error('reg_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- EDIT USER MODAL -->
        <div class="modal fade" id="editUserModal">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit User</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="book">Book</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control">
                                </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal">Edit</button>
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
@endsection
