<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper ">
        <div class="sidebar-brand">
            <a href="index.html" class="" style="width:100%">
                <img alt="image" class="rounded-circle mr-3" width="50" src="{{ asset('img/logo-lms.png') }}">
                <span style="width: 50%">{{ __('Sikola App') }}</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">

                <img alt="image" class="rounded-circle" width="50" src="{{ asset('img/logo-lms.png') }}">

            </a>
        </div>
        <div class=" d-flex flex-column justify-content-between " style="height: 90vh">
            <ul class="sidebar-menu">

                @if (Session('user')['role'] == 'Murid')
                    <li class="{{ Request::is('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('student/home') }}"><i class="fas fa-th-large"></i>
                            <span>{{ __('Dashboard') }}</span></a>
                    </li>
                    <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('student/materi') }}"><i class="fas fa-home"></i>
                            <span>{{ __('Material') }}</span></a>
                    </li>
                    {{-- <li class="{{ Request::is('quizzes') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('student/quizzes') }}"><i class="fas fa-file-pen"></i>
                            <span>{{ __('Quiz') }}</span></a>
                    </li> --}}
                    <li class="{{ Request::is('assignment') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('student/assignment') }}"><i class="fas fa-file-pen"></i>
                            <span>{{ __('Assignment') }}</span></a>
                    </li>
                    <li class="{{ Request::is('student/lesson-schedules*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('student/lesson-schedules') }}"><i
                                class="fas fa-calendar-alt"></i>
                            <span>{{ __('Jadwal Pelajaran') }}</span></a>
                    </li>
                @endif
                {{-- <li class="menu-header">{{ __('Dashboard') }}</li> --}}

                @if (Session('user')['role'] == 'Admin')
                    <li class="{{ Request::is('/admin/home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/home') }}"><i class="fas fa-th-large"></i>
                            <span>{{ __('Dashboard') }}</span></a>
                    </li>

                    {{-- <li class="{{ Request::is('quizzes/score') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/quiz') }}"><i class="fas fa-file-pen"></i>
                            <span>{{ __('Result Quiz') }}</span></a>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-columns"></i>
                            <span>{{ __('Manajemen Pengguna') }}</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ Request::is('gurus') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('admin/gurus') }}"><i class="fas fa-user"></i>
                                    <span>Manajemen Guru</span></a>
                            </li>
                            <li class="{{ Request::is('manage-student') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('admin/manage-student') }}"><i
                                        class="fas fa-user"></i>
                                    <span>{{ __('Manage Students') }}</span></a>
                            </li>


                        </ul>
                    </li>

                    <li class="{{ Request::is('classes') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/classes') }}"><i class="fas fa-school"></i>
                            <span>{{ __('Manage Classes') }}</span></a>
                    </li>
                    <li class="{{ Request::is('lessons') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/lessons') }}"><i class="fas fa-book"></i>
                            <span>{{ __('Manage Lessons') }}</span></a>
                    </li>
                    <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/materi') }}"><i class="fas fa-home"></i>
                            <span>{{ __('Material') }}</span></a>
                    </li>
                    <li class="{{ Request::is('lesson-schedules') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('admin/lesson-schedules') }}"><i
                                class="fas fa-calendar-alt"></i>
                            <span>{{ __('Lesson Schedules') }}</span></a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-columns"></i>
                            <span>{{ __('Manage Quiz') }}</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ Request::is('admin/quizzes') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('admin/quizzes') }}">{{ __('Quiz') }}</a>
                            </li>
                        

                        </ul>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-columns"></i>
                            <span>{{ __('Assignment') }}</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ Request::is('admin/assignment') ? 'active' : '' }}">
                                <a class="nav-link"
                                    href="{{ url('admin/assignment') }}">{{ __('Manage Assignment') }}</a>
                            </li>
                            <li class="{{ Request::is('submission/') ? 'active' : '' }}">
                                <a class="nav-link"
                                    href="{{ url('admin/assignments/submission/') }}">{{ __('Result') }}</a>
                            </li>

                        </ul>
                    </li>
                @endif


                @if (Session('user')['role'] == 'Guru')
                    <li class="{{ Request::is('/teacher/home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('teacher/home') }}"><i class="fas fa-th-large"></i>
                            <span>{{ __('Dashboard') }}</span></a>
                    </li>
                    <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('teacher/materi') }}"><i class="fas fa-home"></i>
                            <span>{{ __('Material') }}</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-columns"></i>
                            <span>{{ __('Assignment') }}</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{ Request::is('teacher/assignment') ? 'active' : '' }}">
                                <a class="nav-link"
                                    href="{{ url('teacher/assignment') }}">{{ __('Manage Assignment') }}</a>
                            </li>
                            <li class="{{ Request::is('submission/') ? 'active' : '' }}">
                                <a class="nav-link"
                                    href="{{ url('teacher/assignments/submission/') }}">{{ __('Result') }}</a>
                            </li>

                        </ul>
                    </li>
                    <li class="{{ Request::is('lesson-schedules') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('teacher/lesson-schedules') }}"><i
                                class="fas fa-calendar-alt"></i>
                            <span>{{ __('Lesson Schedules') }}</span></a>
                    </li>
                @endif

            </ul>

            {{-- <div class="hide-sidebar-mini mt-4 mb-4 p-3">
                <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Documentation
                </a>
            </div> --}}
        </div>

    </aside>
</div>
