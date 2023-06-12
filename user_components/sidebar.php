<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= $home . '/user/index.php' ?>" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Registration</span></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="hard-drive" class="feather-icon"></i><span class="hide-menu">My Cars </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="<?= $home ?>/user_car/index.php" class="sidebar-link"><span class="hide-menu"> Register a Car
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="<?= $home ?>/user_car/view.php" class="sidebar-link"><span class="hide-menu"> View Cars
                                </span></a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span class="hide-menu">My e-Wallet </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="<?= $home ?>/user_wallet/index.php" class="sidebar-link"><span class="hide-menu"> Transactions
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="<?= $home ?>/user_wallet/cash_in.php" class="sidebar-link"><span class="hide-menu"> Cash In
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="<?= $home ?>/user_wallet/cash_out.php" class="sidebar-link"><span class="hide-menu"> Cash Out
                                </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Reports </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="<?= $home ?>/admin_reports/cash_in.php" class="sidebar-link"><span class="hide-menu"> Cash In Transactions
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="<?= $home ?>/admin_reports/cash_out.php" class="sidebar-link"><span class="hide-menu"> Cash Out Transactions </span></a>
                        </li>
                        <li class="sidebar-item"><a href="<?= $home ?>/admin_reports/balance.php" class="sidebar-link"><span class="hide-menu"> Balance Tickets </span></a></li>
                        <li class="sidebar-item"><a href="<?= $home ?>/admin_reports/verified_users.php" class="sidebar-link"><span class="hide-menu"> Verified Users </span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->