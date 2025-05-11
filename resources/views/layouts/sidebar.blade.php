<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mobil Tarife</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Abone İşlemleri -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Abone İşlemleri
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('subscribers.index') }}" class="nav-link {{ request()->routeIs('subscribers.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aboneler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subscriptions.index') }}" class="nav-link {{ request()->routeIs('subscriptions.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Abonelikler</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Cihaz Yönetimi -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-mobile-alt"></i>
                        <p>
                            Cihaz Yönetimi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('phones.index') }}" class="nav-link {{ request()->routeIs('phones.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Telefonlar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sim-cards.index') }}" class="nav-link {{ request()->routeIs('sim-cards.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SIM Kartlar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('devices.index') }}" class="nav-link {{ request()->routeIs('devices.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Diğer Cihazlar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- İletişim Servisleri -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            İletişim Servisleri
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sms-logs.index') }}" class="nav-link {{ request()->routeIs('sms-logs.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Logları</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fax-logs.index') }}" class="nav-link {{ request()->routeIs('fax-logs.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Faks Logları</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('call-logs.index') }}" class="nav-link {{ request()->routeIs('call-logs.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Arama Logları</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Stok Yönetimi -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Stok Yönetimi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('assets.index') }}" class="nav-link {{ request()->routeIs('assets.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Varlıklar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stock-movements.index') }}" class="nav-link {{ request()->routeIs('stock-movements.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stok Hareketleri</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Organizasyon -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Organizasyon
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('organizations.index') }}" class="nav-link {{ request()->routeIs('organizations.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kurumlar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('locations.index') }}" class="nav-link {{ request()->routeIs('locations.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lokasyonlar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sectors.index') }}" class="nav-link {{ request()->routeIs('sectors.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sektörler</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Ayarlar -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Ayarlar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('system-settings.index') }}" class="nav-link {{ request()->routeIs('system-settings.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sistem Ayarları</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('api-settings.index') }}" class="nav-link {{ request()->routeIs('api-settings.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>API Ayarları</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('related-settings.index') }}" class="nav-link {{ request()->routeIs('related-settings.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>İlişkili Ayarlar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Raporlar -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Raporlar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.subscribers') }}" class="nav-link {{ request()->routeIs('reports.subscribers') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Abone Raporları</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.stock') }}" class="nav-link {{ request()->routeIs('reports.stock') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stok Raporları</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.financial') }}" class="nav-link {{ request()->routeIs('reports.financial') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Finansal Raporlar</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside> 