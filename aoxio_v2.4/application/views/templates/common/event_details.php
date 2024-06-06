<section class="bg-light p-6">
    <div class="container">
        <div class="rows d-flex justify-content-center hide-xs">
            <h2 class="pt-2"><?php echo html_escape($page_title) ?> &bull; <?php echo html_escape($event->name) ?> </h2>
        </div>
    </div>
</section>

<section class="pt-8">
    <div class="container">

        <div class="row justify-content-center booking_details">
            <div class="col-md-8">
                <div class="row mb-6">
                    <div class="col-12">
                        <div class="details-img mb-5" style="background-image: url(<?php echo base_url($event->image) ?>);"></div>
                        <h4 class="mb-5"><?php echo html_escape($event->name) ?></h4>
                        <?php if(!empty($event->details)): ?>
                            <p class="mt-5"><?php echo strip_tags($event->details) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">

                <div class="mb-5 pl-4">
                    <?php if($event->date >= date('Y-m-d')): ?>
                        <a class="btn btn-dark btn-block booking_btn" href="#"><i class="bi bi-calendar-check"></i> <?php echo trans('book-a-ticket') ?></a>
                    <?php else : ?>
                       <a class="btn btn-danger btn-block fs-18" href="#"> <i class="bi bi-hourglass-bottom"></i>
                        <?php echo trans('expired') ?></a>
                    <?php endif; ?>
                    
                </div>
                <?php if($event->date >= date('Y-m-d')): ?>
                    <div class="sidebar-info pl-4 mb-5 mt-0">
                        <div class="sidebar-item">
                            <div class="sidebar-item-row d-flex justify-content-start bg-primary-soft">
                                <div class="sidebar-item-info">
                                    <p class="mb-0 text-dark fs-18 pt-2 pb-2"><?php echo trans('event') ?> <?php echo trans('countdown') ?></p>
                                </div>
                            </div>

                            <div class="sidebar-item-row d-flex justify-content-start bg-primary text-white">
                                <div class="sidebar-item-info">
                                    <div id="countdown" align="center"></div>
                                </div>
                            </div>
                            <input type="hidden" id="event_countdown_date" value="<?php if(!empty($event->date)){echo html_escape($event->date);} ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="sidebar-info pl-4 mb-5 mt-0">

                    <div class="sidebar-item">

                        <div class="sidebar-item-row d-flex justify-content-start bg-grey">
                            <div class="sidebar-item-info">
                                <p class="mb-0 text-dark fs-18 pt-2 pb-2"><?php echo trans('event-info') ?></p>
                            </div>
                        </div>

                        <div class="sidebar-item-row d-flex justify-content-start">
                            <div class="mr-3 sidebar-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>


                            <div class="sidebar-item-info">
                                <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('date') ?></p>
                                <p class="mb-0 sidebar-item-info"><?php echo my_date_show($event->date) ?></p>
                            </div>
                        </div>

                        <div class="sidebar-item-row d-flex justify-content-start">
                            <div class="mr-3 sidebar-icon">
                                <i class="bi bi-clock"></i>
                            </div>


                            <div class="sidebar-item-info">
                                <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('time') ?></p>
                                <p class="mb-0 sidebar-item-info"><?php echo html_escape($event->time) ?></p>
                            </div>
                        </div>

                        <div class="sidebar-item-row d-flex justify-content-start">
                            <div class="mr-3 sidebar-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="sidebar-item-info">
                                <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('venue') ?></p>
                                <p class="mb-0 sidebar-item-info">
                                    <?php echo get_by_id($event->venue, 'event_venue')->name ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if($event->is_organizer == 1): ?>
                    <div class="sidebar-info pl-4 mb-5 mt-3">
                       
                        <div class="sidebar-item">
                            <div class="sidebar-item-row d-flex justify-content-start bg-grey">
                                <div class="sidebar-item-info">
                                    <p class="mb-0 text-dark fs-18 pt-2 pb-2"><?php echo trans('organizer-info') ?></p>
                                </div>
                            </div>

                            <div class="sidebar-item-row d-flex justify-content-start">
                                <div class="mr-3 sidebar-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>

                                <div class="sidebar-item-info">
                                    <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('name') ?></p>
                                    <p class="mb-0 sidebar-item-info"><?php echo html_escape($event->organizer_name) ?></p>
                                </div>
                            </div>

                            <div class="sidebar-item-row d-flex justify-content-start">
                                <div class="mr-3 sidebar-icon">
                                    <i class="bi bi-at fa-1x text-danger"></i>
                                </div>


                                <div class="sidebar-item-info">
                                    <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('email') ?></p>
                                    <p class="mb-0 sidebar-item-info"><?php echo html_escape($event->organizer_email) ?></p>
                                </div>
                            </div>

                            <div class="sidebar-item-row d-flex justify-content-start">
                                <div class="mr-3 sidebar-icon">
                                    <i class="bi bi-telephone"></i>
                                </div>


                                <div class="sidebar-item-info">
                                    <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('contact') ?></p>
                                    <p class="mb-0 sidebar-item-info"><?php echo html_escape($event->organizer_phone) ?></p>
                                </div>
                            </div>

                            <div class="sidebar-item-row d-flex justify-content-start">
                                <div class="mr-3 sidebar-icon">
                                    <i class="bi bi-link"></i>
                                </div>


                                <div class="sidebar-item-info">
                                    <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('website') ?></p>
                                    <p class="mb-0"><a target="blank_" href="<?php echo prep_url($event->organizer_website) ?>"><?php echo prep_url($event->organizer_website) ?></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="sidebar-info pl-4 mb-5 mt-3">
                       
                        <div class="sidebar-item">
                            <div class="sidebar-item-row d-flex justify-content-start bg-grey">
                                <div class="sidebar-item-info">
                                    <p class="mb-0 text-dark fs-18 pt-2 pb-2"><?php echo trans('organizer-info') ?></p>
                                </div>
                            </div>

                            <div class="sidebar-item-row d-flex justify-content-start">
                                <div class="mr-3 sidebar-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>

                                <div class="sidebar-item-info">
                                    <p class="mb-0 mt-0 sidebar-item-title"><?php echo trans('this-event-is-organized-by') ?> :
                                    <span class="text-muted"><?php echo html_escape($company->name) ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>


            </div>
        </div>

        

        <form id="event_booking" method="post" action="<?php echo base_url('event_booking/'.$slug); ?>">
                    
            <div class="booking_option hide">
                
                <div class="row justify-content-center">
                    <div class="col-md-8 card p-3">
                        <div class="p-3">
                            <div class="mt-3">
                                <?php $tickets = $this->event_model->get_tickets_by_event($event->id);  ?>

                                <h5 class="mb-1"><?php echo trans('availlable-tickets-for') ?>  - <?php echo html_escape($event->name) ?></h5>
                                
                                <div id="countdown_ticket" class="mb-4 mt-3  fs-18 py-1 px-3 bg-danger-soft rounded" align="left"></div>


                                <?php $e=1; foreach ($tickets as $ticket): ?>

                                    <?php if($ticket->limit > 0): ?>
                                        <label class="service-rdo">
                                            <input type="radio" name="ticket_id" class="ticket_input" value="<?php echo html_escape($ticket->id) ?>"/>
                                            <div class="d-flex justify-content-between py-2 align-items-center mb-4 m-0">
                                                <div class="col-auto mb-sm-0">
                                                    <div class="media service_item">

                                                        <div class="media-body">
                                                            <h5 class="text-dark mb-0 pt-1 h6"><?php echo html_escape($ticket->name) ?></h5>

                                                            <p class="mb-0"><b>Ticket remaining </b>: <?php echo html_escape($ticket->limit); ?></p>

                                                            <p class="mb-0">Ticket per buyer : <?php echo html_escape($ticket->tickets_per_attendee); ?></p>

                                                            <span class="service-price-sm font-weight-bold text-dark d-hide">
                                                                <?php if ($ticket->price == 0): ?>
                                                                    <?php echo trans('free') ?>
                                                                <?php else: ?>
                                                                    <?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?> <?php echo number_format($ticket->price, $company->num_format) ?> <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                                                                <?php endif ?>
                                                            </span>
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto text-sm-right">
                                                    <span class="service-price badge badge-secondary-soft badge-pill">
                                                        <?php if ($ticket->price == 0): ?>
                                                            <?php echo trans('free') ?>
                                                        <?php else: ?>
                                                            <?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?> <?php echo number_format($ticket->price, $company->num_format) ?> <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                                                        <?php endif ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <input type="hidden" id="ticket_countdown_date" value="<?php if(!empty($event->date)){echo html_escape($event->date);} ?>">
                                            <input type="hidden" name="event_id" value="<?php echo html_escape($event->id); ?>">
                                        </label>

                                        <input type="hidden" name="tickets_per_attendee" class="tickets_per_attendee" value="<?php echo html_escape($ticket->tickets_per_attendee) ?>">
                                    <?php endif; ?>
                                <?php $e++; endforeach; ?>
                            </div>

                            <div class="mb-5">
                                <div class="form-group hide ticket_quantity">
                                    <label><?php echo trans('quantity') ?> <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control quantity selected_quantity_<?php echo html_escape($ticket->id) ?>" min="1" name="quantity" >
                                </div>

                                <?php if ($company->default_timezone == 1): ?>
                                        <input type="hidden" class="event_booking_time_zone" name="event_time_zone" value="<?php echo $company->time_zone ?>"> 
                                    <?php else: ?>
                                    
                                    <div class="col-md-12 p-0 <?php if(is_customer() && !empty(user()->time_zone)){echo 'd-none';} ?>">
                                        <div class="form-group">
                                            <label><?php echo trans('time-zone') ?><span class="text-danger">*</span></label>
                                            <div class="">
                                                <select class="cus_lh event_booking_time_zone form-control select2" name="event_time_zone" style="width: 100%;" required>
                                                    <option value=""><?php echo trans('select') ?></option>
                                                    <?php foreach ($time_zones as $time): ?>
                                                        <option <?php if(is_customer() && user()->time_zone == $time->id){echo 'selected';} ?> value="<?php echo html_escape($time->id); ?>"><?php echo html_escape($time->name); ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif ?>
                            
                                
                                <button type="submit" class="btn btn-primary btn-block continue_btn" disabled><?php echo trans('continue') ?></button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="venue-infos p-3 bg-light">
                            <h4><?php echo trans('venue-info') ?></h4>
                            <ul class="list-unstyled mb-0 p-0">
                                <li class="py-2">
                                    <div class="d-flex">
                                        <span class="sidebar-icon mr-3">
                                            <i class="bi bi-house"></i>
                                        </span> 
                                        <span class="pt-3"><?php echo get_by_id($event->venue, 'event_venue')->name; ?></span>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="d-flex">
                                        <span class="sidebar-icon mr-3">
                                            <i class="bi bi-telephone"></i>
                                        </span> 
                                        <span class="pt-3"><?php echo get_by_id($event->venue, 'event_venue')->phone; ?></span>
                                    </div>
                                </li>
                                <?php if(!empty(get_by_id($event->venue, 'event_venue')->address)): ?>
                                    <li class="py-2">
                                        <div class="d-flex">
                                            <span class="sidebar-icon mr-3">
                                                <i class="bi bi-geo-alt"></i>
                                            </span> 
                                            <span class="pt-3"><?php echo get_by_id($event->venue, 'event_venue')->address ?></span>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>

                    </div>
                    
                </div>
                
            </div>
            
        </form>
    </div>
</section>






