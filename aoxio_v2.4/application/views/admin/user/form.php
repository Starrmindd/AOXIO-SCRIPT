<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8">
            <div class="card add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
              <div class="card-header with-border">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <h3 class="card-title pt-2"><?php echo trans('edit') ?></h3>
                <?php else: ?>
                  <h3 class="card-title pt-2"><?php echo trans('new-input') ?></h3>
                <?php endif; ?>

                <div class="card-tools pull-right">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <a href="<?php echo base_url('admin/form') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                  <?php else: ?>
                    <a href="#" class="text-right btn btn-secondary cancel_btn btn-sm"><?php echo trans('custom-inputs') ?></a>
                  <?php endif; ?>
                </div>
              </div>


              <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/form/add')?>" role="form" novalidate>
                <div class="card-body">

                    <div class="form-group">
                        <label><?php echo trans('input-type') ?> <span class="text-danger">*</span></label>
                        <select class="form-control select" name="input_type" required>
                            <option><?php echo trans('select-input-type') ?></option>
                            <option <?php if(isset($form[0]['input_type']) && $form[0]['input_type'] == 'text'){echo 'selected';} ?> value="text"><?php echo trans('text') ?></option>     
                            <option <?php if(isset($form[0]['input_type']) && $form[0]['input_type'] == 'textarea'){echo 'selected';} ?> value="textarea"><?php echo trans('textarea') ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo trans('services') ?> <span class="text-danger">*</span></label>
                        <select class="form-control select" name="service_id" required>
                            <option <?php if(isset($form[0]['service_id']) && $form[0]['service_id'] == 0){echo 'selected';} ?> value="0"><?php echo trans('all-services') ?></option>
                            <?php foreach ($services as $service): ?>
                                <option <?php if(isset($form[0]['service_id']) && $form[0]['service_id'] == $service->id){echo 'selected';} ?> value="<?php echo html_escape($service->id) ?>"><?php echo html_escape($service->name) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label><?php echo trans('input-title') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="input_title" value="<?php if(isset($form[0]['input_title'])){echo html_escape($form[0]['input_title']);} ?>">
                    </div>

                
                    
                    <div class="form-group">
                        <label><?php echo trans('input-name') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="input_name" value="<?php if(isset($form[0]['input_name'])){echo html_escape($form[0]['input_name']);} ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input type="checkbox" id="checkboxPrimary2" name="is_required" value="1" <?php if(isset($form[0]['is_required']) && $form[0]['is_required'] == 1){echo "checked";} ?>>
                            <label for="checkboxPrimary2"> <span class="small"><?php echo trans('is-required') ?></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group clearfix">
                      <label><?php echo trans('status') ?></label><br>
                      <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                        <input type="radio" id="radioPrimary1" value="1" name="status" <?php if(isset($form[0]['status']) && $form[0]['status'] == 1){echo "checked";} ?>>
                        <label for="radioPrimary1"> <?php echo trans('show') ?>
                        </label>
                      </div>

                      <div class="icheck-primary radio radio-inline d-inline">
                        <input type="radio" id="radioPrimary2" value="2" name="status" <?php if(isset($form[0]['status']) && $form[0]['status'] == 2){echo "checked";} ?>>
                        <label for="radioPrimary2"> <?php echo trans('hide') ?>
                        </label>
                      </div>
                    </div>

                </div>

                <div class="card-footer">
                    <input type="hidden" name="id" value="<?php if(isset($form[0]['id'])){echo html_escape($form[0]['id']);} ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <?php if (isset($page_title) && $page_title == "Edit"): ?>
                      <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save-changes') ?></button>
                    <?php else: ?>
                      <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save') ?></button>
                    <?php endif; ?>
                </div>

              </form>

            </div>
          </div>

          <div class="col-lg-10">
            <?php if (isset($page_title) && $page_title != "Edit"): ?>
              <div class="card list_area">
                <div class="card-header with-border">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/forms') ?>" class="pull-right btn btn-sm btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                  <?php else: ?>
                    <h3 class="card-title pt-2"><?php echo trans('custom-inputs') ?> </h3>
                  <?php endif; ?>

                  <div class="card-tools pull-right">
                   <a href="#" class="pull-right btn btn-sm btn-secondary add_btn"><i class="fa fa-plus"></i> <?php echo trans('add-new-input') ?></a>
                  </div>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('input-type') ?></th>
                                <th><?php echo trans('input-title') ?></th>
                                <th><?php echo trans('input-name') ?></th>
                                <th><?php echo trans('required') ?></th>
                                <th><?php echo trans('status') ?></th>
                                <th><?php echo trans('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; foreach ($forms as $row): ?>
                            <tr id="row_<?php echo html_escape($row->id); ?>">
                                
                                <td><?= $i; ?></td>
                                <td>
                                  <p class="mb-0 badge badge-secondary"><?php echo html_escape($row->input_type); ?></p>
                                </td>
                                <td>
                                  <p class="mb-0"><?php echo html_escape($row->input_title); ?></p>
                                </td>
                                <td>
                                  <p class="mb-0"><?php echo html_escape($row->input_name); ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-1">
                                      <?php if ($row->is_required == 1): ?>
                                        <span class="badge-custom badge-danger-soft"><?php echo trans('yes') ?></span>
                                      <?php else: ?>
                                        <span class="badge-custom badge-secondary-soft"><?php echo trans('no') ?></span>
                                      <?php endif ?>
                                      
                                    </p>
                                </td>
                                <td>
                                    <?php if ($row->status == 1): ?>
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> <?php echo trans('active') ?></span>
                                    <?php else: ?>
                                    <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> <?php echo trans('hidden') ?></span>
                                    <?php endif ?>
                                </td> 
                                <td class="actions">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" role="menu" >
                                        <a href="<?php echo base_url('admin/form/edit/'.html_escape($row->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                        <a data-val="Category" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/form/delete/'.html_escape($row->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
                                      </div>
                                  </div>

                                </td>
                            </tr>
                            
                          <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                  
                </div>

              </div>
            <?php endif; ?>
          </div>
      </div>
    </div>
  </div>
</div>
