<div style="background: #c3d7e4 !important; min-height: 80vh;  padding-top:10px ">

    <!-- HEADER -->

    <header id="main-header" class="py-2 text-dark">
        <div class="container">
            <div class="row">
                <h2 style="padding-left: 20px">
                    <i class="fas fa-cog"> Dashboard</i>
                </h2>
            </div>
        </div>
        <style>

        </style>
    </header>
    <hr>
    <div style="padding: 1em; color:rgb(17, 12, 12); ">
        <h4 class="nav-item-heading">Menu</h4>
        <li class="nav-item  list-unstyled">
            <a class="nav-link left-menu-link" href="{{ route('users') }}">

                <h5><i class="fas fa-users"> </i> All Users</h5>
            </a>
        </li>
        <li class="nav-item  list-unstyled">
            <a class="nav-link left-menu-link" href="{{ route('students') }}">
                <h5> <i class="fas fa-graduation-cap"> </i>
                    Students</h5>
            </a>
        </li>
        <li class="nav-item  list-unstyled">
            <a class="nav-link left-menu-link" href="{{ route('instructors') }}">
                <h5> <i class="fas fa-user"> </i>
                    Instructors</h5>
            </a>
        </li>
        <li class="nav-item  list-unstyled">
            <a class="nav-link left-menu-link" href="{{ route('courses') }}">
                <h5> <i class="fas fa-book"> </i>
                    Courses</h5>
            </a>
        </li>
        <li class="nav-item  list-unstyled">
            <a class="nav-link left-menu-link" href="{{ route('roles') }}">
                <h5> <i class="fas fa-wrench"> </i>
                    Roles</h5>
            </a>
        </li>
        <li class="nav-item  list-unstyled">
            <a class="nav-link left-menu-link" href="{{ route('postponements') }}">
                <h5> <i class="fas fa-history"> </i>
                    Postponements</h5>
            </a>
        </li>
        <hr>
        <h4 class="nav-item-heading">User Preferences </h4>
        <li class="nav-item  list-unstyled">
            <a class="nav-link left-menu-link">
                <h5> <i class="fas fa-key" aria-hidden="true"></i>

                    Change Password</h5>
            </a>
        </li>
    </div>
</div>
