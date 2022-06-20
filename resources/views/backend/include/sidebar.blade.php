<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard.index') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @if (session('role') == 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-email"></i>
                            <span class="hide-menu">Surat</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('surat_masuk.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-file"></i>
                                    <span class="hide-menu">Surat Masuk</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('surat_keluar.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-file"></i>
                                    <span class="hide-menu">Surat Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-file-document"></i>
                            <span class="hide-menu">Dokumentasi</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('dokumentasi.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-toggle-switch"></i>
                                    <span class="hide-menu"> Dokumentasi</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-account"></i>
                            <span class="hide-menu">Siswa</span>

                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('siswa.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-toggle-switch"></i>
                                    <span class="hide-menu">Ijazah Siswa</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-account"></i>
                            <span class="hide-menu">Karyawan</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('karyawan.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-toggle-switch"></i>
                                    <span class="hide-menu">Karyawan</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('sertifikat.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-toggle-switch"></i>
                                    <span class="hide-menu">Sertifikat</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-account"></i>
                            <span class="hide-menu">Laporan</span>

                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('laporan.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-toggle-switch"></i>
                                    <span class="hide-menu">Laporan Surat</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                @if (session('role') == 'kepsek')
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false">
                            <i class="mdi mdi-email"></i>
                            <span class="hide-menu">Surat</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('surat_masuk.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-file"></i>
                                    <span class="hide-menu">Surat Masuk</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('surat_keluar.index') }}" class="sidebar-link">
                                    <i class="mdi mdi-file"></i>
                                    <span class="hide-menu">Surat Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
