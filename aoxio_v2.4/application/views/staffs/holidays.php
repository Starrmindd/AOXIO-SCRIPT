

<?php include"topbar.php"; ?>

<section class="pt-0 cus-account">
    <div class="container cw-14"> 
        <div class="row mb-100">
            <div class="col-md-3">
                <?php include'side_menu.php'; ?>
            </div>

            <div class="col-md-9">
                
                <div class="card shadow-sm br-10 over-hidden">
                    <div class="card-header bg-white px-5 py-2 mt-3">
                        <h5 class="card-title font-weight-normal"><?php echo trans('holidays') ?></h5>
                    </div>

                    <div class="card-body bg-white p-5">
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_sms') ?>" role="form" class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div id="holiday_picker"></div>
                                    </div>
                                    <div class="col-md-5 mt-3">
                                        <div class="hol-list mt-4 pt-2 pl-4">
                                            <?php 
                                                $staff_holidays=get_by_id($this->session->userdata('id'),'staffs');
                                            ?>
                                            <?php  $holidays_list = json_decode($staff_holidays->holidays, true); ?>
                                            <?php if (!empty($holidays_list)): ?>
                                            <?php foreach ($holidays_list as $list): ?>
                                                <span class="badge badge-secondary fs-13 mb-1"><i class="fas fa-calendar-alt"></i> <?php echo my_date_show($list) ?></span>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</seciton>


<style type="text/css">
    .ui-state-actived a {
        background: red;
        color: white;
    }
</style>
