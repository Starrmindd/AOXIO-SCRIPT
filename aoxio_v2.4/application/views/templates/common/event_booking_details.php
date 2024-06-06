<?php include"topbar.php"; ?>


<section class="bg-lights pt-14 cus-account">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-10 col-xl-8">
                <h4 class="mb-0"><?php echo trans('booking-confirmation') ?></h4>
                <p class="w-100 w-lg-80 mx-auto mb-0"><?php echo trans('confirm-the-booking') ?></p>
            </div>
        </div>
    </div>


    <div class="container mt-5 mb-10">
        <div class="row justify-content-center">
           <div class="col-lg-9 card shadow-light br-10 p-5">
                <div class="row" data-aos="fade-up" data-aos-duration="150">
                <div class="col-md-6">
                    <p class="mb-0"><?php echo trans('booking-number') ?> </p>
                    <h4># <?php echo html_escape($booking->booking_number) ?></h4>
                </div>

                <div class="col-md-6 text-right">
                     
                </div>
            </div>

            <div class="row mt-4" data-aos="fade-up" data-aos-duration="250">
                <div class="col-md-12 mb-2 text-left">
                    <h5 class="mb-2 h5 info-title"><?php echo trans('booking-info') ?></h5>
                </div>
                
                <div class="col-md-6 mb-2 text-left">
                    <p class="small mb-0"><i class="fas fa-calendar-alt"></i> <?php echo trans('date') ?></p>
                    <p class="text-dark font-weight-normal"> <?php echo my_date_show(get_by_id($booking->event_id,'events')->date) ?></p>
                </div>

            
                <div class="col-md-6 mb-2 text-left">
                    <p class="small mb-0"><i class="fas fa-layer-group"></i> <?php echo trans('event') ?></p>
                    <p class="text-dark font-weight-normal"><?php echo get_by_id($booking->event_id,'events')->name ?></p>
                </div>

            </div>

            <div class="row mt-4" data-aos="fade-up" data-aos-duration="400">
                <div class="col-md-12 mb-2 text-left">
                    <h5 class="mb-2 h5 info-title"><?php echo trans('customer-info') ?></h5>
                </div>
                
                <div class="col-md-6 mb-2 text-left">
                    <p class="small mb-0"><?php echo trans('name') ?></p>
                    <p class="text-dark font-weight-bold"><?php echo get_by_id($booking->customer_id,'customers')->name ?></p>
                </div>

                <div class="col-md-6 mb-2 text-left">
                    <p class="small mb-0"><?php echo trans('email') ?></p>
                    <p class="text-dark font-weight-bold"><?php echo get_by_id($booking->customer_id,'customers')->email ?></p>
                </div>
            </div>
            
            <div class="row mt-4" data-aos="fade-up" data-aos-duration="550">
                <div class="col-md-12 mb-2 text-left">
                    <h5 class="mb-2 h5 info-title"><?php echo trans('payment-info') ?></h5>
                </div>

                <?php $event = get_by_id($booking->event_id, 'events'); ?>
                <?php $ticket = get_by_id($booking->ticket_id, 'event_ticket'); ?>
                



                <div class="col-md-12 mb-4">
                    
                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                        <div>
                            <p class="mb-0"><?php echo trans('ticket') ?></p>
                        </div>
                        <div>
                            <p class="text-dark font-weight-bold mb-0">
                                <?php echo html_escape($ticket->name) ?>  (<?php echo html_escape($booking->total_slot) ?>)
                            </p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                        <div>
                            <p class="mb-0"><?php echo trans('price') ?></p>
                        </div>
                        <div>
                            <p class="text-dark font-weight-bold mb-0">
                                <?php if ($ticket->price == 0): ?>
                                    <?php echo trans('free') ?>
                                <?php else: ?>
                                   <?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?> <?php echo number_format($ticket->price, $company->num_format) ?> <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                                <?php endif ?>
                            </p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 mb-2 ">
                        <div>
                            <p class="mb-0"><?php echo trans('total-cost') ?></p>
                        </div>
                        <div>
                            <p class="text-dark font-weight-bold mb-0">
                                <?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?> <span class="final_amount"><?php echo number_format($booking->total_price, $company->num_format) ?></span> <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                            </p>
                        </div>
                    </div>
                    
                </div>



                <!-- regular booking confirmation -->
                 
                                    
                    <?php if (settings()->enable_wallet == 0): ?>
                    
                        <?php //if (check_user_feature_access($company->user_id, 'get-online-payments') == TRUE && $appointment->price != 0 && get_user_info() == TRUE): ?>
                            <div class="col-md-6 mb-2 text-left <?php if($company->enable_payment == 1){echo "d-show";}else{echo "d-hide";} ?>">
                                <label class="staff-rdo bg-primary-soft">
                                    <input type="radio" name="pay_info" class="event_pay_info" value="1" />
                                    <div class="bg-lights py-4 rounded-sm text-center payment_option">
                                        <i class="far fa-credit-card fa-2x text-muted"></i>
                                        <h6 class="mb-0 mt-2 text-dark-45 text-muted"><?php echo trans('pay-now') ?></h6>
                                    </div>
                                </label>
                            </div>
                        <?php //endif ?>

                    <?php else: ?>

                        <div class="col-md-6 mb-2 text-left <?php if($company->enable_payment == 1){echo "d-show";}else{echo "d-hide";} ?>">
                            <label class="staff-rdo bg-primary-soft">
                                <input type="radio" name="pay_info" class="event_pay_info" value="1" />
                                <div class="bg-lights py-4 rounded-sm text-center payment_option">
                                    <i class="far fa-credit-card fa-2x text-muted"></i>
                                    <h6 class="mb-0 mt-2 text-dark-45 text-muted"><?php echo trans('pay-now') ?></h6>
                                </div>
                            </label>
                        </div>

                    <?php endif ?>

                    <?php if ($ticket->price != 0): ?>
                    <div class="col-md-6 mb-2 text-left <?php //if($company->enable_onsite == 1){echo "d-show";}else{echo "d-hide";} ?>">
                        <label class="staff-rdo bg-primary-soft">
                            <input type="radio" name="pay_info" class="event_pay_info" value="2" />
                            <div class="bg-lights py-4 rounded-sm text-center payment_option">
                                <i class="far fa-clock fa-2x text-muted"></i>
                                <h6 class="mb-0 mt-2 text-dark-45 text-muted"><?php echo trans('pay-on-site') ?></h6>
                            </div>
                        </label>
                    </div>
                    <?php endif; ?>

                    

                    <!-- load payment gateways -->
                    <div class="col-md-12 mt-4 event_payments_area dnone">

                        <?php $this->load->view('include/payment_section_event.php');?>

                        <!-- <?php //if (settings()->enable_wallet == 1): ?>
                            <?php //$this->load->view('include/payment_section_admin.php');?>
                        <?php //else: ?>
                            <?php //$this->load->view('include/payment_section.php');?>
                        <?php //endif ?> -->
                    </div>
                    

                    
                    <!-- confirm booking button -->
                    <div class="col-md-12 mt-4 event_confirm_area <?php if ($ticket->price != 0){echo "dnone";} ?>">
                        <button type="button" data-id="<?php echo html_escape($appointment->id) ?>" data-val="<?php echo html_escape($slug) ?>" class="btn btn-primary btn-block confirm_pay_info"><i class="fas fa-check-circle"></i> <?php echo trans('confirm-booking') ?> </button>
                    </div>

               
            </div>
           </div>

        </div>
    </div>
</section>