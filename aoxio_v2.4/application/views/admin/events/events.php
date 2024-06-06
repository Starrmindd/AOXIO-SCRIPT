<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <!-- event area -->
        
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
                      <a href="<?php echo base_url('admin/events') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                    <?php else: ?>
                      <a href="#" class="text-right btn btn-secondary cancel_btn btn-sm"><?php echo trans('events') ?></a>
                    <?php endif; ?>
                  </div>
                </div>

                <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/events/add')?>" role="form" novalidate>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="card-body">

                        <div class="form-group">
                            <label><?php echo trans('event-image') ?> </label>
                            <?php if (isset($page_title) && $page_title == "Edit"): ?>
                                <p><img width="150px" src="<?php echo base_url($event[0]['image']) ?>"> </p>
                            <?php endif ?>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="photo" id="customFileUp">
                              <label class="custom-file-label" for="customFileUp"><?php echo trans('upload-image') ?></label>
                            </div>
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" required name="name" value="<?php if(isset($event[0]['name'])){echo html_escape($event[0]['name']);} ?>" >
                        </div>
                      
                        <div class="form-group">
                          <label class="control-label" for="example-input-normal"><?php echo trans('category') ?> <span class="text-danger">*</span></label>
                          <select class="form-control" name="category" required>
                              <option value=""><?php echo trans('select') ?></option>
                              <?php foreach ($categories as $category): ?>
                                  <option value="<?php echo html_escape($category->id); ?>" 
                                    <?php echo (isset($event[0]['category']) && $event[0]['category'] == $category->id) ? 'selected' : ''; ?>>
                                    <?php echo html_escape($category->name); ?>
                                  </option>
                              <?php endforeach ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label class="control-label" for="example-input-normal"><?php echo trans('venue') ?></label>
                          <select class="form-control" name="venue">
                              <option value=""><?php echo trans('select') ?></option>
                              <?php foreach ($venues as $venue): ?>
                                  <option value="<?php echo html_escape($venue->id); ?>" 
                                    <?php echo (isset($event[0]['venue']) && $event[0]['venue'] == $venue->id) ? 'selected' : ''; ?>>
                                    <?php echo html_escape($venue->name); ?>
                                  </option>
                              <?php endforeach ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('details') ?></label>
                          <textarea id="summernote" class="form-control" name="details"><?php if(isset($event[0]['details'])){echo html_escape($event[0]['details']);} ?></textarea>
                        </div>

                        <div class="form-group">
                            <label><?php echo trans('tags') ?></label>
                            <?php if (isset($page_title) && $page_title == "Edit"): ?>
                              <input type="text" data-role="tagsinput" name="tags" value="<?php echo html_escape($tags) ?>" />
                            <?php else: ?>
                              <input type="text" data-role="tagsinput" name="tags" placeholder="<?php echo trans('enter-your-tags') ?>" />
                            <?php endif ?>
                        </div>

                        <div class="row">

                          <div class="col-md-6">
                            <div class="form-group">
                                <label><?php echo trans('date') ?> <span class="text-danger">*</span></label>
                                <div class="input-group">
                                <input type="text" name="date" class="form-control datepicker" required  autocomplete="off" value="<?php if (isset($event[0]['date'])){echo html_escape($event[0]['date']);} ?>">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-default"><i class="fas fa-calendar-alt"></i></button>
                                </span>
                                </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <label><?php echo trans('time') ?> <span class="text-danger">*</span></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control  timepicker" name="time" value="<?php if(isset($event[0]['time'])){echo html_escape($event[0]['time']);} ?>" required>
                              </div>
                          </div>
                        </div>

                        <div class="mb-2">
                            <?php echo trans('audience-type') ?>
                        </div>
                        <div class="row">
                          <?php $f=1; foreach (get_audience_type() as $value): ?>
                            <div class="col-md-2">
                              <div class="audience_list">

                                      <?php if (isset($page_title) && $page_title == 'Edit'): ?>

                                        <?php  $audiences = explode(',', $event[0]['audience_type']) ?>
                                       
                                        <?php $k=1; foreach ($audiences as $audience): ?>
                                          <?php if ($audience == $f): ?>
                                            <?php $checked = 'checked'; break; ?>
                                          <?php else: ?>
                                            <?php $checked = ''; ?>
                                          <?php endif ?>
                                        <?php $k++; endforeach ?>
                                      <?php endif ?>

                                    <div class="form-check">
                                      <input class="form-check-input fs-16" type="checkbox" value="<?php echo $f ?>" name="audience_type[]" id="flexCheckChecked_<?php echo $f ?>" <?php echo html_escape($checked); ?>>
                                      <label class="form-check-label fs-16" for="flexCheckChecked_<?php echo $f ?>">
                                        <?php echo html_escape($value) ?>
                                      </label>
                                    </div>
                              </div>  
                            </div>
                            
                          <?php $f++; endforeach ?>
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('youtube-vedio-url') ?></label>
                          <input type="text" class="form-control" name="youtube_vedio_url" value="<?php if(isset($event[0]['youtube_vedio_url'])){echo html_escape($event[0]['youtube_vedio_url']);} ?>" >
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('external-link') ?></label>
                          <input type="text" class="form-control" name="external_link" value="<?php if(isset($event[0]['external_link'])){echo html_escape($event[0]['external_link']);} ?>" >
                        </div>

                        <div class="form-group">
                          <label><?php echo trans('contact-number') ?></label>
                          <input type="text" class="form-control" name="contact_number" value="<?php if(isset($event[0]['contact_number'])){echo html_escape($event[0]['contact_number']);} ?>" >
                        </div>

                        <div class="form-group">
                            <label><?php echo trans('artists') ?></label>
                            <?php if (isset($page_title) && $page_title == "Edit"): ?>
                              <input type="text" data-role="tagsinput" name="artists" value="<?php echo html_escape($artists) ?>" />
                            <?php else: ?>
                              <input type="text" data-role="tagsinput" name="artists"/>
                            <?php endif ?>
                        </div>
                        
                        <div class="form-group">
                          <div class="icheck-success d-inline">
                            <input type="checkbox" id="checkboxPrimary2" name="is_organizer" class="is_organizer" value="1" <?php if(!empty($event[0]['is_organizer'])){echo 'checked';} ?>>
                            <label for="checkboxPrimary2"> <?php echo trans('is-other-organizer') ?>
                            </label>
                          </div>
                        </div>

                        <div class="form-group organizer_area d-<?php if(!empty($event[0]['is_organizer'] && $event[0]['is_organizer'] == 1 && $page_title == 'Edit')){echo 'show';}else{echo'hide';} ?>">
                          <div class="form-group">
                            <label><?php echo trans('organizer-name') ?></label>
                            <input type="text" placeholder="" class="form-control" name="organizer_name" value="<?php if(isset($event[0]['organizer_name'])){echo html_escape($event[0]['organizer_name']);} ?>" >
                          </div>

                          <div class="form-group">
                            <label><?php echo trans('organizer-email') ?></label>
                            <input type="text" placeholder="" class="form-control" name="organizer_email" value="<?php if(isset($event[0]['organizer_email'])){echo html_escape($event[0]['organizer_email']);} ?>" >
                          </div>

                          <div class="form-group">
                            <label><?php echo trans('organizer-phone') ?></label>
                            <input type="text" placeholder="" class="form-control" name="organizer_phone" value="<?php if(isset($event[0]['organizer_phone'])){echo html_escape($event[0]['organizer_phone']);} ?>" >
                          </div>

                          <div class="form-group">
                            <label><?php echo trans('organizer-website') ?></label>
                            <input type="text" placeholder="" class="form-control" name="organizer_website" value="<?php if(isset($event[0]['organizer_website'])){echo html_escape($event[0]['organizer_website']);} ?>" >
                          </div>
                        </div>

                        <div class="form-group">
                            <label><?php echo trans('meta-tags') ?></label>
                            <?php if (isset($page_title) && $page_title == "Edit"): ?>
                              <input type="text" data-role="tagsinput" name="meta_tags" value="<?php echo html_escape($meta_tags) ?>" />
                            <?php else: ?>
                              <input type="text" data-role="tagsinput" name="meta_tags" />
                            <?php endif ?>
                        </div>
                        
                        <div class="form-group">
                          <label><?php echo trans('meta-description') ?></label>
                          <textarea class="form-control" rows="2" name="meta_description"><?php if(isset($event[0]['meta_description'])){echo html_escape($event[0]['meta_description']);} ?></textarea>
                        </div>

                        <div class="form-group clearfix">
                          <label><?php echo trans('status') ?></label><br>
                          <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                            <input type="radio" id="radioPrimary3" value="1" name="status" <?php if(isset($event[0]['status']) && $event[0]['status'] == 1){echo "checked";} ?> <?php if (isset($page_title) && $page_title != "Edit"){echo "checked";} ?>>
                            <label for="radioPrimary3"> <?php echo trans('show') ?>
                            </label>
                          </div>

                          <div class="icheck-primary radio radio-inline d-inline">
                            <input type="radio" id="radioPrimary4" value="2" name="status" <?php if(isset($event[0]['status']) && $event[0]['status'] == 2){echo "checked";} ?>>
                            <label for="radioPrimary4"> <?php echo trans('hide') ?>
                            </label>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="card-body">
                        <div class="mb-3"><b><?php echo trans('tickets') ?></b></div>

                         <?php if($page_title == 'Edit'): ?>

                          <?php $tickets = $this->event_model->get_tickets_by_event($event[0]['id']); ?>

                          <?php foreach ($tickets as  $ticket): ?>
                              <div class="main_itemm">
                                <div class="bg-light mb-4 p-4 ticket_area">
                                  <div class="form-group">
                                    <label><?php echo trans('ticket-name') ?> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="ticket_name[]" value="<?php echo html_escape($ticket->name) ?>" >
                                  </div>
                                  
                                  
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label><?php echo trans('price') ?> <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                          <input type="number" class="form-control" name="price[]" value="<?php echo html_escape($ticket->price) ?>" required>
                                          <div class="input-group-append">
                                            <span class="input-group-text"><?php echo html_escape($this->business->currency_symbol) ?></span>
                                          </div>
                                        </div>
                                        <p class="text-muted small pt-2"><i class="fas fa-info-circle"></i> <?php echo trans('set-0-for-free') ?></p>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label><?php echo trans('limit') ?></label>
                                        <input type="number" placeholder="" class="form-control" name="limit[]" value="<?php echo html_escape($ticket->limit) ?>" >
                                      </div>
                                    </div>
                                  </div>
                                  

                                  <div class="form-group d-none">
                                      <label><?php echo trans('sales-start') ?> <span class="text-danger">*</span></label>
                                      <div class="input-group">
                                      <input type="text" name="sales_start[]" class="form-control datepicker" required autocomplete="off" value="<?php echo html_escape($ticket->sales_start) ?>">
                                      <span class="input-group-append">
                                          <button type="button" class="btn btn-default"><i class="fas fa-calendar-alt"></i></button>
                                      </span>
                                      </div>
                                  </div>

                                  <div class="form-group d-none">
                                      <label><?php echo trans('sales-end') ?> <span class="text-danger">*</span></label>
                                      <div class="input-group">
                                      <input type="text" name="sales_end[]" class="form-control datepicker" required  autocomplete="off" value="<?php echo html_escape($ticket->sales_end) ?>">
                                      <span class="input-group-append">
                                          <button type="button" class="btn btn-default"><i class="fas fa-calendar-alt"></i></button>
                                      </span>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label><?php echo trans('ticket-per-attendee') ?></label>
                                    <input type="number" placeholder="" class="form-control" name="tickets_per_attendee[]" value="<?php echo html_escape($ticket->tickets_per_attendee) ?>" >
                                  </div>

                                  <div class="form-group">
                                    <label><?php echo trans('details') ?></label>
                                    <textarea id="summernote" class="form-control" rows="4" name="ticket_details[]"><?php echo html_escape($ticket->details) ?></textarea>
                                  </div>

                                  <?php if($page_title == 'Edit'): ?>
                                    <div class="form-group text-right">
                                      <a data-id="<?php echo html_escape($ticket->id); ?>" href="<?php echo base_url('admin/events/delete_ticket/'.$ticket->id) ?>" class="delete_item btn btn-outline-danger pull-right"><i class="bi bi-x-circle-fill"></i> <?php echo trans('delete') ?></a>
                                    </div>
                                  <?php else: ?>
                                    <div class="col-md-4 text-danger cancel_ticket">
                                      <a href="javascript:void(0);" class="btn btn-danger cancel_ticket"><i class="lnib lni-close"></i> <?php echo trans('cancel') ?></a>
                                    </div>
                                  <?php endif; ?>

                                </div>
                              </div>
                          <?php endforeach ?>

                        <?php endif; ?>
                        <div class="ticket_section"></div>

                        
                        <a href="#" class="add_ticket btn btn-outline-primary"><i class="bi bi-plus-circle-fill"></i> <?php echo trans('add-new-ticket') ?></a>
                    
                        
                      </div>
                    </div>

                    <div class="mt-3 pl-2">
                      <?php if (isset($page_title) && $page_title == "Edit"): ?>
                        <button type="submit" class="btn btn-primary pull-left btn-block"> <?php echo trans('save-changes') ?></button>
                      <?php else: ?>
                          <button type="submit" class="btn btn-primary pull-left btn-block"> <?php echo trans('save') ?></button>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="card-footer">
                    <input type="hidden" name="id" value="<?php if(isset($event[0]['id'])){echo html_escape($event[0]['id']);} ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    
                  </div>

                </form>

            </div>

            <?php if (isset($page_title) && $page_title != "Edit"): ?>
              <div class="card list_area">
                <div class="card-header with-border">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/events') ?>" class="pull-right btn btn-sm btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                    <?php else: ?>
                      <h3 class="card-title pt-2"><?php echo trans('events') ?> </h3>
                    <?php endif; ?>

                    <div class="card-tools pull-right">
                      <a href="#" class="pull-right btn btn-sm btn-secondary add_btn"><i class="fa fa-plus"></i> <?php echo trans('create-new') ?></a>
                    </div>
                </div>

                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-hover text-nowrap <?php if(count($events) > 10){echo "datatable";} ?>">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo trans('name') ?></th>
                          <th><?php echo trans('category') ?></th>
                          <th><?php echo trans('audience-type') ?></th>
                          <th><?php echo trans('tickets') ?></th>
                          <th><?php echo trans('date') ?></th>
                          <th><?php echo trans('status') ?></th>
                          <th><?php echo trans('action') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($events as $event): ?>
                        <tr id="row_<?php echo html_escape($event->id); ?>">

                          <td><?= $i; ?></td>
                          <td>
                            <?php echo html_escape($event->name); ?>
                          </td>
                          <td>
                            <?php if (!empty($event->category)): ?>
                              <?php $category = get_by_id($event->category, 'event_category')->name; ?>
                              <span class="badge badge-primary"><?php if(isset($category)){echo html_escape($category);} ?></span>
                            <?php else: ?>
                             <span class="text-muted"> <?php echo trans('not-found') ?></span>
                            <?php endif ?>
                          </td>
                          <td>
                              <?php $audience_type = explode(',', $event->audience_type);?>
                              <?php if (!empty($audience_type)): ?>
              
                                  <?php foreach ($audience_type as $value): ?>
                                    <span class="badge badge-secondary-soft"> <?php echo get_checked_audience($value) ?></span>
                                  <?php endforeach ?>  
                           
                              <?php else: ?>
                                <p class="fs-12 mb-0 badge badge-secondary-soft rounded"><i class="fas fa-user-slash"></i> <?php echo trans('not-assigned') ?></p>
                              <?php endif ?>
                          </td>

                          <td>
                            <?php $tickets = get_event_tickets($event->id); ?>
                            <?php if (!empty($tickets)): ?>
                                  <?php foreach ($tickets as $ticket): ?>
                                    <span class="badge badge-success"><i class="bi bi-ticket-detailed"></i> <?php echo $ticket->name ?> &bull; <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                                      <?php echo number_format($ticket->price, $this->business->num_format) ?>
                                      <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?>
                                    </span>
                                  <?php endforeach ?>  
                            <?php endif; ?>
                          </td>

                          <td>
                              <p class="mb-0 fs-12"><i class="bi bi-clock"></i> <?php echo my_date_show($event->date); ?> &bull;
                              <?php echo html_escape($event->time); ?></p>
                          </td> 

                          <td>
                            <?php if ($event->status == 1): ?>
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
                                <!-- <a data-toggle="modal" href="#ratingModal_<?php echo $i ?>" class="dropdown-item"><?php echo trans('reviews') ?></a> -->

                                <a href="<?php echo base_url('admin/events/edit/'.html_escape($event->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                
                                <a data-val="Category" data-id="<?php echo html_escape($event->id); ?>" href="<?php echo base_url('admin/events/delete/'.html_escape($event->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
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

      </div>
    </div>
  </div>
</div>


