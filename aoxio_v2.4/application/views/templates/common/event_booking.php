<div class="container mt-10 mb-10">

    <div class="event_booking_step_2">
        <form id="event_booking_form" method="post" action="<?php echo base_url('confirm_event_booking/'.$slug); ?>">

            <div class="row justify-content-center">
                <div class="col-md-8 card p-5">
                    
                     <?php if(!is_customer()): ?>
                        <ul class="nav nav-pills mb-3 mb-3 mt-4 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item mr-2 mb-4">
                                <a class="booking-nav-item nav-link active event_click_new" id="one-tab" data-toggle="pill" href="#one" role="tab" aria-controls="One" aria-selected="true"><i class="fas fa-user-plus"></i> <?php echo trans('new-registration') ?></a>
                            </li>
                            <li class="nav-item mr-2 mb-4">
                                <a class="booking-nav-item nav-link event_click_old" id="two-tab" data-toggle="pill" href="#two" role="tab" aria-controls="two" aria-selected="false"><i class="fas fa-user-check"></i> <?php echo trans('already-have-account') ?></a>
                            </li>
                            <?php if ($company->enable_guest == 1): ?>
                                <li class="nav-item mr-2 mb-4">
                                    <a class="booking-nav-item nav-link event_click_guest" id="one-tab" data-toggle="pill" href="#one" role="tab" aria-controls="one" aria-selected="false"><i class="fas fa-user-secret"></i> <?php echo trans('guest-booking') ?></a>
                                </li>
                            <?php endif ?>

                        </ul>
                    
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active mt-6" id="one" role="tabpanel" aria-labelledby="one-tab">
                                <div class="row p-0">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo trans('name') ?></label>
                                            <input type="text" class="form-control" name="name" placeholder="<?php echo trans('your-full-name') ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1"><?php echo trans('phone') ?> <span class="text-danger">*</span></label>
                                                    <div class="input-phone"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" placeholder="<?php echo trans('your-email-address') ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12 event_guest_hide">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('password') ?> <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="new_password" placeholder="<?php echo trans('your-password') ?>">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="tab-pane fade show mt-6" id="two" role="tabpanel" aria-labelledby="two-tab">
                                <div class="row p-0">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo trans('phone') ?> / <?php echo trans('email') ?></label>
                                            <input type="text" class="form-control" name="user_name" placeholder="<?php echo trans('your-email') ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-5">
                                            <label><?php echo trans('password') ?></label>
                                            <input type="password" class="form-control" name="old_password" placeholder="<?php echo trans('your-password') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endif; ?>
                    

                    <div class="row mt-2">

                        <div class="col-12 mb-4 hide">
                            <a href="javascript:;" class="fs-15 mb-2 badge badge-secondary-soft badge-pill note_btn"><?php echo trans('any-special-notes') ?></a>
                            <textarea class="form-control mt-2 note_area d-hide" name="note" rows="2" placeholder="<?php echo trans('write-your-notes-here') ?>"></textarea>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="event_booking_terms_btn" class="custom-control-input event_booking_terms_btn"
                                    id="terms-condition" required>
                                <label class="custom-control-label" for="terms-condition">
                                    <?php echo trans('i-have-read-and-understood-the') ?> 
                                    <a href="<?php echo base_url('terms-and-conditions/'.$company->slug) ?>"><?php echo trans('terms-and-conditions') ?></a>
                                    <?php echo trans('and') ?> <a href="<?php echo base_url('privacy-policy/'.$company->slug) ?>"> <?php echo trans('privacy-policy') ?> </a><?php echo trans('of-this-site') ?>.</label>
                            </div>
                        </div>
                    
                        <div class="col-12">
                            <?php if (settings()->enable_captcha == 1 && settings()->captcha_site_key != ''): ?>
                                <div class="g-recaptcha pull-left" data-sitekey="<?php echo html_escape(settings()->captcha_site_key); ?>"></div>
                            <?php endif ?>
                        </div>

                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                        <input type="hidden" class="event_is_customer_exist" name="is_customer_exist" value="<?php if(is_customer()){echo 1;}else{echo 0;} ?>">
                        <input type="hidden" class="ticket_id" name="ticket_id" value="<?php echo html_escape($ticket->id) ?>">
                        <input type="hidden" class="event_id" name="event_id" value="<?php echo html_escape($event->id) ?>">
                        <input type="hidden" class="quantity" name="quantity" value="<?php echo html_escape($quantity) ?>">
                        <input type="hidden" class="" name="time_zone" value="<?php echo html_escape($time_zone) ?>">

                        <div class="col-12 d-flex justify-content-between">
                            <a href="<?php echo base_url('event/'.$event->slug.'/'.$slug) ?>" class="btn btn-secondary event_step2_back_btn"><i class="fas fa-long-arrow-alt-left"></i> <?php echo trans('back') ?> </a>
                            <button type="submit" class="btn btn-primary event_step2_btn" disabled="disabled"><?php echo trans('continue') ?> <i class="fas fa-long-arrow-alt-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 border 1">
                    <div class="p-5">
                        <h5 class="font-weight-normal pb-3"><?php echo trans('booking-info') ?></h5>
                        
                        <div class="booking-item mb-5 mt-2">
                          <p class="mb-0 text-muted fs-14"> <?php echo trans('event') ?></p>
                          <p class="text-dark fs-16"><?php echo html_escape($event->name) ?></p>
                        </div>

                        <div class="booking-item mb-5 mt-2">
                          <p class="mb-0 text-muted fs-14"><?php echo trans('ticket') ?></p>
                          <p class="text-dark fs-16"><?php echo html_escape($ticket->name) ?></p>
                        </div>

                        <div class="booking-item mb-5 mt-2">
                          <p class="mb-0 text-muted fs-14"> <?php echo trans('quantity') ?> </p>
                          <p class="text-dark fs-16"><?php echo html_escape($quantity) ?></p>
                         
                        </div>

                        <div class="booking-item mb-5 mt-2">
                          <p class="mb-0 text-dark fs-14"> <?php echo trans('total-price') ?></p>
                         <p class="text-dark fs-16">
                              <?php $total_price = ($ticket->price * $quantity); ?>

                              <?php if ($ticket->price == 0): ?>
                                    <?php echo trans('free') ?>
                                <?php else: ?>
                                    <?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?> <?php echo number_format($total_price, $company->num_format) ?> <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                                <?php endif ?>
                         </p>
                        </div>

                        <div class="booking-item">
                          <p class="mb-0 text-muted fs-14"> <?php echo trans('date') ?></p>
                          <?php $date = $event->date; ?>
                          <p class="text-dark fs-16"><?php echo my_date_show($date) ?></p>
                        </div>

                        <div class="booking-item">
                          <p class="mb-0 text-muted fs-14"> <?php echo trans('venue') ?></p>
                          <?php $venue = get_by_id($event->venue,'event_venue')->name; ?>
                          <p class="text-dark fs-16"><?php echo html_escape($venue) ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </form>
                    
           
    </div>
</div>