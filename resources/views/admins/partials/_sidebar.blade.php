<aside id="sidebar" class="sidebar p-4">
    <ul class="sidebar-nav" id="sidebarNav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('index') }}/">
                <i class="bi bi-house-door"></i>
                <span>{{ __('Home') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('dashboard') ? ' active' : ' collapsed text-dark' }}"
                href="{{ route('dashboard') }}"
            >
                <i class="bi bi-grid"></i>
                <span>{{ __('Overview') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <hr />
        </li>
        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('dashboard.members.*') ? ' active' : ' collapsed text-dark' }}"
                href="{{ route('dashboard.members.index') }}"
            >
                <i class="bi bi-people"></i>
                <span>{{ __('Anggota') }}</span>
            </a>
        </li>
    
        <li class="nav-item">
            <a
                class="nav-link collapsible text-dark {{ request()->routeIs('dashboad.makesta') || request()->routeIs('dashboard.lakmud') || request()->routeIs('lakut') || request()->routeIs('latinpel') ? '' : 'collapsed' }} bg-transparent"
                data-toggle="nav-collapse"
                data-target="#collapseCadre"
                href="#"
            >
                <i class="bi bi-menu-button-wide"></i>
                <span>{{ __('Kaderisasi') }}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="collapseCadre"
                class="nav-content {{ request()->routeIs('dashboard.makesta') || request()->routeIs('dashboard.lakmud') || request()->routeIs('dashboard.lakut') || request()->routeIs('dashboard.latinpel') ? 'show' : '' }}"
            >
                <li>
                    <a
                        href="{{ route('dashboard.makesta') }}"
                        class="text-dark text-decoration-none {{ request()->routeIs('dashboard.makesta') ? 'active' : '' }}"
                    >
                        <span>{{ __('Makesta') }}</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('dashboard.lakmud') }}"
                        class="text-dark text-decoration-none {{ request()->routeIs('dashboard.lakmud') ? 'active' : '' }}"
                    >
                        <span>{{ __('Lakmud') }}</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('dashboard.lakut') }}"
                        class="text-dark text-decoration-none {{ request()->routeIs('dashboard.lakut') ? 'active' : '' }}"
                    >
                        <span>{{ __('Lakut') }}</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('dashboard.latinpel') }}"
                        class="text-dark text-decoration-none {{ request()->routeIs('dashboard.latinpel') ? 'active' : '' }}"
                    >
                        <span>{{ __('Latinpel') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        @auth
            @if (in_array(auth()->user()->role_id, [1, 2]))
                <li class="nav-item">
                    <a
                        class="nav-link{{ request()->routeIs('pac.*') ? ' active' : ' collapsed text-dark' }}"
                        href="{{ route('pac.index') }}"
                    >
                        <i class="bi bi-exclude"></i>
                        <span>{{ __('PAC/PKPT') }}</span>
                    </a>
                </li>
            @endif
        @endauth

        <li class="nav-item">
            <a
                class="nav-link collapsible text-dark {{ request()->routeIs('news.index') || request()->routeIs('categories.index') || request()->routeIs('tags.index') ? '' : 'collapsed' }} bg-transparent"
                data-toggle="nav-collapse"
                data-target="#collapseNews"
                href="#"
            >
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>{{ __('Berita') }}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
                id="collapseNews"
                class="nav-content {{ request()->routeIs('news.index') || request()->routeIs('categories.index') || request()->routeIs('tags.index') ? 'show' : '' }}"
            >
                <li>
                    <a
                        href="{{ route('news.index') }} "
                        class="text-dark text-decoration-none {{ request()->routeIs('news.index') ? 'active' : '' }}"
                    >
                        <span>{{ __('List Berita') }}</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('categories.index') }}"
                        class="text-dark text-decoration-none {{ request()->routeIs('categories.index') ? 'active' : '' }}"
                    >
                        <span>{{ __('Kategori Berita') }}</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('tags.index') }}"
                        class="text-dark text-decoration-none {{ request()->routeIs('tags.index') ? 'active' : '' }}"
                    >
                        <span>{{ __('Tags') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        @auth
            @if (in_array(auth()->user()->role_id, [2, 3]))
                <li class="nav-item">
                    <a class="nav-link collapsible text-dark {{ request()->routeIs('dashboard.letters.incoming.*') || request()->routeIs('dashboard.letters.outgoing.*') || request()->routeIs('dashboard.letters.validation-submission.*') ? '' : 'collapsed' }} bg-transparent"
                        data-toggle="nav-collapse"
                        data-target="#collapseLetter"
                        href="#">
                        <i class="bi bi-envelope"></i>
                        <span>{{ __('Surat-menyurat') }}</span>
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="collapseLetter" class="nav-content {{ request()->routeIs('dashboard.letters.*') ? 'show' : '' }}">
                        <li>
                            <a href="{{ route('dashboard.letters.incoming.index') }}" 
                                class="text-dark text-decoration-none {{ request()->routeIs('dashboard.letters.incoming.*') ? 'active' : '' }}">
                                <span>{{ __('Surat Masuk') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard.letters.outgoing.index') }}" 
                                class="text-dark text-decoration-none {{ request()->routeIs('dashboard.letters.outgoing.*') ? 'active' : '' }}">
                                <span>{{ __('Surat Keluar') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link collapsible text-dark bg-transparent 
                                {{ request()->routeIs('dashboard.letters.validation-submission.*') ? '' : 'collapsed' }}" 
                                data-toggle="collapse"
                                data-target="#collapseSP"
                                href="javascript:void(0)">
                                <span>{{ __('Pengajuan SP') }}</span>
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>
                            <ul id="collapseSP" class="nav-content collapse {{ request()->routeIs('dashboard.letters.validation-submission.*') ? 'show' : '' }}">
                                <li>
                                    <a href="{{ route('dashboard.letters.validation-submission.index', ['type' => 'ipnu']) }}"
                                        class="text-dark text-decoration-none {{ request()->routeIs('dashboard.letters.validation-submission.*') ? 'active' : '' }}">
                                        <i class="bi bi-person"></i> 
                                        <span>{{ __('IPNU') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard.letters.validation-submission.index', ['type' => 'ippnu']) }}" 
                                        class="text-dark text-decoration-none {{ request()->routeIs('dashboard.letters.validation-submission.*') ? 'active' : '' }}">
                                        <i class="bi bi-person-fill"></i> 
                                        <span>{{ __('IPPNU') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            @endif
        @endauth

        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('admin.calendar.*') ? ' active' : ' collapsed text-dark' }}"
                href="{{ route('admin.calendar.index') }}"
            >
                <i class="bi bi-calendar-date"></i>
                <span>{{ __('Agenda') }}</span>
            </a>
        </li>

        <li class="nav-item">
            <a
                class="nav-link {{ request()->routeIs('hbn.*') ? ' active' : ' collapsed' }}"
                href="{{ route('hbn.index') }}"
            >
                <i class="bi bi-bookmark-check"></i>
                <span>{{ __('Hari Besar') }}</span>
            </a>
        </li>

        @auth
            @if (in_array(auth()->user()->role_id, [1]))
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('dashboard.admins.index') ? ' active' : ' collapsed text-dark' }}"
                        href="{{ route('dashboard.admins.index') }}"
                    >
                        <i class="bi bi-people"></i>
                        <span>{{ __('Admin') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('pages.*') ? ' active' : ' collapsed text-dark' }}"
                        href="{{ route('pages.index') }}"
                    >
                        <i class="bi bi-menu-button-wide"></i>
                        <span>{{ __('Pages') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('quotes.*') ? ' active' : ' collapsed text-dark' }}"
                        href="{{ route('quotes.index') }}"
                    >
                        <i class="bi bi-chat-left-text"></i>
                        <span>{{ __('Quotes') }}</span>
                    </a>
                </li>
            @endif
            @if (in_array(auth()->user()->role_id, [1, 2]))
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->routeIs('administrators.*') ? ' active' : ' collapsed text-dark' }}"
                        href="{{ route('administrators.index') }}"
                    >
                        <i class="bi bi-person-lines-fill"></i>
                        <span>{{ __('Pengurus') }}</span>
                    </a>
                </li>
            @endif
        @endauth

        {{-- <li class="nav-item"> --}}
        {{-- <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"> --}}
        {{-- <i class="bi bi-box-arrow-right btn btn-success m-4"><span>{{ __('Keluar') }}</span></i> --}}
        {{-- </a> --}}
        {{-- </li> --}}
    </ul>
</aside>