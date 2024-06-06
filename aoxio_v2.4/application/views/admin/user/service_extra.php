<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">

            <div class="card add_area <?php if(isset($page_title) && $page_title == "Edit Service Extra"){echo "d-block";}else{echo "hide";} ?>">
              <div class="card-header with-border">
                <?php if (isset($page_title) && $page_title == "Edit Service Extra"): ?>
                  <h3 class="card-title"><?php echo trans('edit') ?></h3>
                <?php else: ?>
                  <h3 class="card-title"><?php echo trans('create-new') ?> </h3>
                <?php endif; ?>

                <div class="card-tools pull-right">
                  <?php if (isset($page_title) && $page_title == "Edit Service Extra"): ?>
                    <a href="<?php echo base_url('admin/services/service_extra') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                  <?php else: ?>
                    <a href="#" class="text-right btn btn-secondary cancel_btn btn-sm"><?php echo trans('service-extra') ?></a>
                  <?php endif; ?>
                </div>
              </div>


              <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/services/add_service_extra')?>" role="form" novalidate>
                <div class="card-body">

                    <div class="col-md-12 pr-0 mt-2">
                        <div class="form-group">
                            <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" placeholder="" class="form-control form-control" name="name" value="<?php if(isset($service_extra[0]['name'])){echo html_escape($service_extra[0]['name']);} ?>" autocomplete="off" required="required">
                        </div>
                    </div>

                    <div class="row pl-2">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label><?php echo trans('price') ?> <span class="text-danger">*</span></label>
                              <div class="input-group">
                                <input type="text" class="form-control" name="price" value="<?php if(isset($service_extra[0]['price'])){echo html_escape($service_extra[0]['price']);} ?>" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"><?php echo html_escape($this->business->currency_symbol) ?></span>
                                </div>
                              </div>
                          </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo trans('duration') ?> <span class="text-danger">*</span></label>
                          <div class="input-group">
                              <div>
                                <select class="form-control cus-ra-left duration_type" name="duration_type">
                                    <option value="minute" <?php if(isset($service_extra[0]['duration_type']) && $service_extra[0]['duration_type'] == 'minute'){echo "selected";} ?> <?php if (isset($page_title) && $page_title != "Edit"){echo "selected";} ?>><?php echo trans('minute') ?></option>
                                    <option value="hour" <?php if(isset($service[0]['duration_type']) && $service[0]['duration_type'] == 'hour'){echo "selected";} ?>>Hour</option>
                                </select>
                              </div>
                              <input type="number" class="form-control cus-ra-right duration_input" name="duration" value="<?php if(isset($service_extra[0]['duration'])){echo html_escape($service_extra[0]['duration']);} ?>" required >
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group clearfix">
                            <label><?php echo trans('status') ?></label><br>
                            <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                              <input type="radio" id="radioPrimary3" value="1" name="status" <?php if(isset($service_extra[0]['status']) && $service_extra[0]['status'] == 1){echo "checked";} ?> <?php if (isset($page_title) && $page_title != "Edit"){echo "checked";} ?>>
                              <label for="radioPrimary3"> <?php echo trans('show') ?>
                              </label>
                            </div>

                            <div class="icheck-primary radio radio-inline d-inline">
                              <input type="radio" id="radioPrimary4" value="2" name="status" <?php if(isset($service_extra[0]['status']) && $service_extra[0]['status'] == 2){echo "checked";} ?>>
                              <label for="radioPrimary4"> <?php echo trans('hide') ?>
                              </label>
                            </div>
                          </div>
                      </div>
                  </div>

                <div class="card-footer">
                    <input type="hidden" name="id" value="<?php if(isset($service_extra[0]['id'])){echo html_escape($service_extra[0]['id']);} ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <?php if (isset($page_title) && $page_title == "Edit"): ?>
                      <button type="submit" class="btn btn-primary pull-left"><?php echo trans('save-changes') ?></button>
                    <?php else: ?>
                      <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save') ?></button>
                    <?php endif; ?>
                </div>

              </form>

            </div>


            <?php if (isset($page_title) && $page_title != "Edit Service Extra"): ?>
              <div class="card list_area">
                <div class="card-header with-border">
                  <?php if (isset($page_title) && $page_title == "Edit Service Extra"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/services/service_extra') ?>" class="pull-right btn btn-sm btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                  <?php else: ?>
                    <h3 class="card-title pt-2"><?php echo trans('service-extra') ?></h3>
                  <?php endif; ?>

                  <div class="card-tools pull-right">

                   <a href="#" class="pull-right btn btn-sm btn-secondary add_btn"><i class="fa fa-plus"></i> <?php echo trans('create-new') ?> </a>
                  </div>
                </div>

                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap <?php if(count($service_extras) > 15){echo "datatable";} ?>">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('name') ?></th>
                                <th><?php echo trans('duration') ?></th>
                                <th><?php echo trans('price') ?></th>
                                <th><?php echo trans('status') ?></th>
                                <th><?php echo trans('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; foreach ($service_extras as $row): ?>
                            <tr id="row_<?php echo html_escape($row->id); ?>">
                                <td><?= $i; ?></td>
                                <td><p class="mb-0"><?php echo character_limiter($row->name, 40); ?></p></td> 


                                <td>
                                  <p class="p-0 m-0">
                                    <span class="smalls"><i class="far fa-clock"></i> <?php if($row->duration == -1){echo "Unlimited";}else{echo html_escape($row->duration).' '.trans($row->duration_type);} ?></span>
                                  </p>
                                </td>

                                <td>
                                  <p class="p-0 m-0">
                                    <?php if ($row->price == 0): ?>
                                        <?php echo trans('free') ?>
                                    <?php else: ?>
                                      <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                                      <?php echo number_format($row->price, $this->business->num_format) ?>
                                      <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?>
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
                                        <a href="<?php echo base_url('admin/services/edit_service_extra/'.html_escape($row->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                        <a data-val="Category" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/services/delete_service_extra/'.html_escape($row->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
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
