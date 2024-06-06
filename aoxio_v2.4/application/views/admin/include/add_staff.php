<div class="form-group staff_area" style="display: <?php if (isset($page_title) && $page_title != "Edit"){echo "none";} ?>;">
  <label><?php echo trans('staffs') ?> <span class="text-danger"><?php if($this->business->enable_staff == 1){echo "*";} ?></span></label>
  <select class="form-control select2s staffs" name="staff_id" <?php if($this->business->enable_staff == 1){echo "required";} ?>>
      <option value=""><?php echo trans('staffs') ?></option>
      <?php foreach ($staffs as $staff): ?>
        <option value="<?php echo html_escape($staff->id) ?>"><?php echo html_escape($staff->name) ?></option>
      <?php endforeach ?>                 
  </select>
</div>