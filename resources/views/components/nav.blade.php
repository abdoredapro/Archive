<div class="sidebar">
    <img class="logo" src="{{ asset('assets/Logo.png') }}" alt="">
    <ul>
        @can('home.view')
            <li class="{{ Route::is('dashboard.home') ? 'active' : '' }}">
                <a class="stack {{ Route::is('dashboard.home') ? 'active' : '' }}" href="{{ route('dashboard.home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                           stroke-width="1.5">
                            <circle cx="17" cy="7" r="3"/>
                            <circle cx="7" cy="17" r="3"/>
                            <path
                                d="M14 14h6v5a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zM4 4h6v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z"/>
                        </g>
                    </svg>
                    <span>الرئيسية</span>
                </a>
            </li>
        @endcan

        @can('category.view')
            <li class="{{ Route::is('dashboard.category.*') ? 'active' : '' }}">
                <a class="stack {{ Route::is('dashboard.category.*') ? 'active' : '' }}"
                   href="{{ route('dashboard.category.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48">
                        <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                            <path d="M10 44a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h28a2 2 0 0 1 2 2v36a2 2 0 0 1-2 2z"/>
                            <path stroke-linecap="round" d="M21 22V4h12v18l-6-6.273z" clip-rule="evenodd"/>
                            <path stroke-linecap="round" d="M10 4h28"/>
                        </g>
                    </svg>
                    <span>الفئات</span>
                </a>
            </li>
        @endcan

        @can('files.view')
            <li class="{{ Route::is('dashboard.file.*') ? 'active' : '' }}">
                <a class="stack {{ Route::is('dashboard.file.*') ? 'active' : '' }}"
                   href="{{ route('dashboard.file.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                           stroke-width="1.5">
                            <path d="M14.186 2.753v3.596c0 .487.194.955.54 1.3a1.85 1.85 0 0 0 1.306.539h4.125"/>
                            <path
                                d="M20.25 8.568v8.568a4.251 4.251 0 0 1-1.362 2.97a4.283 4.283 0 0 1-3.072 1.14h-7.59a4.294 4.294 0 0 1-3.1-1.124a4.265 4.265 0 0 1-1.376-2.986V6.862a4.25 4.25 0 0 1 1.362-2.97a4.283 4.283 0 0 1 3.072-1.14h5.714a3.503 3.503 0 0 1 2.361.905l2.96 2.722a2.971 2.971 0 0 1 1.031 2.189M7.647 7.647h3.265M7.647 12h8.706m-8.706 4.353h8.706"/>
                        </g>
                    </svg>
                    <span>ملفات</span>
                </a>
            </li>
        @endcan


        @can('films.view')
            <li class="{{ Route::is('dashboard.film.*') ? 'active' : '' }}">
                <a class="stack {{ Route::is('dashboard.film.*') ? 'active' : '' }}"
                   href="{{ route('dashboard.film.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="m19.65 6.5l-2.74-3.54l3.93-.78l.78 3.92zm-2.94.57l-2.74-3.53l-1.97.39l2.75 3.53zM19 13c1.1 0 2.12.3 3 .81V10H2v10a2 2 0 0 0 2 2h9.81c-.51-.88-.81-1.9-.81-3c0-3.31 2.69-6 6-6m-7.19-4.95L9.07 4.5l-1.97.41l2.75 3.53zM4.16 5.5l-.98.19a2.01 2.01 0 0 0-1.57 2.35L2 10l4.9-.97zM20 18v-3h-2v3h-3v2h3v3h2v-3h3v-2z"/>
                    </svg>
                    <span>افلام</span>
                </a>
            </li>
        @endcan

        @can('projects.view')
            <li class="{{ Route::is('dashboard.projects.*') ? 'active' : '' }}">
            <a class="stack {{ Route::is('dashboard.projects.*') ? 'active' : '' }}"
               href="{{ route('dashboard.projects.index') }}">
                <i class="fa-solid fa-user-shield"></i>
                <span>مشاريع / مستفيدون</span>
            </a>
        </li>
        @endcan

        @can('reports.view')
            <li class="{{ Route::is('dashboard.reports.*') ? 'active' : '' }}">
            <a class="{{ Route::is('dashboard.reports.*') ? 'active' : '' }} stack"
               href="{{ route('dashboard.reports.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="m20 8l-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM9 19H7v-9h2zm4 0h-2v-6h2zm4 0h-2v-3h2zM14 9h-1V4l5 5z"/>
                </svg>
                <span>التقارير</span>
            </a>
        </li>
        @endcan

        @can('settings.view')
            <li class="{{ Route::is('dashboard.user') ? 'active' : '' }}">
            <a class="stack {{ Route::is('dashboard.settings') ? 'active' : '' }} "
               href="{{ route('dashboard.settings') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48">
                    <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                        <path
                            d="M18.284 43.171a19.995 19.995 0 0 1-8.696-5.304a6 6 0 0 0-5.182-9.838A20.09 20.09 0 0 1 4 24c0-2.09.32-4.106.916-6H5a6 6 0 0 0 5.385-8.65a19.968 19.968 0 0 1 8.267-4.627A6 6 0 0 0 24 8a6 6 0 0 0 5.348-3.277a19.968 19.968 0 0 1 8.267 4.627A6 6 0 0 0 43.084 18A19.99 19.99 0 0 1 44 24c0 1.38-.14 2.728-.406 4.03a6 6 0 0 0-5.182 9.838a19.995 19.995 0 0 1-8.696 5.303a6.003 6.003 0 0 0-11.432 0Z"/>
                        <path d="M24 31a7 7 0 1 0 0-14a7 7 0 0 0 0 14Z"/>
                    </g>
                </svg>
                <span>الا عدادات</span>
            </a>
        </li>
        @endcan

        @can('export.view')
            <li class="{{ Route::is('server.index') ? 'active' : '' }}">
            <a class="stack {{ Route::is('server.index') ? 'active' : '' }} "
                href="{{ route('server.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48">
                    <g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4">
                        <path
                            d="M18.284 43.171a19.995 19.995 0 0 1-8.696-5.304a6 6 0 0 0-5.182-9.838A20.09 20.09 0 0 1 4 24c0-2.09.32-4.106.916-6H5a6 6 0 0 0 5.385-8.65a19.968 19.968 0 0 1 8.267-4.627A6 6 0 0 0 24 8a6 6 0 0 0 5.348-3.277a19.968 19.968 0 0 1 8.267 4.627A6 6 0 0 0 43.084 18A19.99 19.99 0 0 1 44 24c0 1.38-.14 2.728-.406 4.03a6 6 0 0 0-5.182 9.838a19.995 19.995 0 0 1-8.696 5.303a6.003 6.003 0 0 0-11.432 0Z"/>
                        <path d="M24 31a7 7 0 1 0 0-14a7 7 0 0 0 0 14Z"/>
                    </g>
                </svg>
                <span>تنزيل ملف اكسيل</span>
            </a>
        </li>
        @endcan


        <li>
            <a class="stack" style="cursor: pointer" onclick="document.getElementById('logout').submit()">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
                    <path fill="currentColor"
                          d="M5 3h6a3 3 0 0 1 3 3v4h-1V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-4h1v4a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3m3 9h11.25L16 8.75l.66-.75l4.5 4.5l-4.5 4.5l-.66-.75L19.25 13H8z"/>
                </svg>
                <span>{{ __('dashboard.logout') }}</span>
            </a>

            <form action="{{ route('logout') }}" method="post" id="logout">
                @csrf
            </form>
        </li>
        
    </ul>
</div>
