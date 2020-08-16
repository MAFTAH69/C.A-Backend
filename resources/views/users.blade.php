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

            <!-- ACTIONS -->
            <section id="actions" class="py-2 mb-4 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="#" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#addUserModal">
                                <i class="fas fa-plus"></i> Add User
                            </a>

                        </div>
                    </div>
                </div>
            </section>

            <section id="users">
                <div class="container">
                    @if (Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>USERS</h4>
                        </div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Reg. Number</th>
                                    <th>Surname</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Role</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)

                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->reg_number }}</td>
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->middle_name }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <b>{{ $role->name }},</b>
                                                <br>
                                            @endforeach
                                        </td>

                                        <td>
                                            <a href="{{ route('user', $user->id) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-info-circle">
                                                    View</i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('delete_user', $user->id) }}"
                                                onclick="return confirm('This user will be deleted')"
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

                            <form method="POST" action="{{ route('register_user') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="role"
                                        class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>
                                    <div class="col-md-6">
                                        <select required name="role" class="dropdown-select form-control">

                                            <option value="">Choose Role</option>
                                            @foreach ($roles as $role)
                                                @if ($role->name != 'Admin')

                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif

                                            @endforeach

                                        </select>
                                    </div>
                                </div>
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
                                    <label for="middle_name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="middle_name" type="text"
                                            class="form-control @error('middle_name') is-invalid @enderror"
                                            name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name"
                                            autofocus>

                                        @error('middle_name')
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
                                    <label for="department"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                                    <div class="col-md-6">
                                        <select name="department" class="dropdown-select form-control">
                                            <option value="">Select Department</option>
                                            <option value="CSE">Department of Computer Science and Engineering</option>
                                            <option value="ETE">Department of Electronics and Telecommunication Engineering
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="program"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Program') }}</label>
                                    <div class="col-md-6">
                                        <select name="program" class="dropdown-select form-control">
                                            <option value="">Select Program</option>
                                            <option value="BSc. with Computer Science">BSc. with Computer Science</option>
                                            <option value="BSc. in Computer Science">BSc. in Computer Science</option>
                                            <option value="BSc. in Computer Engineering and Information Technology">BSc. in
                                                Computer Engineering and Information Technology
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="year"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Year of Studies') }}</label>
                                    <div class="col-md-6">
                                        <select name="year" class="dropdown-select form-control">
                                            <option value="">Select Year</option>
                                            <option value="1">1st Year</option>
                                            <option value="2">2st Year</option>
                                            <option value="3">3st Year</option>
                                            <option value="4">4st Year</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            </form>
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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
                integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
                crossorigin="anonymous" />

            <script>
                // Get the current year for the copyright
                $('#year').text(new Date().getFullYear());
                // prog(selected) {
                //     console.log(selected);
                // }

            </script>
        </div>
    </div>
@endsection
