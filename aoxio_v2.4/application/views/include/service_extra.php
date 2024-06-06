

<div class="row <?php if (isset($service_extras) && !empty($service_extras[0])){echo "py-3";} ?>">
  
  <?php if (isset($service_extras) && !empty($service_extras[0])): ?>
    <div class="col-md-12 mb-1">
      <p class="mb-0 text-dark fs-15 font-weight-bold"><?php echo trans('service-extra') ?></p>
    </div>
  <?php endif ?>

  <?php $s=1; foreach ($service_extras as $service_extra): ?>
    <?php if (!empty($service_extra) && get_by_id($service_extra,'service_extra')->status != 2): ?>
        <div class="col-md-6 mb-4 pr-3" data-aos="fade-up" data-aos-delay="<?php echo $s*50 ?>">
            <input type="checkbox" class="service_extra_checkbox" id="inlineCheckboxg_<?php echo html_escape($s)  ?>" name="service_extra[]" value="<?php echo html_escape($service_extra) ?>">
            <label for="inlineCheckboxg_<?php echo html_escape($s)  ?>" class="service_extra_checkbox_label">
                <div class="px-3">
                    <span class="text-muted fs-13 fw-600 mr-2">
                      <?php if($company->curr_locate == 0){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                      <?php echo number_format(get_by_id($service_extra,'service_extra')->price, $company->num_format) ?>
                      <?php if($company->curr_locate == 1){echo get_currency_by_country($company->country)->currency_symbol;} ?>
                    </span>
                    <span class="text-muted fs-13 fw-600">
                      <i class="bi bi-clock"></i> <?php echo get_by_id($service_extra,'service_extra')->duration  ?> <?php echo trans(get_by_id($service_extra,'service_extra')->duration_type) ?>
                    </span>
                    <p class="fs-14 mb-0 mt-1 text-dark font-weight-bold"> <?php echo get_by_id($service_extra,'service_extra')->name  ?></p>
                </div>

            </label>
        </div>
    <?php endif ?>
  <?php $s++; endforeach; ?>
</div>