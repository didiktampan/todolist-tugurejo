<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="<?php echo site_url('Dashboard') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="<?php echo site_url('ComplainCard') ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ToDoList</p>
                </a>
            </li> -->
            <?php if ($this->session->userdata('TIPEUSER') === 'IT') { ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Master<i class="fas fa-angle-left right"></i></p>
                    </a>
                <?php } ?>
                <!-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo site_url('Bagian') ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bagian</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo site_url('User_todolist') ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User</p>
                        </a>
                    </li>
                </ul> -->
                <!-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo site_url('DashboardComplain') ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Complain</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo site_url('ComplainSkp') ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Complain Skp</p>
                        </a>
                    </li>
                </ul> -->
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo site_url('RumahSakit') ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Project</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo site_url('Bangsal') ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Milestone</p>
                        </a>
                    </li>
                </ul>

                </li>
                <!-- 
                <?php if ($this->session->userdata('level') === 'admin') { ?>
                <li class="nav-item">
                    <a href=" <?php echo site_url('User_todolist') ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>User</p>
                    </a>
            <?php } ?> -->

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<script>
    const induk = document.querySelector(".nav-treeview");
    console.log(induk.firstChild.nodeName);
</script>