<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        
          <div class="col-md-8 pt-3">

              <div class="venue_area">
                <div class="card add_area <?php if(isset($page_title) && $page_title == "Edit Venue"){echo "d-block";}else{echo "hide";} ?>">
                  
                  <div class="card-header">
                    <?php if (isset($page_title) && $page_title == "Edit Venue"): ?>
                      <h3 class="card-title pt-2"><?php echo trans('edit') ?></h3>
                    <?php else: ?>
                      <h3 class="card-title pt-2"><?php echo trans('create-new') ?></h3>
                    <?php endif; ?>

                    <div class="card-tools pull-right">
                      <?php if (isset($page_title) && $page_title == "Edit Venue"): ?>
                        <a href="<?php echo base_url('admin/events/venues') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                      <?php else: ?>
                        <a href="#" class="text-right btn btn-secondary btn-sm cancel_btn"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                      <?php endif; ?>
                    </div>
                  </div>

                  <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/events/add_venue')?>" role="form" novalidate>

                    <div class="card-body">

                      <div class="form-group">
                        <label><?php echo trans('venue-image') ?> </label>
                        <?php if (isset($page_title) && $page_title == "Edit"): ?>
                            <p><img width="150px" src="<?php echo base_url($venue[0]['image']) ?>"> <p>
                        <?php endif ?>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="photo" id="customFileUp">
                          <label class="custom-file-label" for="customFileUp"><?php echo trans('upload-image') ?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="<?php if(isset($venue[0]['name'])){echo html_escape($venue[0]['name']);} ?>" required>
                      </div>

                      <div class="form-group">
                        <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" value="<?php if(isset($venue[0]['email'])){echo html_escape($venue[0]['email']);} ?>"required>
                      </div>

                      <div class="form-group">
                        <label><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" value="<?php if(isset($venue[0]['phone'])){echo html_escape($venue[0]['phone']);} ?>" required>
                      </div>

                      <div class="form-group">
                        <label><?php echo trans('vedio-url') ?></label>
                        <input type="text" class="form-control" name="vedio_url" value="<?php if(isset($venue[0]['vedio_url'])){echo html_escape($venue[0]['vedio_url']);} ?>">
                      </div>

                       <div class="form-group">
                        <label><?php echo trans('address') ?></label>
                        <textarea class="form-control" name="address" rows="2"><?php if(isset($venue[0]['address'])){echo html_escape($venue[0]['address']);} ?></textarea>
                      </div>

                      <div class="form-group">
                        <label><?php echo trans('website') ?></label>
                        <input type="text" class="form-control" name="website" value="<?php if(isset($venue[0]['website'])){echo html_escape($venue[0]['website']);} ?>">
                      </div>


                      <div class="form-group">
                        <label><?php echo trans('total-attendee') ?></label>
                        <input type="text" class="form-control" name="total_attendee" value="<?php if(isset($venue[0]['total_attendee'])){echo html_escape($venue[0]['total_attendee']);} ?>">
                      </div>

                     
                      <div class="form-group">
                        <label><?php echo trans('details') ?></label>
                        <textarea id="summernote" class="form-control" name="details"><?php if(isset($venue[0]['details'])){echo html_escape($venue[0]['details']);} ?></textarea>
                      </div>
                      
                      <div class="form-group">
                        <div class="icheck-success d-inline">
                          <input type="checkbox" id="checkboxPrimary2" name="is_seatable" class="is_seatable" value="1" <?php if(!empty($venue[0]['is_seatable'])){echo 'checked';} ?>>
                          <label for="checkboxPrimary2"> <?php echo trans('is-seatable') ?>
                          </label>
                        </div>
                      </div>

                      <div class="form-group seat_area d-<?php if(isset($venue[0]['is_seatable']) && $venue[0]['is_seatable'] == 1){echo 'show';}else{echo 'hide';} ?>">
                        <label><?php echo trans('total-seat') ?></label>
                        <input type="number" class="form-control" name="total_seat" value="<?php if(isset($venue[0]['total_seat'])){echo html_escape($venue[0]['total_seat']);} ?>">
                      </div>


                      <div class="form-group clearfix">
                        <label><?php echo trans('status') ?></label><br>

                        <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                          <input type="radio" id="radioPrimary1" value="1" name="status" <?php if(isset($venue[0]['status']) && $venue[0]['status'] == 1){echo "checked";} ?> <?php if (isset($page_title) && $page_title != "Edit Venue"){echo "checked";} ?>>
                          <label for="radioPrimary1"> <?php echo trans('show') ?>
                          </label>
                        </div>

                        <div class="icheck-primary radio radio-inline d-inline">
                          <input type="radio" id="radioPrimary2" value="2" name="status" <?php if(isset($venue[0]['status']) && $venue[0]['status'] == 2){echo "checked";} ?>>
                          <label for="radioPrimary2"> <?php echo trans('hide') ?>
                          </label>
                        </div>
                      </div>

                    </div>

                    <div class="card-footer">
                      <input type="hidden" name="id" value="<?php if(isset($venue[0]['id'])){echo html_escape($venue[0]['id']);} ?>">
                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <?php if (isset($page_title) && $page_title == "Edit Venue"): ?>
                        <button type="submit" class="btn btn-primary pull-left"><?php echo trans('save-changes') ?></button>
                      <?php else: ?>
                        <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save') ?></button>
                      <?php endif; ?>
                    </div>

                  </form>
                  
                </div>


                <?php if (isset($page_title) && $page_title != "Edit Venue"): ?>
                  <div class="card list_area">
                    <div class="card-header">
                      <?php if (isset($page_title) && $page_title == "Edit Venue"): ?>
                        <h3 class="card-title pt-2"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/events/edit_venue') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                      <?php else: ?>
                        <h3 class="card-title pt-2"><?php echo trans('venues') ?></h3>
                      <?php endif; ?>

                      <div class="card-tools pull-right">
                        <a href="#" class="pull-right btn btn-secondary btn-sm add_btn"><i class="fa fa-plus"></i> <?php echo trans('create-new') ?></a>
                      </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap <?php if(count($venues) > 10){echo "datatable";} ?>">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th><?php echo trans('name') ?></th>
                              <th><?php echo trans('info') ?></th>
                              <th><?php echo trans('seating-info') ?></th>
                              <th><?php echo trans('status') ?></th>
                              <th class="text-right"><?php echo trans('action') ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($venues as $row): ?>
                              <tr id="row_<?php echo ($row->id); ?>">
                                  
                                <td><?= $i; ?></td>
                                <td><?php echo html_escape($row->name); ?></td>
                                <td>
                                  <p class="mb-1 mt-0"><b><?php echo trans('email') ?> : </b><?php echo html_escape($row->email) ?></p>
                                  <p class="mb-1 mt-0"><b><?php echo trans('phone') ?> : </b><?php echo html_escape($row->phone) ?></p>
                                  <a class="mb-1 mt-0" target="_blank" href="<?php echo prep_url($row->website) ?>"><b><?php echo trans('website') ?> : </b><?php echo html_escape($row->website) ?></a>

                                </td>

                                <td>
                                  <?php if($row->is_seatable == 1): ?>
                                    <p><b>Seatable venue</b></p>
                                    <p><b><?php echo trans('total-seat') ?></b> : <?php echo html_escape($row->total_seat) ?></p>
                                  <?php else: ?>
                                    <p><b>Not seatable venue</b></p>
                                  <?php endif; ?>

                                  <p><b><?php echo trans('total-attendee') ?></b> : <?php echo html_escape($row->total_attendee) ?></p>


                                </td>
                                <td>
                                  <?php if ($row->status == 1): ?>
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> <?php echo trans('active') ?></span>
                                  <?php else: ?>
                                    <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> <?php echo trans('hidden') ?></span>
                                  <?php endif ?>
                                </td> 

                                <td class="actions text-right">
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-right" role="menu" >
                                        <a href="<?php echo base_url('admin/events/edit_venue/'.html_escape($row->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                        <a data-val="venue" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/events/delete_venue/'.html_escape($row->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
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
</div>

