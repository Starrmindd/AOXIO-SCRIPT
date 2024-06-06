
<?php $x=1; foreach ($inputs as $input): ?>

    <?php if($input->input_type == 'text'): ?>
        <div class="form-group">
            <label><?php echo $input->input_title ?> <span class="text-danger"><?php if($input->is_required == 1){echo '*';} ?></span></label>
            <input type="<?php echo html_escape($input->input_type) ?>" class="form-control <?php if($input->is_required == 1){echo 'check_require';} ?>"  name="input_name[]" value="">
        </div>
    <?php endif; ?>

    <?php if($input->input_type == 'textarea'): ?>
        <div class="form-group">
            <label><?php echo $input->input_title ?><span class="text-danger"><?php if($input->is_required == 1){echo '*';} ?></span> </label>
            
                <textarea class="form-control <?php if($input->is_required == 1){echo 'check_require';} ?>" name="input_name[]" <?php if($input->is_required == 1){echo 'required';} ?>></textarea>
            
        </div>
    <?php endif; ?>
    <input type="hidden" class="input" value="<?php echo html_escape($input->input_title) ?>" name="input_title[]">
<?php $x++; endforeach ?>