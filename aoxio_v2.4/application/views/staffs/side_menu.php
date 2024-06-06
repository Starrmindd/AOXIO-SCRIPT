<div class="navbar-expand-lg navbar-expand-lg-collapse-block navbar-light">
    <div id="sidebarNavcustom" class="collapse navbar-collapse navbar-vertical sub">
        <!-- Card -->
        <div class="card mb-5 shadow-sm">
            <div class="card-body pr-0 pl-0">
         
                <div class="d-lg-block text-center mb-5">
                    <div class="avatar-md avatar-circle mb-3 m-auto" style="background-image: url(<?php echo base_url($staff->thumb) ?>);">
                        
                    </div>

                    <h4 class="card-title mb-0"><?php echo html_escape($staff->name) ?></h4>
                    <p class="card-text"><?php echo html_escape($staff->email) ?></p>
                </div>

                <ul class="nav nav-sub nav-sm nav-tabs custo mb-4 pl-0">

                    <li class="nav-item customer">
                        <a class="nav-link <?php if(isset($page_title) && $page_title == 'Appointments'){echo 'active';} ?>" href="<?php echo base_url('staff/appointments') ?>">
                            <i class="far fa-calendar-alt nav-icon"></i> <span> <?php echo trans('appointments') ?> </span>
                        </a>
                    </li>

                    <li class="nav-item customer">
                        <a class="nav-link <?php if(isset($page_title) && $page_title == 'Account'){echo 'active';} ?>" href="<?php echo base_url('staff/account') ?>">
                            <i class="far fa-user nav-icon"></i> <span> <?php echo trans('personal-info') ?> </span>
                        </a>
                    </li>

                    <li class="nav-item customer">
                        <a class="nav-link <?php if(isset($page_title) && $page_title == 'Staff Holidays'){echo 'active';} ?>" href="<?php echo base_url('staff/holidays') ?>">
                            <i class="far fa-calendar-alt nav-icon"></i> <span> <?php echo trans('holidays') ?> </span>
                        </a>
                    </li>

                    <li class="nav-item customer">
                        <a class="nav-link <?php if(isset($page_title) && $page_title == 'Change Password'){echo 'active';} ?>" href="<?php echo base_url('staff/change_password') ?>">
                            <i class="lnib lni-lock-alt nav-icon"></i> <span> <?php echo trans('change-password') ?> </span>
                        </a>
                    </li>

                    <li class="nav-item customer">
                        <a class="nav-link" href="<?php echo base_url('auth/logout') ?>">
                            <i class="lnib lni-exit nav-icon"></i> <span> <?php echo trans('logout') ?> </span>
                        </a>
                    </li>

                </ul>
                <!-- End Nav -->
            </div>
        </div>
        <!-- End Card -->
    </div>
</div>