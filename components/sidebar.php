<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= $home . '/admin/index.php' ?>" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Approvals</span></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="hard-drive" class="feather-icon"></i><span class="hide-menu">Cars </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="<?= $home ?>/admin_car_config/index.php" class="sidebar-link"><span class="hide-menu"> Pending Cars
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span class="hide-menu"> Confirmed Cars
                                </span></a>
                        </li>
                </li>
            </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="credit-card" class="feather-icon"></i><span class="hide-menu">Identification </span></a>
                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                    <li class="sidebar-item"><a href="<?= $home ?>/admin_id_config/index.php" class="sidebar-link"><span class="hide-menu"> Pending ID
                            </span></a>
                    </li>
                    <li class="sidebar-item"><a href="<?= $home ?>/admin_id_config/index.php" class="sidebar-link"><span class="hide-menu"> Approved ID
                            </span></a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="dollar-sign" class="feather-icon"></i><span class="hide-menu">Wallet </span></a>
                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                    <li class="sidebar-item"><a href="<?= $home ?>/admin_wallet_config/index.php" class="sidebar-link"><span class="hide-menu"> Pending Transactions
                            </span></a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Reports </span></a>
                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                    <li class="sidebar-item"><a href="<?= $home ?>/admin_reports/cashin_v2.php" class="sidebar-link"><span class="hide-menu"> Cash In Transactions
                            </span></a>
                    </li>
                    <li class="sidebar-item"><a href="<?= $home ?>/admin_reports/cashout_v2.php" class="sidebar-link"><span class="hide-menu"> Cash Out Transactions </span></a>
                    </li>
                    <li class="sidebar-item"><a href="<?= $home ?>/admin_admin/reports/balance.php" class="sidebar-link"><span class="hide-menu"> Balance Tickets </span></a></li>
                    <li class="sidebar-item"><a href="<?= $home ?>/admin_admin/reports/verified_users.php" class="sidebar-link"><span class="hide-menu"> Verified Users </span></a></li>
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