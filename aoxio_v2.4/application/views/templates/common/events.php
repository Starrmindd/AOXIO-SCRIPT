
<section class="bg-light p-6">
    <div class="container">
        <div class="rows d-flex justify-content-center hide-xs">
            <h2 class="pt-2"><?php echo html_escape($page_title) ?></h2>
        </div>
    </div>
</section>


<section class="bg-lights pt-8 border-top-light">
    <div class="container">
       
        <!-- events -->
        <div class="row">
            <?php if (empty($events)): ?>
                <div class="col-md-12 text-center">
                    <p class="text-muted m-auto pt-4 fs-16"><?php echo trans('no-data-found') ?></p>
                </div>
            <?php else: ?>

                <?php $i=1; foreach ($events as $event): ?>
                   <div class="<?php if($slider != TRUE ){echo 'col-md-6';}else{echo "pt-5";} ?> mb-5" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">

                        <div class="card overflow-hidden brd-20 shadow-light shadow-hover border-0 transition-hover h-100">
                            <a href="<?php echo base_url('event/'.$event->slug.'/'.$slug) ?>">
                                <div class="cop-bg-img h-300 position-relative" style="background-image: url(<?php echo base_url($event->image) ?>)">
                                    
                                    <div class="event_date">
                                       <div class="center-element text-center">
                                            <p class="mb-0 fs-30 text-light"><?php echo show_day($event->date) ?></p>
                                            <p class="mb-1 mt-0 fs-14 font-weight-bold text-white"><?php echo show_month($event->date) ?></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </a>

                            <div class="card-body bg-none">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge badge-primary py-2 px-3 rounded-pill">
                                           <?php echo get_by_id($event->category, 'event_category')->name ?>
                                        </span>

                                        <span class="ml-1 badge badge-primary py-2 px-2 rounded-pill">
                                           <i class="far fa-clock"></i>  <?php echo html_escape($event->time); ?>
                                        </span>
                                    </div>

                                </div>


                                <div class="mt-3">
                                    <h5 class=""><?php echo html_escape($event->name) ?></h5>
                                    <p><?php echo character_limiter($event->details, 100) ?></p>
                                </div>


                                <a href="<?php echo base_url('event/'.$event->slug.'/'.$slug) ?>" class="btn btn-sm brd-10 px-3 btn-light-secondary"><?php echo trans('read-more') ?> <i class="bi bi-arrow-right ml-1"></i></a>
                            </div>

                        </div>

                    </div>
                <?php $i++; endforeach; ?>

            <?php endif; ?>
        </div>
        <!-- End events -->
    </div>
</section>