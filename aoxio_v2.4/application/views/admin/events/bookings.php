
<div class="content-wrapper">
  <div class="content pt-4 mb-4">
    <div class="container-fluid">
      <div class="row box-dash-areas">
        
        <!-- /.col -->
        <div class="col">
          <div class="info-box p-2 pl-3">
            <span class="info-box-icon info-box-icon-md bg-primary-soft"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?php echo get_count_event_booking_by_status('all') ?></span>
              <span class="info-box-text"><?php echo trans('bookings') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col">
          <div class="info-box p-2 pl-3">
            <span class="info-box-icon info-box-icon-md bg-warning-soft"><i class="far fa-clock"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?php echo get_count_event_booking_by_status('0') ?></span>
              <span class="info-box-text"><?php echo trans('pending') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.col -->
        <div class="col">
          <div class="info-box p-2 pl-3">
            <span class="info-box-icon info-box-icon-md bg-success-soft"><i class="far fa-calendar-check"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?php echo get_count_event_booking_by_status('1') ?></span>
              <span class="info-box-text"><?php echo trans('approved') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <!-- /.col -->
        <div class="col">
          <div class="info-box p-2 pl-3">
            <span class="info-box-icon info-box-icon-md bg-info-soft"><i class="fas fa-check-circle"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?php echo get_count_event_booking_by_status('3') ?></span>
              <span class="info-box-text"><?php echo trans('completed') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col">
          <div class="info-box p-2 pl-3">
            <span class="info-box-icon info-box-icon-md bg-danger-soft"><i class="far fa-calendar-times"></i></span>
            <div class="info-box-content">
              <span class="info-box-number"><?php echo get_count_event_booking_by_status('2') ?></span>
              <span class="info-box-text"><?php echo trans('rejected') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


      </div>
    </div>
  </div>



  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-10">
            <div class="card add_area <?php if(isset($page_title) && $page_title == "Edit Booking"){echo "d-block";}else{echo "hide";} ?>">
              <div class="card-header with-border">
                <?php if (isset($page_title) && $page_title == "Edit Booking"): ?>
                  <h3 class="card-title pt-2"><?php echo trans('edit') ?></h3>
                <?php else: ?>
                  <h3 class="card-title pt-2"><?php echo trans('new-booking') ?> </h3>
                <?php endif; ?>

                <div class="card-tools pull-right">
                  <?php if (isset($page_title) && $page_title == "Edit Booking"): ?>
                    <a href="<?php echo base_url('admin/events/booking') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                  <?php else: ?>
                    <a href="#" class="text-right btn btn-secondary cancel_btn btn-sm"><?php echo trans('bookings') ?></a>
                  <?php endif; ?>
                </div>
              </div>


              <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/events/booking_add')?>" role="form" novalidate>

                <div class="card-body">
                    
                    <div class="row">


                      <div class="col-sm-7 mt-4">

                          <div class="form-group">
                            <label><?php echo trans('events') ?> <span class="text-danger">*</span></label>
                            <select class="form-control event_tickets" name="event_id" required>
                                <option value=""><?php echo trans('events') ?></option>
                                <?php foreach ($events as $event): ?>
                                  <option value="<?php echo html_escape($event->id) ?>" <?php if (isset($booking[0]['event_id']) && $booking[0]['event_id'] == $event->id){echo "selected";} ?>><?php echo html_escape($event->name) ?></option>
                                <?php endforeach ?>                 
                            </select>
                          </div>

                          <div class="form-group ticket_area" style="display: <?php if (isset($page_title) && $page_title != "Edit Booking"){echo "none";} ?>;">
                            <label><?php echo trans('tickets') ?> <span class="text-danger"></span></label>
                            <select class="form-control events" name="ticket_id">
                                <option value=""><?php echo trans('tickets') ?></option>
                                <?php foreach ($tickets as $ticket): ?>
                                  <option value="<?php echo html_escape($ticket->id) ?>" <?php if (isset($booking[0]['ticket_id']) && $booking[0]['ticket_id'] == $ticket->id){echo "selected";} ?>><?php echo html_escape($ticket->name) ?></option>
                                <?php endforeach ?>                 
                            </select>
                          </div>

                          <div class="form-group quantity_area" style="display: <?php if (isset($page_title) && $page_title != "Edit Booking"){echo "none";} ?>;">
                            <label><?php echo trans('quantity') ?><span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="quantity" value="<?php if(isset($booking[0]['total_slot'])){echo html_escape($booking[0]['total_slot']);} ?>" required>
                          </div>
                        
                          <div class="form-group">
                            <label><?php echo trans('customers') ?> <span class="text-danger">*</span></label>
                            <select class="form-control select2s" name="customer_id" required>
                                <option value=""><?php echo trans('customers') ?></option>
                                <?php foreach ($customers as $customer): ?>
                                  <option value="<?php echo html_escape($customer->id) ?>" <?php if (isset($booking[0]['customer_id']) && $booking[0]['customer_id'] == $customer->id){echo "selected";} ?>><?php echo html_escape($customer->name) ?></option>
                                <?php endforeach ?>                 
                            </select>
                          </div>
                        
                          <div class="form-group">
                            <label><?php echo trans('status') ?> <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required> 
                              <option value="0" <?php if (isset($booking[0]['status']) && $booking[0]['status'] == 0){echo "selected";} ?>> <?php echo trans('pending') ?></option>
                              <option value="1" <?php if (isset($booking[0]['status']) && $booking[0]['status'] == 1){echo "selected";} ?>> <?php echo trans('approved') ?></option>
                              <option value="2" <?php if (isset($booking[0]['status']) && $booking[0]['status'] == 2){echo "selected";} ?>> <?php echo trans('rejected') ?></option>
                            </select>
                          </div>


                          <?php if (isset($page_title) && $page_title != "Edit Booking"): ?>
                            <div class="form-group mt-2">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" id="checkboxPrimary2" name="notify_customer" value="1">
                                <label for="checkboxPrimary2"> <span class="small"><?php echo trans('notify-customers') ?></span>
                                </label>
                              </div>
                            </div>
                          <?php endif; ?>
                      </div>

                    
                    </div>

                </div>

                <div class="card-footer">
                    <input type="hidden" name="id" value="<?php if(isset($booking[0]['id'])){echo html_escape($booking[0]['id']);} ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <?php if (isset($page_title) && $page_title == "Edit Booking"): ?>
                      <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save-changes') ?></button>
                    <?php else: ?>
                      <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save') ?></button>
                    <?php endif; ?>
                </div>

              </form>

            </div>
        </div>
      </div>


      <?php if (isset($page_title) && $page_title != 'Edit Booking'): ?>
        <div class="list_area">
          
          <div class="row">
            <div class="col-lg-12">
              <div class="card list_area">
                <div class="card-header">
                  <?php if (isset($page_title) && $page_title == "Edit Booking"): ?>
                    <h3 class="card-title pt-2">Edit Booking <a href="<?php echo base_url('admin/events/booking') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                  <?php else: ?>
                    <h3 class="card-title pt-2"><?php echo trans('bookings') ?></h3>
                  <?php endif; ?>

                  <div class="card-tools pull-right d-flex justify-content-between">
                    <div>
                      <form method="get" class="event_sort_form" action="<?php echo base_url('admin/events/booking') ?>">
                        <select name="event_range" class="nice_select small xs customs mr-2 booking_sort">
                          <option value="0"> <?php echo trans('all') ?></option>
                          <option value="<?php echo date('Y-m-d') ?>" <?php if (isset($_GET['event_range']) && $_GET['event_range'] == date('Y-m-d')){echo "selected";} ?>> <?php echo trans('today') ?></option>
                          <option value="<?php echo date('Y-m-d', strtotime('+1 days')) ?>" <?php if (isset($_GET['event_range']) && $_GET['event_range'] == date('Y-m-d', strtotime('+1 days'))){echo "selected";} ?>> <?php echo trans('tomorrow') ?></option>
                          <option value="<?php echo date('Y-m-d', strtotime('+7 days')) ?>" <?php if (isset($_GET['event_range']) && $_GET['event_range'] == date('Y-m-d', strtotime('+7 days'))){echo "selected";} ?>> <?php echo trans('next-7-days') ?></option>
                          <option value="<?php echo date('Y-m-d', strtotime('+15 days')) ?>"<?php if (isset($_GET['event_range']) && $_GET['event_range'] == date('Y-m-d', strtotime('+15 days'))){echo "selected";} ?>> <?php echo trans('next-15-days') ?></option>
                        </select>
                      </form>
                    </div>
                     <div>
                      <a href="#" class="pull-right btn btn-outline-primary btn-sm add_btn mr-1"><i class="fa fa-plus"></i> <span class="d-none d-md-inline"><?php echo trans('new-booking') ?></span></a>
                      <a href="#" class="filter-action pull-right btn btn-outline-primary btn-sm"><i class="fas fa-filter"></i></a>
                    </div>

                  </div>
                </div>

                <div class="filter_popup showFilter">
                  <p class="leads mb-3"><?php echo trans('filters') ?></p>
                  <form method="get" class="sort_forms" action="<?php echo base_url('admin/events/booking') ?>">

                    <div class="row">
                      <div class="col-md-12 mb-3">     
                        <div class="form-group mb-0">
                          <label class="mb-0"><?php echo trans('events') ?></label>
                          <select class="nice_select small wide" name="event" aria-invalid="false">
                              <option value=""><?php echo trans('all') ?></option>
                              <?php foreach ($events as $event): ?>
                                <option value="<?php echo html_escape($event->id) ?>" <?php if (isset($_GET['event']) && $_GET['event'] == $event->id){echo "selected";} ?>><?php echo html_escape($event->name) ?></option>
                              <?php endforeach ?>                 
                          </select>
                        </div>
                      </div>
                    
                      <div class="col-md-12 mb-3">   
                        <div class="form-group mb-0">
                          <label class="mb-0"><?php echo trans('customers') ?></label>
                          <select class="nice_select small wide mt-2" name="customer" aria-invalid="false">
                              <option value=""><?php echo trans('all') ?></option>
                              <?php foreach ($customers as $customer): ?>
                                <option value="<?php echo html_escape($customer->customer_id) ?>" <?php if (isset($_GET['customer']) && $_GET['customer'] == $customer->customer_id){echo "selected";} ?>><?php echo html_escape($customer->name) ?></option>
                              <?php endforeach ?>   
                              
                                               
                          </select>
                        </div>
                      </div>

                      <div class="col-md-12 mb-1">   
                        <div class="form-group mb-0">
                          <label><?php echo trans('status') ?></label>
                          <select class="nice_select small wide mb-2" name="status" aria-invalid="false">
                              <option value=""><?php echo trans('all') ?></option>
                              <option value="0" <?php if (isset($_GET['status']) && $_GET['status'] == 0){echo "selected";} ?>> <?php echo trans('pending') ?></option>
                              <option value="1" <?php if (isset($_GET['status']) && $_GET['status'] == 1){echo "selected";} ?>> <?php echo trans('approved') ?></option>
                              <option value="2" <?php if (isset($_GET['status']) && $_GET['status'] == 2){echo "selected";} ?>> <?php echo trans('rejected') ?></option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-12">   
                        <div class="form-group mb-0 mt-2">
                          <input type="text" name="search" value="<?php if (isset($_GET['search'])){echo html_escape($_GET['search']);} ?>" class="form-control form-control-sm" placeholder="<?php echo trans('search') ?>">
                          <a href="<?php echo base_url('admin/events/booking') ?>" class="btn btn-default btn-xs pull-right mt-1"><i class="fas fa-redo-alt"></i> <?php echo trans('reset') ?></a>
                        </div>
                      </div>
                      
                      <div class="col-md-12">   
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-block btn-sm"><?php echo trans('submit') ?></button>
                        </div>
                      </div>
                    </div>

                  </form>
                </div>
                  

                <div class="card-body table-responsive p-0 minh-300">
                 
                  <?php if (empty($bookings)): ?>
                    <?php $this->load->view('admin/include/not-found') ?>
                  <?php else: ?>
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo trans('event') ?></th>
                                <th><?php echo trans('customer') ?></th>
                                <th><?php echo trans('ticket') ?></th>
                                <th><?php echo trans('venue') ?></th>
                                <th><?php echo trans('status') ?></th>
                                <th><?php echo trans('payment-status') ?></th>
                                <th><?php echo trans('action') ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $a=1; foreach ($bookings as $booking): ?>
                                <tr class="defaults" id="row_<?php echo html_escape($booking->id) ?>">
                                    <th><?php echo html_escape($a) ?></th>
                                   
                                    
                                    <?php $event = get_by_id($booking->event_id, 'events'); ?>
                                    <?php $customer = get_by_id($booking->customer_id, 'customers'); ?>
                                    <?php $ticket = get_by_id($booking->ticket_id, 'event_ticket'); ?>
                                    <?php $venue = get_by_id($booking->venue_id, 'event_venue'); ?>

                                    <td>

                                      <p class="mb-0">
                                        <p class="mb-0 font-weight-bold"><?php echo html_escape($event->name) ?> </p>
                                        <span class="fs-12"><i class="bi bi-calendar-check mr-1"></i><?php echo  my_date_show($event->date) ?></span>
                                        <span class="fs-12"><i class="bi bi-clock mr-1 ml-3"></i><?php echo html_escape($event->time)?></span>
                                      </p>
                                    </td>

                                    <td>
                                      <div class="d-flex">
                                        <div class="mr-3">
                                          <a data-tooltip="<?php echo trans('view-details') ?>" href="<?php echo base_url('admin/customers/details/'.md5($booking->customer_id));?>" class="text-dark">
                                          <img class="img-circle mr-2" width="40px" height="40px" src="<?php echo base_url($customer->thumb) ?>"> <?php echo html_escape($customer->name) ?> 
                                          <span class="badge badge-info"><?php if($customer->role == 'guest') {echo html_escape($customer->role);}?></span></a>
                                        </div>
                                      </div>
                                    </td>

                                    <td>
                                      <p class="mb-0">
                                        <span><?php echo html_escape($ticket->name) ?></span>
                                        <span class="ml-1">
                                          <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                                          <?php echo number_format($ticket->price , $this->business->num_format) ?>
                                          <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?> 
                                        </span>
                                        
                                      </p>
                                      <p class="mb-0"><b><?php echo trans('quantity') ?></b> : <?php echo html_escape($booking->total_slot) ?> </p>
                                      <p class="mb-0">
                                        <b><?php echo trans('total-price') ?></b> :
                                         <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
                                          <?php echo number_format($booking->total_price , $this->business->num_format) ?>
                                          <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?> 
                                      </p>
                                    </td>

                                    <td>
                                      <p class="mb-0">
                                        <span><?php echo html_escape($venue->name) ?></span>
                                      </p>
                                      
                                    </td>
                                    <td>
                                        <select data-id="<?php echo html_escape($booking->id) ?>" name="" class="nice_select small custom active_event_status <?php if ($booking->status == 0){echo "br-warning";}elseif($booking->status == 1){echo "br-success";}elseif($booking->status == 2){echo "br-danger";}else{echo "br-primary";} ?>">
                                          <option value="0" <?php if ($booking->status == 0){echo "selected";} ?>> <?php echo trans('pending') ?></option>
                                          <option value="1" <?php if ($booking->status == 1){echo "selected";} ?>> <?php echo trans('approved') ?></option>
                                          <option value="2" <?php if ($booking->status == 2){echo "selected";} ?>> <?php echo trans('rejected') ?></option>
                                          <option value="3" <?php if ($booking->status == 3){echo "selected";} ?>> <?php echo trans('completed') ?></option>
                                        </select>
                                    </td>
                                   
                                    <td>

                                      <p class="fs-14 mb-0">
                                        <?php $check_payment = check_event_payment($booking->event_id, $booking->user_id, $booking->customer_id) ?>
                                         <?php if ($check_payment == 1): ?>
                                            <span class="text-success font-weight-bold fs-12"><i class="fas fa-check-circle"></i> <?php echo trans('paid') ?></span>
                                          <?php else: ?>
                                              <span class="text-warning font-weight-bold fs-12"><i class="far fa-clock"></i> <?php echo trans('pending') ?></span>
                                          <?php endif; ?>
                                      </p>
                                      
                                    </td>

                                    
                                    
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
                                              <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" role="menu">

                                              
                                              
                                              <a href="<?php echo base_url('admin/events/edit_booking/'.html_escape($booking->id));?>" class="dropdown-item"><i class="lni lni-pencil mr-1"></i> <?php echo trans('edit') ?></a>

                                              <a data-val="Category" data-id="<?php echo html_escape($booking->id); ?>" href="<?php echo base_url('admin/events/delete_booking/'.html_escape($booking->id));?>" class="dropdown-item delete_item"><i class="lni lni-trash-can mr-1"></i> <?php echo trans('delete') ?></a>

                                              <?php if ($check_payment == 0): ?>
                                                <a href="#paymentModal_<?= $a; ?>" data-toggle="modal" class="dropdown-item"><i class="lni lni-coin mr-1"></i> <?php echo trans('record-payment') ?></a>
                                              <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="arrow"></span></td>
                                </tr>

                                

                            <?php $a++; endforeach ?>
                        </tbody>
                    </table>
                  <?php endif ?>
                </div>

              </div>

              <div class="mt-4">
                <?php echo $this->pagination->create_links(); ?>
              </div>
              
            </div>
          </div>
        </div>
      <?php endif ?>

    </div>
  </div>
</div>





<!-- Modal -->

<?php $i=1; foreach ($bookings as $booking): ?>


<?php $event = get_by_id($booking->event_id, 'events'); ?>
<?php $customer = get_by_id($booking->customer_id, 'customers'); ?>

<div class="modal fade d-hide" id="paymentModal_<?= $i; ?>" aria-hidden="true">
  <div class="modal-dialog">
  
    <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/payment/event_payment_success/'.$booking->id.'/offline')?>" role="form" novalidate>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?php echo trans('record-payment') ?> - <?php echo html_escape($event->name); ?></h4>
          <div class="mclose" data-dismiss="modal"><i class="lnib lni-close"></i></div>
        </div>

        
        <div class="modal-body">
          <div class="form-group">
            <label><?php echo trans('price') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="price" value="<?php echo number_format($booking->total_price, $this->business->num_format) ?>" disabled>
          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <button type="submit" class="btn btn-primary"><?php echo trans('save') ?></button>
        </div>
      </div>
    </form>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php $i++; endforeach; ?>



