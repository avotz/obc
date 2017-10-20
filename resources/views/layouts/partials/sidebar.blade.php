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
                                    <a class="active" href="/"><i class="si si-speedometer"></i><span class="sidebar-mini-hide">Home</span></a>
                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Menu</span></li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i><span class="sidebar-mini-hide">Publications</span></a>
                                    <ul>
                                        <li>
                                            <a href="/public/requests">Public Area</a>
                                        </li>
                                        <li>
                                            <a href="/private/requests">Private Zone</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">Create Transaction</span></a>
                                    <ul>
                                        <li>
                                            <a href="/requests/create">Quotation Request</a>
                                        </li>
                                        <li>
                                            <a href="#">Credit Application</a>
                                        </li>
                                        <li>
                                            <a href="#">Shipping Request</a>
                                        </li>
                                        <li>
                                            <a href="#">Purchase Order</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                @if($role->name == 'partner')
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/{{ $role->name }}/users"><i class="si si-users"></i><span class="sidebar-mini-hide">Partner List</span></a>
                                   
                                </li>
                                @endif
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-calculator"></i><span class="sidebar-mini-hide">OBC Commissions</span></a>
                                    <ul>
                                        <li>
                                            <a href="#">Commissions Paid</a>
                                        </li>
                                        <li>
                                            <a href="#">Unpaid commissions</a>
                                        </li>
                                       
                                        
                                    </ul>
                                </li>
                                
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/profile"><i class="si si-wrench"></i><span class="sidebar-mini-hide">Manage Account</span></a>
                                   
                                </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="/support"><i class="si si-call-out"></i><span class="sidebar-mini-hide">IT Support </span></a>
                                   
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