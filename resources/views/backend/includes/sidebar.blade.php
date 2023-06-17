<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            @if ($logged_in_user->isAdmin())
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/patient'))
                }}" href="{{ route('admin.Patients.index') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    المرضى
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/session'))
                }}" href="{{ route('admin.sessions.index') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    الجلسات
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/mes/create'))
                }}" href="{{ route('admin.mes.edit', ['me' => 1]) }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    بروفيلي
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/patient'))
                }}" href="{{ route('admin.appointments.index') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    المواعيد
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/cost'))
                }}" href="{{ route('admin.costs.index') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    المصاريف
                </a>
            </li>

            <!-- ToDo -->
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('/backup'))
                }}" href="{{ route('admin.backup.db') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    النسخ الاحتياطي
                </a>
            </li>

            @endif

            @if ($logged_in_user->isAdmin())
            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>

            <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                    <i class="nav-icon far fa-user"></i>
                    @lang('menus.backend.access.title')

                    @if ($pending_approval > 0)
                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                    @endif
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                            @lang('labels.backend.access.users.management')

                            @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                            @lang('labels.backend.access.roles.management')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                                active_class(Route::is('admin/auth/permission*'))
                            }}" href="{{ route('admin.auth.permission.index') }}">
                            @lang('labels.backend.access.permissions.management')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="divider"></li>

            <li class="nav-title">
                قسم الصيانة البرمجية
            </li>

            <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/log-viewer*'), 'open')
                }}">
                <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/log-viewer*'))
                        }}" href="#">
                    <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-title">
                صلاحيات المستخدم
            </li>
            @endif

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->