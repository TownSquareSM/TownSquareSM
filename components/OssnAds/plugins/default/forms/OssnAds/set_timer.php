<div class="row">
    <div class="col-sm-4">
        <label><?php echo ossn_print('ad:timer'); ?> </label>
        <input type="number" name="timer" min="30" max="120" value="<?php echo $params['entity']->description; ?>">
    </div>
    <div class="col-sm-8">
        <p><?php echo ossn_print('ad:timer:info'); ?></p>
    </div>
</div>
<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('ad:set-timer:save'); ?>"/>
