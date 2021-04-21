<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="row">
    <div class="col-sm-6">
        <label><?php echo ossn_print('ad:title'); ?> </label>
        <input type="text" name="title"/>

        <label><?php echo ossn_print('ad:site:url'); ?></label>
        <input type="text" name="siteurl"/>

        <label><?php echo ossn_print('ad:desc'); ?></label>
        <textarea name="description"></textarea>
        <div class="row">
            <div class="col-sm-8">
                <label><?php echo ossn_print('ad:photo'); ?></label>
                <input type="file" name="ossn_ads"/>
            </div>
            <div class="col-sm-4">
                <label><?php echo ossn_print('ad:iframe:height') ?></label>
                <input type="number" name="iframe_height" value="300">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <label><?php echo ossn_print('ad:html'); ?></label>
        <textarea name="htmleditor" style="display: none;"></textarea>
        <div id="htmleditor" style="height: 300px;"></div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
<script>
    var htmlEditor = ace.edit("htmleditor");
    htmlEditor.setTheme("ace/theme/monokai");
    htmlEditor.session.setMode("ace/mode/html");
    htmlEditor.getSession().setValue("<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>Document</title>\r\n</head>\r\n<body>\r\n\r\n</body>\r\n</html>");
    var htmlTextarea = $('textarea[name="htmleditor"]');
    $('form').submit(function(e) {
        htmlTextarea.val(htmlEditor.getSession().getValue());
    });
    $('input[type="file"]').on("change", function() {
        $('.ossn-ads-form').append("<input type=\"hidden\" name=\"file-submit\" value=\"file-submit\">");
        $('.ossn-ads-form').submit();
    });
</script>
<br/>
<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('add'); ?>"/>
