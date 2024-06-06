<?php include"topbar.php"; ?>

<section class="pt-0 cus-account">
    <div class="container cw-14">
        <div class="row mb-100">
            <div class="col-md-3 col-sm-12">
                <?php include'side_menu.php'; ?>
            </div>
            

            <div class="col-md-9">
                <div class="card shadow-sm br-10 over-hiddens mb-4">
                    <div class="card-header bg-white px-5 py-2 mt-3">

                        
                        <div class="row">
                            <div class="mb-5 col-md-6">
                                <h5 class="card-title font-weight-normal"><?php echo trans('events') ?> <span class="count"><?php echo count($event_bookings) ?></span> </h5>
                            </div>

                            <div class="col-md-6">
                                    <form class="sort_form" method="get" action="<?php echo base_url('customer/events') ?>">
                                        <div class="input-group mt--8">
                                            <input type="text" class="form-control daterange" name="daterange" aria-describedby="button-addon2" autocomplete="off" placeholder="Select date">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary sort_btn" type="button" id="button-addon2"><i class="fas fa-search"></i> </button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        <div class="row hide-xs">
                            <div class="col-md-6">
                                <h5 class="font-weight-normal"><?php echo trans('event') ?></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="font-weight-normal"><?php echo trans('ticket') ?></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="font-weight-normal"><?php echo trans('') ?></h5>
                            </div>
                        </div>

                        <?php foreach ($event_bookings as $event): ?>
                            <div class="row mb-3 bg-gray p-3 rounded">
                                <div class="col-md-6">
                                    <p class="mb-1 fs-16 font-weight-bold text-dark"><?php echo html_escape($event->event_name) ?></p>
                                    <p class="mb-0 fs-13">
                                        <span class="mr-2">#<?php echo $event->booking_number ?></span>
                                        <span class="mr-2"><i class="bi bi-calendar-check mr-2"></i><?php echo my_date_show($event->date) ?></span>
                                        <span><i class="bi bi-clock mr-2"></i><?php echo html_escape($event->time) ?></span>
                                    </p>
                                    <p class="mb-0 fs-13 text-dark"><b class="text-dark"><?php echo trans('venue') ?>:</b> <?php echo get_by_id($event->venue_id,'event_venue')->name ?></p>
                                    
                                </div>
                                <div class="col-md-3">
                                    
                                    <p class="mb-0 fs-16 text-dark"><?php echo html_escape($event->ticket_name) ?></p>

                                    <p class="mb-0"> <?php echo trans('total-price') ?> :
                                        <?php if ($event->price == 0): ?>
                                            <?php echo trans('free') ?>
                                        <?php else: ?>
                                            <span>
                                                (<?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?><?php echo number_format($event->price, $company->num_format) ?> <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?> X <?php echo html_escape($event->total_slot) ?>) </span>
                                            <span>
                                                <?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?><?php echo number_format($event->total_price, $company->num_format) ?> <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                                            </span>
                                            
                                        <?php endif ?>
                                    </p>
                                </div>

                                <div class="col-md-3 justify-content-center">
                                   
                                    <?php $check_payment = check_event_payment($event->event_id, $event->user_id, $event->customer_id) ?>
                                    <?php $cpayment = event_payment_details($event->event_id, $event->user_id, $event->customer_id) ?>
                                            <!-- <?php //if ($check_payment == true): ?>
                                                <a target="_blank" href="<?php //echo base_url('customer/customer_receipt/'.$cpayment->puid) ?>" class="pull-right badge badge-primary-soft"><i class="fa fa-eye"></i> <?php //echo trans('view-invoice') ?></a>
                                            <?php //endif; ?> -->
                                            
                                            <?php if ($check_payment != true): ?>
                                                <?php if ($event->price != 0 && $cpayment->payment_method != 'offline'): ?>
                                                    <a data-toggle="tooltip" data-title="<?php echo trans('complete-your-payment') ?>" data-placement="left" class="btn btn-light-primary btn-sm" data-id="<?php echo html_escape($event->event_id) ?>" href="<?php echo base_url('event_booking_details/'.$company->slug.'/'.md5($event->id)) ?>"><i class="fas fa-credit-card"></i></a>
                                                <?php endif ?>
                                            <?php endif ?>

                                         

                                            <?php //f ($check_payment != true): ?>
                                                <!-- <a data-toggle="tooltip" data-title="<?php //echo trans('cancel-appointment') ?>" data-placement="top" class="btn btn-light-danger btn-sm cancel_item" data-id="<?php //echo html_escape($event->id) ?>" href="<?php //echo base_url('customer/cancel/'.md5($event->id)) ?>"><i class="fas fa-times-circle fs-12"></i></a> -->
                                            <?php //endif ?>
                                
                                </div>
                            </div>
                            
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</seciton>



