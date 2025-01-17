<?php include"topbar.php"; ?>

<section class="pt-0 cus-account">
    <div class="container cw-14">
        <div class="row mb-100">
            <div class="col-md-3 col-sm-12">
                <?php include'side_menu.php'; ?>
            </div>

            <div class="col-md-9 col-sm-12">
                <?php if (isset($page_title) & $page_title == 'Account'): ?>
                    <div class="card shadow-sm br-10 over-hidden">
                        <div class="card-header bg-white px-5 py-2 mt-3">
                            <h5 class="card-title font-weight-normal"><?php echo trans('personal-info') ?></h5>
                        </div>

                        <div class="card-body bg-white p-5">
                            <form method="post" action="<?php echo base_url('customer/update'); ?>" enctype="multipart/form-data">

                                <div class="row">

                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <div class="avatar-upload text-center">
                                                  <div class="avatar-edit">
                                                      <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                      <label for="imageUpload"></label>
                                                  </div>
                                                  <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url(<?php echo base_url($customer->thumb); ?>);">
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('name') ?></label>
                                            <input type="text" class="form-control" name="name" value="<?php echo html_escape($customer->name) ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('email') ?></label>
                                            <input type="email" class="form-control" name="email" value="<?php echo html_escape($customer->email) ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('phone') ?></label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo html_escape($customer->phone) ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo trans('time-zone') ?><span class="text-danger">*</span></label>
                                            <select class="cus_lh select2 form-control" name="time_zone" style="width: 100%;">
                                                <option value=""><?php echo trans('select') ?></option>
                                                <?php foreach ($time_zones as $time): ?>
                                                    <option <?php if(isset($customer->time_zone) && $customer->time_zone == $time->id){echo 'selected';} ?> value="<?php echo html_escape($time->id); ?>"><?php echo html_escape($time->name); ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 mt-4">
                                        <input type="hidden" name="id" value="<?php echo html_escape($customer->id) ?>">
                                        <!-- csrf token -->
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                        <button type="submit" class="btn btn-primary mr-2"><?php echo trans('save-changes') ?></button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card shadow-sm br-10 over-hidden">
                        <div class="card-header bg-white px-5 py-2 mt-3">
                            <h5 class="card-title font-weight-normal"><?php echo trans('change-password') ?></h5>
                        </div>

                        <div class="card-body bg-white p-5">
                            <form id="cahage_pass_form" method="post" action="<?php echo base_url('customer/change'); ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('old-password') ?></label>
                                            <input type="text" class="form-control" name="old_pass">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('new-password') ?></label>
                                            <input type="text" class="form-control" name="new_pass">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('confirm-new-password') ?></label>
                                            <input type="text" class="form-control" name="confirm_pass">
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <input type="hidden" name="id" value="<?php echo html_escape($customer->id) ?>">
                                        <!-- csrf token -->
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                        <button type="submit" class="btn btn-primary mr-2"><?php echo trans('save-changes') ?></button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</seciton>