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
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/public/requests" title="Publicaciones"><i class="si si-layers"></i><span class="sidebar-mini-hide">Publications</span></a>

                                </li>
                                
                               
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/shipping/shipping-requests" title="Solicitudes de envio"><i class="si si-users"></i><span class="sidebar-mini-hide">Shipping Requests</span></a>
                                   
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