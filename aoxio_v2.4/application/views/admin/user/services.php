<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <!-- service area -->
        <?php if (isset($page_title) && $page_title != "Edit Category"): ?>
          <div class="col-md-12 <?php if(strlen(settings()->ind_code) != 40){echo "d-none";} ?>">

            <div class="card add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
                <div class="card-header with-border">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?></h3>
                  <?php else: ?>
                    <h3 class="card-title pt-2"><?php echo trans('create-new') ?> </h3>
                  <?php endif; ?>

                  <div class="card-tools pull-right">
                    <?php if (isset($page_title) && $page_title == "Edit"): ?>
                      <a href="<?php echo base_url('admin/services') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                    <?php else: ?>
                      <a href="#" class="text-right btn btn-secondary cancel_btn btn-sm"><?php echo trans('services') ?></a>
                    <?php endif; ?>
                  </div>
                </div>


                <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/services/add')?>" role="form" novalidate>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="card-body">

                        <div class="form-group">
                          <label><?php echo trans('service-name') ?> <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" required name="name" value="<?php if(isset($service[0]['name'])){echo html_escape($service[0]['name']);} ?>" >
                        </div>

                        <div class="form-group">
                            <label><?php echo trans('service-image') ?> </label>
                            <?php if (isset($page_title) && $page_title == "Edit"): ?>
                                <p><img width="150px" src="<?php echo base_url($service[0]['image']) ?>"> <p>
                            <?php endif ?>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="photo" id="customFileUp">
                              <label class="custom-file-label" for="customFileUp"><?php echo trans('upload-image') ?></label>
                            </div>
                        </div>

                       
                        <div class="form-group">
                          <label><?php echo trans('assign-staffs') ?> </label>
                          <div class="select2-blue">
                            <select name="staffs[]" class="select2 w-100" multiple="multiple" data-placeholder="<?php echo trans('select-staffs') ?>" data-dropdown-css-class="select2-blue" style="width: 100%;">
                              <?php $selected = ''; ?>
                              <?php foreach ($staffs as $staff): ?>

                                  <?php if (isset($page_title) && $page_title == 'Edit'): ?>
                                    <?php $assign_staffs = json_decode($service[0]['staffs']);?>
                                    <?php foreach ($assign_staffs as $asn_staff): ?>
                                      <?php if ($asn_staff == $staff->id): ?>
                                        <?php $selected = 'selected'; break; ?>
                                      <?php else: ?>
                                        <?php $selected = ''; ?>
                                      <?php endif ?>
                                    <?php endforeach ?>
                                  <?php endif ?>
                  
                                <option <?php echo html_escape($selected); ?> value="<?php echo html_escape($staff->id) ?>"><?php echo html_escape($staff->name) ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>

                        <div class="row mt-4 mb-2">

                          <div class="col-md-6 <?php if($this->business->enable_category == 0){echo "hide";} ?>">
                              <div class="form-group">
                                <label class="control-label" for="example-input-normal"><?php echo trans('category') ?> <span class="text-danger">*</span></label>
                                <select class="form-control" name="category_id" <?php if ($this->business->enable_category == 1){echo "required";} ?>>
                                    <option value=""><?php echo trans('select') ?></option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo html_escape($category->id); ?>" 
                                          <?php echo (isset($service[0]['category_id']) && $service[0]['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                          <?php echo html_escape($category->name); ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                              </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label><?php echo trans('price') ?> <span class="text-danger">*</span></label>
                              <div class="input-group">
                                <input type="text" class="form-control" name="price" value="<?php if(isset($service[0]['price'])){echo html_escape($service[0]['price']);} ?>" required>
                                <div class="input-group-append">
                                  <span class="input-group-text"><?php echo html_escape($this->business->currency_symbol) ?></span>
                                </div>
                              </div>
                              <p class="text-muted small pt-2"><i class="fas fa-info-circle"></i> <?php echo trans('set-0-for-free') ?></p>
                            </div>
                          </div>

                          <div class="col-md-6 d-hide">
                            <div class="form-group">
                              <label><?php echo trans('capacity') ?> <span class="text-danger">*</span></label>
                              <div class="input-group">
                                <!-- <input type="number" class="form-control" name="capacity" value="<?php //if(isset($service[0]['capacity'])){echo html_escape($service[0]['capacity']);} ?>" required> -->
                                <input type="number" class="form-control" name="capacity" value="-1">
                                <div class="input-group-append">
                                  <span class="input-group-text"><?php echo trans('person') ?></span>
                                </div>
                              </div>
                              <p class="text-muted small pt-2"><i class="fas fa-info-circle"></i> <?php echo trans('set-1-for-unlimited') ?></p>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label><?php echo trans('duration') ?> <span class="text-danger">*</span></label>
                              <div class="input-group">
                                
                                  <div>
                                    <select class="form-control cus-ra-left duration_type" name="duration_type">
                                        <option value="minute" <?php if(isset($service[0]['duration_type']) && $service[0]['duration_type'] == 'minute'){echo "selected";} ?> <?php if (isset($page_title) && $page_title != "Edit"){echo "selected";} ?>><?php echo trans('minute') ?></option>
                                        <option value="hour" <?php if(isset($service[0]['duration_type']) && $service[0]['duration_type'] == 'hour'){echo "selected";} ?>><?php echo trans('hour') ?></option>
                                        
                                        <!-- <option value="day" <?php //if($service[0]['duration_type'] == 'day'){echo "selected";} ?>><?php //echo trans('day') ?></option> -->
                                    </select>
                                  </div>
                                  

                                  <input type="number" class="form-control cus-ra-right duration_input" name="duration" value="<?php if(isset($service[0]['duration'])){echo html_escape($service[0]['duration']);} ?>" required <?php if(isset($service[0]['duration_type']) && $service[0]['duration_type'] == 'day'){echo "disabled";} ?>>
                                  
                              </div>
                            </div>
                          </div>


                          <?php if($this->business->tax_type == 2): ?>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label><?php echo trans('tax') ?> </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tax" value="<?php if(isset($service[0]['tax'])){echo html_escape($service[0]['tax']);} ?>">
                                  <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>

                          <?php if($this->business->tax_type == 1): ?>
                            <input type="hidden" name="tax" value="<?php if(isset($service[0]['tax'])){echo html_escape($service[0]['tax']);} ?>">
                          <?php endif; ?>
                          
                        </div>


                        <!-- virtual meeting -->
                        <?php if (check_feature_access('zoom-meeting') == TRUE): ?>
                        <div class="form-group">
                          <div class="icheck-success d-inline">
                            <input type="checkbox" id="checkboxPrimary2" name="allow_zoom" class="allow_zoom" value="1" <?php if(!empty($service[0]['zoom_link'])){echo 'checked';} ?>>
                            <label for="checkboxPrimary2"> <?php echo trans('allow-zoom-meeting') ?>
                            </label>
                          </div>
                        </div>

                        <div class="form-group link_area d-<?php if(!empty($service[0]['zoom_link'])){echo 'show';}else{echo'hide';} ?>">
                          <label><?php echo trans('zoom-invitation-link') ?></label>
                          <input type="text" placeholder="" class="form-control" name="zoom_link" value="<?php if(isset($service[0]['zoom_link'])){echo html_escape($service[0]['zoom_link']);} ?>" >
                        </div>
                       

                        <div class="form-group">
                          <div class="icheck-success d-inline">
                            <input type="checkbox" id="checkboxPrimary3" name="allow_gmeet" class="allow_gmeet" value="1" <?php if(!empty($service[0]['google_meet'])){echo 'checked';} ?>>
                            <label for="checkboxPrimary3"> <?php echo trans('allow-google-meet') ?>
                            </label>
                          </div>
                        </div>

                        <div class="form-group toggle_area d-<?php if(!empty($service[0]['google_meet'])){echo 'show';}else{echo'hide';} ?>">
                          <label><?php echo trans('google-meet-link') ?></label>
                          <input type="text" placeholder="" class="form-control" name="google_meet" value="<?php if(isset($service[0]['google_meet'])){echo html_escape($service[0]['google_meet']);} ?>" >
                        </div>
                        <?php endif; ?>


                        <div class="form-group">
                          <label><?php echo trans('details') ?></label>
                          <textarea id="summernote" class="form-control" name="details"><?php if(isset($service[0]['details'])){echo html_escape($service[0]['details']);} ?></textarea>
                        </div>

                        <div class="form-group">
                        <label><?php echo trans('service-type') ?> <span class="text-danger">*</span></label>
                        <select class="form-control is_reccuring" name="service_type" required>
                          <option value=""><?php echo trans('select') ?></option>
                          <option value="1" <?php if(isset($service[0]['service_type']) && $service[0]['service_type'] == 1) {echo 'selected';} ?> <?php if(isset($page_title) && $page_title != 'Edit'){echo 'selected';} ?>><?php echo trans('one-of-service') ?></option>
                          <option value="2" <?php if(isset($service[0]['service_type']) && $service[0]['service_type'] == 2) {echo 'selected';} ?>><?php echo trans('recurring-sevice') ?></option>
                        </select>
                      </div>

                      <div class="recurring_service <?php if(isset($page_title) && $page_title != 'Edit'){echo 'hide';} ?> <?php if(isset($service[0]['service_type']) && $service[0]['service_type'] == 1){echo 'hide';} ?>">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label><?php echo trans('number-of-service') ?></label>
                              <select class="form-control" name="number_of_service" >
                                <option value=""><?php echo trans('select') ?></option>
                                <?php for ($i=1; $i <=20; $i++): ?> 
                                  <option value="<?php echo html_escape($i);  ?>" <?php if(isset($service[0]['number_of_service']) && $service[0]['number_of_service'] == $i) {echo 'selected';} ?>><?php echo html_escape($i); ?></option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label><?php echo trans('repeats-in') ?></label>
                              <select class="form-control" name="service_repeat" >
                                <option value=""><?php echo trans('select') ?></option>
                                <option value="7" <?php if(isset($service[0]['service_repeat']) && $service[0]['service_repeat'] == 7) {echo 'selected';} ?>><?php echo trans('repeats-weekly') ?></option>
                                <option value="30" <?php if(isset($service[0]['service_repeat']) && $service[0]['service_repeat'] == 30) {echo 'selected';} ?>><?php echo trans('repeats-monthly') ?></option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      


                      <div class="form-group">
                        <label><?php echo trans('service') ?> <?php echo trans('order') ?></label>
                        <input type="number" placeholder="Ex: 1 2 3" class="form-control" name="orders" value="<?php if(isset($service[0]['orders'])){echo html_escape($service[0]['orders']);} ?>" >
                      </div>
         

                      <div class="form-group clearfix">
                        <label><?php echo trans('status') ?></label><br>
                        <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                          <input type="radio" id="radioPrimary3" value="1" name="status" <?php if(isset($service[0]['status']) && $service[0]['status'] == 1){echo "checked";} ?> <?php if (isset($page_title) && $page_title != "Edit"){echo "checked";} ?>>
                          <label for="radioPrimary3"> <?php echo trans('show') ?>
                          </label>
                        </div>

                        <div class="icheck-primary radio radio-inline d-inline">
                          <input type="radio" id="radioPrimary4" value="2" name="status" <?php if(isset($service[0]['status']) && $service[0]['status'] == 2){echo "checked";} ?>>
                          <label for="radioPrimary4"> <?php echo trans('hide') ?>
                          </label>
                        </div>
                      </div>

                        

                      </div>

                      <div class="mt-3">
                        <?php if (isset($page_title) && $page_title == "Edit"): ?>
                          <button type="submit" class="btn btn-primary pull-left btn-block"> <?php echo trans('save-changes') ?></button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary pull-left btn-block"> <?php echo trans('save') ?></button>
                        <?php endif; ?>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card-body">
                        <div class="icheck-success d-inline mt-4">
                          <div class="custom-control custom-switch pl-5">
                              <input type="checkbox" value="1" name="enable_service_extra" class="enable_service_extra custom-control-input" id="switch-3" <?php if($service[0]['enable_service_extra'] == 1){echo "checked";} ?>>
                              <label class="custom-control-label font-weight-bold" for="switch-3"> 
                                <?php if ($service[0]['enable_service_extra'] == 1): ?>
                                  <?php echo trans('disable-service-extra') ?>
                                <?php else: ?>
                                  <?php echo trans('enable-service-extra') ?>
                                <?php endif ?>
                                  
                              </label>
                          </div>
                        </div>


                        <div class="col-md-12 mt-3">

                          <?php $extras = explode(',', $service[0]['service_extra']) ?>

                          <div class="form-group edit_extra service_extra_area <?php if(isset($service[0]['enable_service_extra']) && $service[0]['enable_service_extra'] == 1){echo 'show';}else{echo 'hide';} ?>">
                              <label><?php echo trans('service-extra') ?></label>
                              <select class="cus_lh select2" name="service_extra[]" style="width: 100%;" multiple>

                                  <?php foreach ($service_extras as $service_extra): ?>
                                      <?php foreach ($extras as $extra): ?>
                                          <?php 
                                              if ($service_extra->id==$extra) {
                                                  $selected='selected'; break;
                                              }else{
                                                  $selected='';
                                              }
                                           ?>
                                      <?php endforeach ?>
                                      <option  <?php echo html_escape($selected); ?> value="<?php echo html_escape($service_extra->id) ?>">

                                        <?php echo html_escape($service_extra->name) ?> - <?php echo html_escape($service_extra->duration).' '.trans($service_extra->duration_type); ?> - <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                                        <?php echo number_format($service_extra->price, $this->business->num_format) ?>
                                        <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?>
                                        
                                      </option>
                                  <?php endforeach ?>
                              </select>
                          </div>
                         
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                    <input type="hidden" name="id" value="<?php if(isset($service[0]['id'])){echo html_escape($service[0]['id']);} ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    
                  </div>

                </form>

            </div>

            <?php if (isset($page_title) && $page_title != "Edit"): ?>
              <div class="card list_area">
                <div class="card-header with-border">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/services') ?>" class="pull-right btn btn-sm btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                    <?php else: ?>
                      <h3 class="card-title pt-2"><?php echo trans('services') ?> </h3>
                    <?php endif; ?>

                    <div class="card-tools pull-right">
                      <a href="#" class="pull-right btn btn-sm btn-secondary add_btn"><i class="fa fa-plus"></i> <?php echo trans('create-new') ?></a>
                    </div>
                </div>

                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-hover text-nowrap <?php if(count($services) > 10){echo "datatable";} ?>">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo trans('name') ?></th>
                          <th><?php echo trans('service-extra') ?></th>
                          <th><?php echo trans('service-type') ?></th>
                          <th><?php echo trans('category') ?></th>
                          <th><?php echo trans('staffs') ?></th>
                          <th><?php echo trans('duration') ?></th>
                          <th><?php echo trans('price') ?></th>
                          <th><?php echo trans('order') ?></th>
                          <th><?php echo trans('status') ?></th>
                          <th><?php echo trans('action') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($services as $service): ?>
                        <tr id="row_<?php echo html_escape($service->id); ?>">

                          <td><?= $i; ?></td>
                          <td>
                            <?php $rating = get_ratings_info($service->id);?>
                            <?php if (isset($rating->total_point) && $rating->total_point != 0): ?>
                            <?php $average = number_format($rating->total_point/$rating->total_user, 1) ?>
                            <?php endif ?>

                            <?php if (!empty($rating->total_point)): ?>
                              <?php for($u = 1; $u <= 5; $u++):?>
                                <?php 
                                  if ( round($average - .25) >= $u) {
                                        $star = "fas fa-star";
                                    } elseif (round($average + .25) >= $u) {
                                        $star = "fas fa-star-half-alt";
                                    } else {
                                        $star = "far fa-star";
                                    }
                                ?>
                                <i class="<?php echo $star;?> text-warning fs-12"></i> 
                              <?php endfor;?>
                              <small>(<?php echo get_total_rating_user($service->id) ?> <?php echo trans('ratings') ?>)</small>
                            <?php endif ?>
                            <p class="mb-1"><?php echo html_escape($service->name); ?></p>
                          </td>
                          <td>
                            <?php if($service->enable_service_extra == 1 && !empty($service->service_extra)): ?>
                              <a class="badge badge-secondary fs-13" data-toggle="modal" href="#extraServiceModal_<?php echo $i ?>"><b><?php echo count(explode(',', $service->service_extra)) ?></b> <?php echo trans('extra-service') ?> <i class="bi bi-arrow-right"></i></a>
                            <?php else: ?>
                              <span class="small text-muted"><i class="bi bi-x-circle"></i> <?php echo trans('not-found') ?></span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($service->service_type==2): ?>
                              <p class="mb-0 text-left"><b><?php echo trans('recurring') ?></b></p>
                              <p class="mb-0 text-left"><?php echo trans('number-of-service') ?> : <?php echo html_escape($service->number_of_service) ?></p>
                              <?php if($service->service_repeat == 7): ?>
                                <p class="mb-0 text-left"><?php echo trans('service-repeats-weekly') ?></p>
                              <?php else: ?>
                                <p class="mb-0 text-left"><?php echo trans('service-repeats-monthly') ?></p>
                              <?php endif; ?>
                            <?php else: ?>
                              <p class="mt-3 text-left"><?php echo trans('one-time-service') ?></p>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if (!empty($service->category_id)): ?>
                              <?php $category = get_by_id($service->category_id, 'service_category')->name; ?>
                              <span class="badge badge-primary"><?php if(isset($category)){echo html_escape($category);} ?></span>
                            <?php else: ?>
                             <span class="text-muted"> <?php echo trans('not-found') ?></span>
                            <?php endif ?>
                          </td>
                          <td>
                              <?php $staffs = json_decode($service->staffs);?>
                              <?php if (!empty($staffs)): ?>
                                <div class="staffs-list">
                                  <?php foreach ($staffs as $staff): ?>
                                    <span data-tooltip="<?php echo get_by_id($staff, 'staffs')->name; ?>"><img class="staff-avatar" src="<?php echo base_url(get_by_id($staff, 'staffs')->thumb) ?>"></span>
                                  <?php endforeach ?>  
                                </div>
                              <?php else: ?>
                                <p class="fs-12 mb-0 badge badge-secondary-soft rounded"><i class="fas fa-user-slash"></i> <?php echo trans('not-assigned') ?></p>
                              <?php endif ?>
                          </td>
                          <td>
                            <!-- <p class="p-0 m-0">
                              <?php //if($service->capacity == -1){echo "Unlimited";}else{echo html_escape($service->capacity).' '.trans('person');} ?>

                              <?php //if ($service->capacity_left > 0): ?>
                                <span class="small">(<?php //echo $service->capacity_left ?> <?php //echo trans('left') ?>)</span>
                              <?php //endif ?>
                            </p> -->
                            <p class="p-0 m-0">
                              <span class="smalls"><?php if($service->duration == -1){echo "Unlimited";}else{echo html_escape($service->duration).' '.trans($service->duration_type);} ?></span>
                            </p>
                          </td>

                          <td>
                            <p class="p-0 m-0">
                              <?php if ($service->price == 0): ?>
                                  <?php echo trans('free') ?>
                              <?php else: ?>
                                <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                                <?php echo number_format($service->price, $this->business->num_format) ?>
                                <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?>
                              <?php endif ?>
                            </p>
                          </td>

                          <td>
                              <span class="badge badge-danger-soft"><i class="fas fa-arrow-up"></i> <?php echo html_escape($service->orders) ?></span>
                          </td> 

                          <td>
                            <?php if ($service->status == 1): ?>
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
                              <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a data-toggle="modal" href="#ratingModal_<?php echo $i ?>" class="dropdown-item"><?php echo trans('reviews') ?></a>

                                <a href="<?php echo base_url('admin/services/edit/'.html_escape($service->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                
                                <a data-val="Category" data-id="<?php echo html_escape($service->id); ?>" href="<?php echo base_url('admin/services/delete/'.html_escape($service->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
                              </div>
                            </div>
                          </td>
                        </tr>

                        <?php $i++; endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            <?php endif; ?>

          </div>
        <?php endif; ?>




      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<?php if (!empty($services)): ?>
  <?php $j=1; foreach ($services as $service): ?>
    <div class="modal fade d-hide" id="ratingModal_<?= $j; ?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
      
        <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('customer/add_rating')?>" role="form" novalidate>
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">
                <?php echo trans('reviews') ?>
            </h4>
              <div class="mclose" data-dismiss="modal"><i class="lnib lni-close"></i></div>
            </div>

            <div class="modal-body">
                
              <div class="row">
                <?php  
                  $ratings = get_all_ratings($service->id);
                  $rating = get_ratings_info($service->id);
                  $report = get_single_ratings($service->id);
                ?>

                <?php if (empty($ratings)): ?>
                  <?php $average = 0 ?>
                <?php else: ?>
                  <?php $average = number_format($rating->total_point/$rating->total_user, 1) ?>
                <?php endif ?>

                <?php if ($average != 0): ?>
                  <div class="col-sm-4">
                    <div class="rating-block">
                      <h6><?php echo trans('average-rating') ?></h6>
                       <?php for($i = 1; $i <= 5; $i++):?>
                        <?php 
                          if ( round($average - .25) >= $i) {
                                $star = "fas fa-star";
                            } elseif (round($average + .25) >= $i) {
                                $star = "fas fa-star-half-alt";
                            } else {
                                $star = "far fa-star";
                            }
                        ?>
                        <i class="<?php echo $star;?> text-warning"></i> 
                      <?php endfor;?>
                      <h5 class="bold"><?php echo $average; ?> <small>(<?php echo get_total_rating_user($service->id) ?> <?php echo trans('ratings') ?>)</small></h5>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <h6><?php echo trans('ratings-summary') ?></h6>
                    
                    <div class="d-flex justify-content-between">
                      <div class="pull-lefts" style="width:10%; line-height:1;">
                        <div style="height:9px; margin:5px 0;"> <span class="fa fa-star text-warning"> </span> 5</div>
                      </div>
                      <div class="pull-lefts" style="width:65%;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->five/$report->total_user*100; ?>%">
                          <span class="sr-only"></span>
                          </div>
                        </div>
                      </div>
                      <div class="pull-rights" style="width:15%;"><?php echo $report->five ?></div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <div class="pull-lefts" style="width:10%; line-height:1;">
                        <div style="height:9px; margin:5px 0;"> <span class="fa fa-star text-warning"></span> 4</div>
                      </div>
                      <div class="pull-lefts" style="width:65%;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->four/$report->total_user*100; ?>%">
                          <span class="sr-only"></span>
                          </div>
                        </div>
                      </div>
                      <div class="pull-rights" style="width:15%"><?php echo $report->four ?></div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <div class="pull-lefts" style="width:10%; line-height:1;">
                        <div style="height:9px; margin:5px 0;"> <span class="fa fa-star text-warning"></span> 3</div>
                      </div>
                      <div class="pull-lefts" style="width:65%;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->three/$report->total_user*100; ?>%">
                          <span class="sr-only"></span>
                          </div>
                        </div>
                      </div>
                      <div class="pull-rights" style="width: 15%"><?php echo $report->three ?></div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <div class="pull-lefts" style="width:10%; line-height:1;">
                        <div style="height:9px; margin:5px 0;"> <span class="fa fa-star text-warning"></span> 2</div>
                      </div>
                      <div class="pull-lefts" style="width:65%;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->two/$report->total_user*100; ?>%">
                          <span class="sr-only"></span>
                          </div>
                        </div>
                      </div>
                      <div class="pull-rights" style="width: 15%"><?php echo $report->two ?></div>
                    </div>

                    <div class="d-flex justify-content-between">
                      <div class="pull-lefts" style="width:10%; line-height:1;">
                        <div style="height:9px; margin:5px 0;"> <span class="fa fa-star text-warning"></span> 1</div>
                      </div>
                      <div class="pull-lefts" style="width:65%;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $report->one/$report->total_user*100; ?>%">
                          <span class="sr-only"></span>
                          </div>
                        </div>
                      </div>
                      <div class="pull-rights" style="width: 15%"><?php echo $report->one ?></div>
                    </div>
                  </div>  

                <?php else: ?>
                  <div class="col-sm-12 text-center">
                    <?php echo trans('no-data-found') ?>
                  </div>  
                <?php endif ?>

              </div>      
              
              <div class="row">
                <div class="col-sm-12">
                  <hr/>
                  <div class="review-block">
                    <?php foreach ($ratings as $rating): ?>
                      <div class="row">
                        <div class="col-sm-2 text-center">
                          <?php if (empty($rating->patient_thumb)): ?>
                            <?php $avatar = 'assets/front/img/avatar.png'; ?>
                          <?php else: ?>
                            <?php $avatar = $rating->customer_thumb; ?>
                          <?php endif ?>
                          <img width="80px" src="<?php echo base_url($avatar) ?>" class="img-thumbnail">
                          <div class="review-block-name mt-1 badge badge-secondary"><?php echo $rating->customer_name ?></div>
                        </div>
                        <div class="col-sm-10 pl-0">
                          <?php for($i = 1; $i <= 5; $i++):?>
                            <?php 
                            if($i > $rating->rating){
                              $star = 'far fa-star';
                            }else{
                              $star = 'fas fa-star';
                            }
                            ?>
                            <i class="<?php echo $star;?> text-warning"></i> 
                          <?php endfor;?>
                          <div class="review-block-description mt-2"><?php echo $rating->feedback ?></div>
                          <div class="review-block-date small mt-1"><i class="far fa-calendar-alt"></i>  <?php echo my_date_show($rating->created_at) ?></div>
                        </div>
                      </div><hr/>
                    <?php endforeach ?>
                  </div>
                </div>
              </div>

           
            </div>

          </div>
        </form>

        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <?php $j++; endforeach; ?>
<?php endif; ?>



<?php if (!empty($services)): ?>
  <?php $m=1; foreach ($services as $service): ?>
    <div class="modal fade d-hide" id="extraServiceModal_<?= $m; ?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
      
        <?php $service_extras = $this->admin_model->get_extra_services($service->id); ?>
          <div class="modal-content">
            <div class="modal-header border-0">
            <h4 class="modal-title">
                <?php echo trans('service-extra') ?> of - <?php echo html_escape($service->name) ?>
            </h4>
              <div class="mclose" data-dismiss="modal"><i class="lnib lni-close"></i></div>
            </div>

            <div class="modal-body mb-4">
              <?php $extras = explode(',', $service->service_extra) ?>
              <?php foreach ($extras as $value): ?>
                <div class="row px-4 py-3 bg-light mx-2 my-3">
                  <div class="col-md-8 col-xs-12">
                    <p class="mb-0"><i class="bi bi-check-circle-fill text-success mr-1"></i> <?php echo get_by_id($value,'service_extra')->name ?></p>
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <p class="mb-0">
                      <span class="mr-2">
                        <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                        <?php echo number_format(get_by_id($value,'service_extra')->price, $this->business->num_format) ?>
                        <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?>
                      </span>

                      <span>
                        <i class="far fa-clock"></i> <?php echo get_by_id($value,'service_extra')->duration.' '.(get_by_id($value,'service_extra')->duration_type); ?>
                      </span>
                    </p>
                  </div>
                </div>
              <?php endforeach ?>
           
            </div>

          </div>

        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <?php $m++; endforeach; ?>
<?php endif; ?>