

<div class="mb-2"><?php echo trans('service-extra') ?></div>
<?php if(empty($service_extras)): ?>
  <input type="text" class="form-control"> value="<?php echo trans('no-data-found') ?>">
<?php else: ?>
  <?php foreach ($service_extras as $service_extra): ?>
    <div class="form-check mb-2">

      <?php 

        if(!empty($appointment_id)){
          foreach ($booked_extras as $booked_extra) {
              if ($service_extra == $booked_extra) {
                $checked = 'checked';
                break;
              }else{
                $checked = '';
              }
          }
        }
       ?>
       
      <input class="form-check-input" name="service_extra[]" type="checkbox" value="<?php echo html_escape($service_extra) ?>" id="flexCheckDefault_<?php echo html_escape($service_extra) ?>" <?php echo $checked ?>>
      <label class="form-check-label" for="flexCheckDefault_<?php echo html_escape($service_extra) ?>">
        <?php echo get_by_id($service_extra,'service_extra')->name ?> - <?php echo get_by_id($service_extra,'service_extra')->duration.' '.trans(get_by_id($service_extra,'service_extra')->duration_type); ?> - <?php if($this->business->curr_locate == 0){echo $this->business->currency_symbol;} ?>
        <?php echo number_format(get_by_id($service_extra,'service_extra')->price, $this->business->num_format) ?>
        <?php if($this->business->curr_locate == 1){echo $this->business->currency_symbol;} ?>
      </label>
    </div>
  <?php endforeach ; ?>
<?php endif; ?>
<br>



          
