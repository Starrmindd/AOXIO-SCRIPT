<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <?php if (isset($page_title) && $page_title != "Edit"): ?>
          <div class="col-md-12 pt-3">

              <div class="card-bodys p-0">
                  <div class="icheck-success d-inline mt-4">

                    <div class="custom-control custom-switch">
                        <input type="checkbox" value="1" name="enable_category" class="enable_category custom-control-input" id="switch-2" <?php if($this->business->enable_category == 1){echo "checked";} ?>>
                        <label class="custom-control-label font-weight-bold" for="switch-2"> 
                          <?php if ($this->business->enable_category == 1): ?>
                          <?php echo trans('disable-category') ?>
                        <?php else: ?>
                          <?php echo trans('enable-category') ?>
                        <?php endif ?></label>
                    </div>

                  </div>
              </div>

              <?php if ($this->business->enable_category == 0): ?>
               
                  <div class="card-body text-center mt-3">
                    <p class="text-muted mb-0 py-4"><i class="fas fa-ban"></i><br> <?php echo trans('category').' '.trans('disabled') ?></p>
                  </div>
        
              <?php endif ?>

              <div class="category_area" style="display: <?php if($this->business->enable_category == 1){echo "block";}else{echo "none";} ?>;">
                <div class="card add_area2 <?php if(isset($page_title) && $page_title == "Edit Category"){echo "d-block";}else{echo "hide";} ?>">
                  
                  <div class="card-header">
                    <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                      <h3 class="card-title pt-2"><?php echo trans('edit') ?></h3>
                    <?php else: ?>
                      <h3 class="card-title pt-2"><?php echo trans('create-new') ?></h3>
                    <?php endif; ?>

                    <div class="card-tools pull-right">
                      <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                        <?php $required = ''; ?>
                        <a href="<?php echo base_url('admin/services') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                      <?php else: ?>
                        <?php $required = 'required'; ?>
                        <a href="#" class="text-right btn btn-secondary btn-sm cancel_btn2"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                      <?php endif; ?>
                    </div>
                  </div>

                  <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/services/add_category')?>" role="form" novalidate>

                    <div class="card-body">
                        <div class="form-group clearfix">
                            <label><?php echo trans('select-iconimage') ?></label><br>

                            <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                              <input class="icon_image" type="radio" id="radioPrimary1" value="1" name="icon_image" <?php if(isset($category[0]['icon']) && $category[0]['is_active'] == 1 ){echo "checked";} ?> >
                              <label for="radioPrimary1"><?php echo trans('icon') ?>
                              </label>
                            </div>

                            <div class="icheck-primary radio radio-inline d-inline">
                              <input class="icon_image" type="radio" id="radioPrimary2" value="2" name="icon_image" <?php if(isset($category[0]['image']) && $category[0]['is_active'] == 2 ){echo "checked";} ?>>
                              <label for="radioPrimary2"><?php echo trans('image') ?>
                              </label>
                            </div>
                        </div>


                        <div class="form-group category_icon  <?php if(isset($category[0]['icon']) && $category[0]['is_active'] == 1){echo "show";}else{ echo "hide";} ?>">
                          <label><?php echo trans('icon') ?></label>
                          <input type="text" class="form-control iconpicker" name="icon" value="<?php if(isset($category[0]['icon'])){echo html_escape($category[0]['icon']);} ?>" >
                        </div>

                        <div class="form-group category_image <?php if(isset($category[0]['image']) && $category[0]['is_active'] == 2 ){echo "show";}else{ echo "hide";} ?>">
                            <label><?php echo trans('category-image') ?></label>
                            <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                                <p><img width="100px" src="<?php echo base_url($category[0]['image']) ?>"> <p>
                            <?php endif ?>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="photo" id="customFileUp">
                              <label class="custom-file-label" for="customFileUp"><?php echo trans('upload-image') ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="<?php if(isset($category[0]['name'])){echo html_escape($category[0]['name']);} ?>" <?php echo html_escape($required); ?>>
                        </div>

                        <div class="form-group">
                            <label><?php echo trans('order') ?></label>
                            <input type="number" placeholder="Ex: 1 2 3" class="form-control" name="orders" value="<?php if(isset($category[0]['orders'])){echo html_escape($category[0]['orders']);} ?>" >
                        </div>

                        <div class="form-group clearfix">
                            <label><?php echo trans('status') ?></label><br>

                            <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                              <input type="radio" id="radioPrimary1" value="1" name="status" <?php if(isset($category[0]['status']) && $category[0]['status'] == 1){echo "checked";} ?> <?php if (isset($page_title) && $page_title != "Edit Category"){echo "checked";} ?>>
                              <label for="radioPrimary1"> <?php echo trans('show') ?>
                              </label>
                            </div>

                            <div class="icheck-primary radio radio-inline d-inline">
                              <input type="radio" id="radioPrimary2" value="2" name="status" <?php if(isset($category[0]['status']) && $category[0]['status'] == 2){echo "checked";} ?>>
                              <label for="radioPrimary2"> <?php echo trans('hide') ?>
                              </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                      <input type="hidden" name="id" value="<?php if(isset($category[0]['id'])){echo html_escape($category[0]['id']);} ?>">
                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                        <button type="submit" class="btn btn-primary pull-left"><?php echo trans('save-changes') ?></button>
                      <?php else: ?>
                        <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save') ?></button>
                      <?php endif; ?>
                    </div>

                  </form>
                  
                </div>


                <?php if (isset($page_title) && $page_title != "Edit Category"): ?>
                  <div class="card list_area2">
                    <div class="card-header">
                      <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                        <h3 class="card-title pt-2">Edit <a href="<?php echo base_url('admin/services/edit_category') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                      <?php else: ?>
                        <h3 class="card-title pt-2"><?php echo trans('categories') ?></h3>
                      <?php endif; ?>

                      <div class="card-tools pull-right">
                        <a href="#" class="pull-right btn btn-secondary btn-sm add_btn2"><i class="fa fa-plus"></i> <?php echo trans('create-new') ?></a>
                      </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap <?php if(count($categories) > 10){echo "datatable";} ?>">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo trans('name') ?></th>
                                    <th><?php echo trans('status') ?></th>
                                    <th class="text-right"><?php echo trans('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1; foreach ($categories as $row): ?>
                                <tr id="row_<?php echo ($row->id); ?>">
                                    
                                    <td><?= $i; ?></td>
                                    <td><?php echo html_escape($row->name); ?></td>
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
                                            <a href="<?php echo base_url('admin/services/edit_category/'.html_escape($row->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                            <a data-val="Category" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/services/delete_category/'.html_escape($row->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
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
        <?php endif; ?>



      </div>
    </div>
  </div>
</div>

