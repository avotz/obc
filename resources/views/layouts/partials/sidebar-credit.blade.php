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
                                
                               
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/credit/credit-requests" title="Solicitudes de crédito"><i class="si si-users"></i><span class="sidebar-mini-hide">Credit Requests</span></a>
                                   
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/profile" title="% Interes por días creditos"><i class="si si-graph"></i><span class="sidebar-mini-hide">% Interest for credits</span></a>
                                   
                                </li>
                                
                            
                                
                                
                            </ul>
                        </div>
                        <!-- END Side Content -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->