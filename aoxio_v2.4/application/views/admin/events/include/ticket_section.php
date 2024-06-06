
<div class="main_itemm">
  <div class="bg-light mb-4 p-4 ticket_area">
    <div class="form-group">
      <label><?php echo trans('ticket-name') ?> <span class="text-danger">*</span></label>
      <input type="text" class="form-control" required name="ticket_name[]" value="<?php if(isset($event[0]['name'])){echo html_escape($event[0]['name']);} ?>" >
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo trans('price') ?> <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="number" class="form-control" name="price[]" value="<?php if(isset($service[0]['price'])){echo html_escape($service[0]['price']);} ?>" required>
            <div class="input-group-append">
              <span class="input-group-text"><?php echo html_escape($this->business->currency_symbol) ?></span>
            </div>
          </div>
          <p class="text-muted small pt-2"><i class="fas fa-info-circle"></i> <?php echo trans('set-0-for-free') ?></p>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label><?php echo trans('limit') ?></label>
          <input type="number" placeholder="" class="form-control" name="limit[]" value="<?php if(isset($event[0]['limit'])){echo html_escape($event[0]['limit']);} ?>" >
        </div>
      </div>

    </div>
    
        
    <div class="form-group d-none">
        <label><?php echo trans('sales-start') ?> <span class="text-danger">*</span></label>
        <div class="input-group">
        <input type="text" name="sales_start[]" class="form-control datepicker" required autocomplete="off" value="<?php if (isset($event[0]['sales_start'])){echo html_escape($event[0]['sales_start']);} ?>">
        <span class="input-group-append">
            <button type="button" class="btn btn-default"><i class="fas fa-calendar-alt"></i></button>
        </span>
        </div>
    </div>

    <div class="form-group d-none">
        <label><?php echo trans('sales-end') ?> <span class="text-danger">*</span></label>
        <div class="input-group">
        <input type="text" name="sales_end[]" class="form-control datepicker" required  autocomplete="off" value="<?php if (isset($event[0]['sales_end'])){echo html_escape($event[0]['sales_end']);} ?>">
        <span class="input-group-append">
            <button type="button" class="btn btn-default"><i class="fas fa-calendar-alt"></i></button>
        </span>
        </div>
    </div>

    <div class="form-group">
      <label><?php echo trans('ticket-per-attendee') ?></label>
      <input type="number" placeholder="" class="form-control" name="tickets_per_attendee[]" value="<?php if(isset($event[0]['tickets_per_attendee'])){echo html_escape($event[0]['tickets_per_attendee']);} ?>" >
    </div>

     <div class="form-group">
      <label><?php echo trans('details') ?></label>
      <textarea id="summernote" class="form-control" rows="4" name="ticket_details[]"><?php if(isset($event[0]['details'])){echo html_escape($event[0]['details']);} ?></textarea>
    </div>


    <?php if($page_title == 'Edit'): ?>
      <div class="form-group text-right">
        <a href="#" class="cancel_ticket text-outline-danger pull-right"><i class="bi bi-x-circle-fill"></i>  <?php echo trans('delete') ?></a>
      </div>
    <?php else: ?>
      <div class="form-group text-danger cancel_ticket pl-0 text-right">
        <a href="javascript:void(0);" class="btn btn-outline-danger cancel_ticket pull-right"><i class="bi bi-x-circle-fill"></i> <?php echo trans('delete') ?></a>
      </div>
    <?php endif; ?>

    
  </div>
</div>
