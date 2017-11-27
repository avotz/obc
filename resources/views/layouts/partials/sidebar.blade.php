<!-- Sidebar -->
<nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="side-header side-content bg-white-op">
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times"></i>
                            </button>
                            
                            <a class="h5 text-white" href="/">
                                <img src="/img/favicons/favicon-32x32.png" alt="OBC"> <span class="h6 font-w600 sidebar-mini-hide">Online Business Centers</span>
                            </a>
                        </div>
                        <!-- END Side Header -->

                        <!-- Side Content -->
                        <div class="side-content">
                            <ul class="nav-main">
                                <li>
                                    <a class="active" href="/" title="Inicio"><i class="si si-speedometer"></i><span class="sidebar-mini-hide">Home</span></a>
                                </li>
                                <li class="nav-main-heading" title="Menu"><span class="sidebar-mini-hide">Menu</span></li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#" title="Publicaciones"><i class="si si-layers"></i><span class="sidebar-mini-hide">Publications</span></a>
                                    <ul>
                                        <li>
                                            <a href="/public/requests" title="Área publica">Public Area</a>
                                        </li>
                                        <li>
                                            <a href="/private/requests" title="Zona privada">Private Zone</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#" title="Crear Transacción"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">Create Transaction</span></a>
                                    <ul>
                                        <li>
                                            <a href="/requests/create" title="Solicitud de cotización">Quotation Request</a>
                                        </li>
                                        <!-- <li>
                                            <a href="#" title="Solicitud de crédito">Credit Application</a>
                                        </li>
                                        <li>
                                            <a href="#" title="Solicitud de envio">Shipping Request</a>
                                        </li>
                                        <li>
                                            <a href="#" title="Orden de compra">Purchase Order</a>
                                        </li> -->
                                        
                                    </ul>
                                </li>
                                @if($role->name == 'partner')
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/{{ $role->name }}/users" title="Lista de asociados"><i class="si si-users"></i><span class="sidebar-mini-hide">Partner List</span></a>
                                   
                                </li>
                                @endif
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#" title="Comisiones OBC"><i class="si si-calculator"></i><span class="sidebar-mini-hide">OBC Commissions</span></a>
                                    <ul>
                                        <li>
                                            <a href="#" title="Comisiones pagadas">Commissions Paid</a>
                                        </li>
                                        <li>
                                            <a href="#" title="Comisiones no pagadas">Unpaid commissions</a>
                                        </li>
                                       
                                        
                                    </ul>
                                </li>
                                
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/profile" title="Administrar cuenta"><i class="si si-wrench"></i><span class="sidebar-mini-hide">Manage Account</span></a>
                                   
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/support" title="Soporte"><i class="si si-call-out"></i><span class="sidebar-mini-hide">IT Support </span></a>
                                   
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