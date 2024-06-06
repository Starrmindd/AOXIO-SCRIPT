<!-- Footer -->
<?php if (isset($menu) && $menu == TRUE): ?>
    <footer class="pt-4 border-top border-light">

        <div class="container">
            <div class="row pb-2">
                <div class="col-sm-5 col-lg-5 mb-5 mb-lg-0">
                    <img width="150px" src="<?php echo base_url(settings()->logo) ?>" class="w-md-30 mb-2" alt="logo">
                    <p class=""><?php echo lang_value()->footer_about ?></p>
                    <ul class="list-unstyled social-icon2 mb-0">
                        <?php if (!empty($settings->facebook)) : ?>
                            <li><a target="_blank" href="<?= prep_url($settings->facebook) ?>"><i class="lni lni-facebook-original"></i></a></li>
                        <?php endif ?>

                        <?php if (!empty($settings->twitter)) : ?>
                            <li><a target="_blank" href="<?= prep_url($settings->twitter) ?>"><i class="lni lni-twitter"></i></a></li>
                        <?php endif ?>

                        <?php if (!empty($settings->linkedin)) : ?>
                            <li><a target="_blank" href="<?= prep_url($settings->linkedin) ?>"><i class="lni lni-linkedin-original"></i></a></li>
                        <?php endif ?>

                        <?php if (!empty($settings->instagram)) : ?>
                            <li><a target="_blank" href="<?= prep_url($settings->instagram) ?>"><i class="lni lni-instagram-original"></i></a></li>
                        <?php endif ?>
                    </ul>
                </div>

                <div class="col-sm-1 col-lg-1 mb-5 mb-sm-0"></div>

                <div class="col-sm-3 col-lg-3 mb-5 mb-lg-0">
                    <h3 class="h6"><?php echo trans('services') ?></h3>
                    <ul class="footer-list-style-two">
                        <li><a href="<?php echo base_url('pricing') ?>"><?php echo trans('pricing') ?></a></li>
                        
                        <?php if (settings()->enable_blog == 1): ?>
                            <li><a href="<?php echo base_url('blogs') ?>"><?php echo trans('blogs') ?></a></li>
                        <?php endif; ?>

                        <?php if (settings()->enable_faq == 1): ?>
                        <li><a href="<?php echo base_url('faqs') ?>"><?php echo trans('faqs') ?></a></li>
                        <?php endif; ?>

                        <li><a href="<?php echo base_url('contact') ?>"><?php echo trans('contact') ?></a></li>
                    </ul>
                </div>

                <div class="col-sm-3 col-lg-3 mb-5 mb-sm-0">
                    <?php if (!empty(get_front_pages(0))): ?>
                    <h3 class="h6"><?php echo trans('pages') ?></h3>
                    <ul class="footer-list-style-two">
                        <?php foreach (get_front_pages(0) as $page): ?>
                            <li><a href="<?php echo base_url('page/'.$page->slug) ?>"><?php echo html_escape($page->title) ?></a></li>
                        <?php endforeach ?>
                    </ul>
                    <?php endif ?>
                </div>

            </div>
        </div>

        <div class="text-center border-top">
            <div class="container">
                <div class="row py-2">
                    <div class="col-md-12">
                        <p class="mb-0"><?php echo lang_value()->copyright ?></p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
<?php else: ?>
    <?php include"company_footer.php"; ?>
<?php endif; ?>


</div>

    <?php if (settings()->enable_pwa == 1): ?>
        <a class="btn btn-primary bg-primary-soft" id="installPwa" href="#" style="display: none"><i class="bi bi-arrow-down-circle-fill fs-15"></i> <?php echo trans('install-pwa') ?></a>
    <?php endif; ?>

    <?php include'js_msg_list.php'; ?>

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <?php $success = $this->session->flashdata('msg'); ?>
    <?php $error = $this->session->flashdata('error'); ?>

    <input type="hidden" id="success" value="<?php if(isset($success)){echo html_escape($success);} ?>">
    <input type="hidden" id="error" value="<?php if(isset($error)){echo html_escape($error);} ?>">  
    <input type="hidden" id="cp" value="<?php echo strlen(settings()->purchase_code);?>">
    <a href="javascript:void(0)" class="scroll-to-top"><i class="fa fa-angle-up"></i></a>
    <input type="hidden" class="accept_cookies" value="<?php echo trans('accept_cookies') ?>">
    <input type="hidden" class="accept" value="<?php echo trans('accept') ?>">
    <input type="hidden" id="country_code" value="<?php echo strtolower(settings()->code); ?>">
    <input type="hidden" id="lan_type" value="<?php echo text_dir(); ?>">
    <?php echo $this->session->unset_userdata('msg'); $this->session->unset_userdata('error'); ?>
    <!-- Global JS -->
    <script src="<?php echo base_url() ?>assets/front/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/owl-carousel/dist/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/svg-injector/dist/svg-injector.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/jarallax/dist/jarallax.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/svg-injector/dist/svg-injector.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/libs/easy-responsive-tabs/js/easyResponsiveTabs.js"></script>
   
    <!-- Custom JS -->
    <script src="<?php echo base_url() ?>assets/front/js/template.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/custom.js?var=<?= settings()->version ?>&time=<?=time();?>"></script>
    <script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/tata.js"></script>
    
    <!-- animation js -->
    <?php if(settings()->enable_animation == 1): ?>
        <script src="<?php echo base_url() ?>assets/front/js/aos.js"></script>
    <?php endif; ?>
    
    <!-- nice select js -->
    <script src="<?php echo base_url()?>assets/admin/js/nice-select.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/daterangepicker.js"></script>
    <!-- select2 js -->
    <script src="<?php echo base_url()?>assets/admin/plugins/select2/js/select2.full.min.js"></script>
    <!-- date & time picker -->
    <script src="<?php echo base_url() ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/timepicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/lightbox.js"></script>
    <script src="<?php echo base_url() ?>assets/front/js/intlInputPhone.js"></script>


    <script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!-- <script src="<?php echo base_url() ?>assets/front/js/filtergallery.min.js"></script>
    <script>
        var containerEl = document.querySelector('.containers');
        var mixer = mixitup(containerEl);
    </script> -->

    <!-- stripe js -->
    <?php $this->load->view('admin/include/stripe-js.php');?>


    <div id="load_work">
        <?php $this->load->view('include/custom-js.php');?>
    </div>


    <?php if($page == 'Company'): ?>
        <?php $terms_url = base_url('terms_privacy/'.$slug); ?>
    <?php else: ?>
        <?php $terms_url = base_url('page/terms-of-service'); ?>
    <?php endif; ?>

    <?php if(empty($is_embed) || $is_embed==false ): ?>
        <!-- gdpr compliance code -->
        <script type="text/javascript" src="<?php echo base_url() ?>assets/front/js/jquery.cookieMessage.min.js"></script>
        <script type="text/javascript">
            var cookieMsg = $('.accept_cookies').val();
            var accept = $('.accept').val();
            $.cookieMessage({
                'mainMessage': '<p class="mb-2">'+cookieMsg+' <a class="learn-more" href="<?php echo html_escape($terms_url) ?>"><?php echo trans('learn-more') ?></a>'+'</p>',
                'acceptButton': accept,
                'fontSize': '16px',
                'backgroundColor': '#222',
            });

            <?php if (isset($page_title) && $page_title == 'Gallery'): ?>
            $(document).ready(function() {
                $(window).on('load', function() { 
                    $('.preloader').fadeOut('3000');
                });
            });
            <?php endif; ?>
        </script>
    <?php endif; ?>
    <!-- gdpr compliance code -->
    
    <?php if (isset($page_title) && $page_title == 'Appointments' || $page_title == 'Events'): ?>
        <script type="text/javascript">
          <?php if ($company->time_format == 'HH'): ?>
            $(document).on("focusin",".timepicker", function () {
              $('input.timepicker').timepicker({ timeFormat: 'HH:mm', interval: 30 });
            });
          <?php else: ?>
            $(document).on("focusin",".timepicker", function () {
              $('input.timepicker').timepicker({ timeFormat: 'hh:mm p', interval: 30 });
            });
          <?php endif ?>
        </script>
    

        <script type="text/javascript">

             // daterangepicker
            $(function() {
               
              $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                locale: {
                  format: 
                    'YYYY/MM/DD',
                    "applyLabel": "<?php echo trans('apply') ?>",
                    "cancelLabel": "<?php echo trans('cancel') ?>",
                    "fromLabel": "<?php echo trans('from') ?>",
                    "toLabel": "<?php echo trans('to') ?>",
                    "customRangeLabel": "<?php echo trans('custom') ?>",
                    "daysOfWeek": [
                        "<?php echo trans('su') ?>",
                        "<?php echo trans('mo') ?>",
                        "<?php echo trans('tu') ?>",
                        "<?php echo trans('we') ?>",
                        "<?php echo trans('th') ?>",
                        "<?php echo trans('fr') ?>",
                        "<?php echo trans('sa') ?>"
                    ],
                    "monthNames": [
                        "<?php echo trans('january') ?>",
                        "<?php echo trans('february') ?>",
                        "<?php echo trans('march') ?>",
                        "<?php echo trans('april') ?>",
                        "<?php echo trans('may') ?>",
                        "<?php echo trans('june') ?>",
                        "<?php echo trans('july') ?>",
                        "<?php echo trans('august') ?>",
                        "<?php echo trans('september') ?>",
                        "<?php echo trans('october') ?>",
                        "<?php echo trans('november') ?>",
                        "<?php echo trans('december') ?>"
                    ]
                }
                
              }, function(start, end, label) {
                // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
              });
            });
        </script>
    <?php endif ?>

    

    <?php if (isset($page_title) && $page_title == 'Staff Holidays'): ?>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function () {

                var $datePicker = $("#holiday_picker");
                var base_url = $('#base_url').val();

                <?php $staff_holidays=get_by_id($this->session->userdata('id'),'staffs'); ?>
                var disabledDays = <?php echo $staff_holidays->holidays; ?>
                
               

                $.datepicker.regional ['en'] = {
                    clearText: 'Clear', 
                    clearStatus: '',
                    closeText: 'Close',
                    closeStatus: 'Close without modifying',
                    prevStatus: 'See previous month',
                    nextStatus: 'See next month',
                    currentText: 'Current',
                    currentStatus: 'See current month',
                    monthNames: ['<?php echo trans('january') ?>', '<?php echo trans('february') ?>', '<?php echo trans('march') ?>', '<?php echo trans('april') ?>', '<?php echo trans('may') ?>', '<?php echo trans('june') ?>',
                    '<?php echo trans('july') ?>', '<?php echo trans('august') ?>', '<?php echo trans('september') ?>', '<?php echo trans('october') ?>', '<?php echo trans('november') ?>', '<?php echo trans('december') ?>'],
                    monthNamesShort: ['<?php echo trans('january') ?>', '<?php echo trans('february') ?>', '<?php echo trans('march') ?>', '<?php echo trans('april') ?>', '<?php echo trans('may') ?>', '<?php echo trans('june') ?>',
                    '<?php echo trans('july') ?>', '<?php echo trans('august') ?>', '<?php echo trans('september') ?>', '<?php echo trans('october') ?>', '<?php echo trans('november') ?>', '<?php echo trans('december') ?>'],
                    monthStatus: 'See another month',
                    yearStatus: 'See another year',
                    weekHeader: 'Sm',
                    weekStatus: '',
                    dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                    dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                    dayNamesMin: ['<?php echo trans('su') ?>', '<?php echo trans('mo') ?>', '<?php echo trans('tu') ?>', '<?php echo trans('we') ?>', '<?php echo trans('th') ?>', '<?php echo trans('fr') ?>', '<?php echo trans('sa') ?>'],
                    dayStatus: 'Use DD as the first day of the week',
                    dateStatus: 'Choose the DD, MM of',
                    firstDay: 0,
                    initStatus: 'Choose date',
                    isRTL: false
                }; 

                $.datepicker.setDefaults($.datepicker.regional['en']);

                $datePicker.datepicker({
                    daysOfWeekDisabled: [0],
                    changeMonth: true,
                    changeYear: true,
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    showButtonPanel: true,
                    todayBtn: false,
                    dateFormat: 'yy-m-d',

                    onSelect: function(){
                        var date = $(this).val();
                        $('.booking_time').val('');

                        var url = base_url+'staff/add_holidays/'+date;
                        var post_data = {
                            'csrf_test_name' : csrf_token
                        };

                        $('#load_data').html('<span class="spinner-border spinner-border-sm"></span>');

                        $.ajax({
                            type: "POST",
                            url: url,
                            dataType: 'json',
                            data: post_data,
                            success: function(data) {
                                if (data.status == 1) {
                                    window.location.href = base_url+'staff/holidays?msg=success';
                                }
                            }
                        })

                    },


                    beforeShowDay: function(date) {
                        var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
                        for (i = 0; i < disabledDays.length; i++) {
                            if($.inArray(y + '-' + (m+1) + '-' + d,disabledDays) != -1) {
                                //return [false];
                                return [true, 'ui-state-actived', ''];
                            }
                        }
                        return [true];
                    }

                });
            });
        </script>
    <?php endif ?>




<!-- Event code -->


<?php if (isset($countdown) && $countdown == 'TRUE'): ?>
    
<script src="<?php echo base_url() ?>assets/front/libs/countup/jquery.counterup.min.js"></script>

<script>
    $(document).ready(function () {
        var end = $('#event_countdown_date').val();
        var end = new Date(end);

        //alert(end); return false;

        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;
        var timer;

        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {

                clearInterval(timer);
                document.getElementById('countdown').innerHTML = 'EXPIRED!';

                return;
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            // document.getElementById('countdown').innerHTML = days + 'days ';
            // document.getElementById('countdown').innerHTML += hours + 'hrs ';
            // document.getElementById('countdown').innerHTML += minutes + 'mins ';
            // document.getElementById('countdown').innerHTML += seconds + 'secs';


            document.getElementById('countdown').innerHTML =
                "<div>" +
                days +
                "<span>Days</span></div><div>" +
                hours +
                "<span>Hours</span></div><div>" +
                minutes +
                "<span>Minutes</span></div><div>" +
                seconds +
                "<span>Seconds</span></div>";
        }

        timer = setInterval(showRemaining, 1000);
    });
</script>

<script>
    $(document).ready(function () {
        var end = $('#ticket_countdown_date').val();
        var end = new Date(end);

        //alert(end); return false;

        var _second = 1000;
        var _minute = _second * 60;
        var _hour = _minute * 60;
        var _day = _hour * 24;
        var timer;

        function showRemaining() {
            var now = new Date();
            var distance = end - now;
            if (distance < 0) {

                clearInterval(timer);
                document.getElementById('countdown_ticket').innerHTML = 'EXPIRED!';

                return;
            }
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            document.getElementById('countdown_ticket').innerHTML = days + 'days ';
            document.getElementById('countdown_ticket').innerHTML += hours + 'hrs ';
            document.getElementById('countdown_ticket').innerHTML += minutes + 'mins ';
            document.getElementById('countdown_ticket').innerHTML += seconds + 'secs';


            
        }

        timer = setInterval(showRemaining, 1000);
    });
</script>
<?php endif ?>

<script type="text/javascript">
    $(document).ready(function () {
        $(".booking_btn").on('click', function() {
            $(".booking_details").hide();
            $(".booking_btn").hide();
            $(".booking_option").show();
            
        });
    });

    $(document).ready(function () {
        $(".event_step2_back_btn").on('click', function() {
            $(".back_to_events").show();
            $(".booking_details").hide();
            $(".booking_btn").hide();
            $(".booking_option").show();
            $(".event_booking_step_2").hide();
            
        });
    });



    $('#event_booking_form').on("submit", function() {
       var msg_processing = 'processing'; 

      $(".event_step2_btn").html('<span class="spinner-border spinner-border-sm"></span> &nbsp; '+msg_processing);

       
        $('.event_step2_btn').prop('disabled', true)
        $.post($(this).attr('action'), $(this).serialize(), function(json){
          if (json.st == 1) {
              $(".error").hide();
              $(".success").html('<i class="fa fa-check-circle"></i> '+json.msg);
              
              //checking if it is an iframe
              if (window.self !== window.top) { 
                window.parent.location.href = json.url;
              } else {
                window.location.href = json.url;
              }
          }else if (json.st == 0) {;
              $(".error").show().html('<i class="fa fa-exclamation-circle"></i> '+json.msg);
          }else if (json.st == 3) {
              $(".error").show().html('<i class="icon-exclamation"></i> '+json.error);
          }
          
          else if (json.st == 6) {
              $(".error").show().html('<i class="icon-exclamation"></i> '+json.msg);
          }
      },'json');
      return false;
    });


    $(".event_booking_terms_btn").on('click', function() {
        if ($(".event_booking_terms_btn").is(":checked")) {
            $('.event_step2_btn').prop('disabled', false);
        } else {
            $('.event_step2_btn').prop('disabled', true);
        }
    });


    $(document).on('change', ".ticket_input", function() {

        var event_id = $(this).val();
        if(event_id){

            $('.ticket_quantity').show();
        }   
        

        return false;
    });


    $(document).on('keyup change', ".quantity", function() {

        var quantity = $(this).val();
        var tickets_per_attendee = $('.tickets_per_attendee').val();

        if(quantity){
            $('.continue_btn').prop('disabled', false);
        }
        return false;
    });


    $(".event_click_new").on('click', function() {
        $('.event_is_customer_exist').val(0);
        $('.event_guest_hide').show();
    });

    $(".event_click_old").on('click', function() {
        $('.event_is_customer_exist').val(1);
    });

    $(".event_click_guest").on('click', function() {
        $('.event_is_customer_exist').val(2);
        $('.event_guest_hide').hide();
    });


    $(document).on('change', ".event_pay_info", function() {
        var infoVal = $(this).val();
        
        //alert(infoVal); return false;

        if (infoVal == '1') {
            $('.event_payments_area').show();
            $('.event_confirm_area').hide();
        } else {
            $('.event_payments_area').hide();
            $('.event_confirm_area').show();
        }
    });

</script>



<!-- event code -->


    


<!-- PWA -->
<?php if (settings()->enable_pwa == 1): ?>
    <?php include 'pwa_footer_js.php'; ?>
<?php endif; ?>
<!-- PWA -->

</body>


</html>