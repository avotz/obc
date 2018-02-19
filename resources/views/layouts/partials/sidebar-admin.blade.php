<!-- Sidebar -->
<nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                         @include('layouts.partials.sidebar-header')
                        <!-- END Side Header -->

                        <!-- Side Content -->
                        <div class="side-content">
                            <ul class="nav-main">
                                <li>
                                    <a class="active" href="/" title="Inicio"><i class="si si-speedometer"></i><span class="sidebar-mini-hide">Home</span></a>
                                </li>
                                @if(auth()->user()->hasPermission('create_users'))
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/{{ $role->name }}/users" title="Lista de usuarios"><i class="si si-users"></i><span class="sidebar-mini-hide">User List</span></a>
                                   
                                </li>
                                @endif
                                @if($role->name == 'superadmin' && auth()->user()->hasPermission('create_countries'))
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/{{ $role->name }}/countries" title="Lista de Paises"><i class="si si-globe"></i><span class="sidebar-mini-hide">Country List</span></a>
                                   
                                </li>
                                @endif
                                 @if($role->name == 'superadmin')
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/superadmin/sectors" title="Sectores y subsectores"><i class="si si-paper-clip"></i><span class="sidebar-mini-hide">Sectors & subsectors</span></a>
                                   
                                </li>
                                @endif
                                 @if(auth()->user()->hasPermission('view_all_trans_company'))
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/{{ $role->name }}/transactions" title="Transacciones"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">Transactions</span></a>
                                   
                                </li>
                                @endif
                                @if(($role->name == 'admin' || $role->name == 'superadmin') && auth()->user()->hasPermission('view_commissions') )
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#" title="Comisiones OBC"><i class="si si-calculator"></i><span class="sidebar-mini-hide">OBC Commissions</span></a>
                                    <ul>
                                        <li>
                                            <a href="/commissions/paid" title="Comisiones pagadas">Commissions Paid</a>
                                        </li>
                                        <li>
                                            <a href="/commissions/intransit" title="Comisiones en transito">Commissions in transit</a>
                                        </li>
                                        <li>
                                            <a href="/commissions/pending" title="Comisiones pendientes de pago">Pending commissions</a>
                                        </li>
                                       
                                        
                                    </ul>
                                </li>
                                 @endif
                                 @if($role->name == 'superadmin' && auth()->user()->hasPermission('global_settings'))
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/profile" title="% descuento OBC"><i class="si si-paper-clip"></i><span class="sidebar-mini-hide">% Discount OBC</span></a>
                                   
                                </li>
                                @endif
                               
                                
                            </ul>
                        </div>
                        <!-- END Side Content -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->