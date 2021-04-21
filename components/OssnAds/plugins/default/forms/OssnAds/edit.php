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
        <input type="text" name="title" value="<?php echo $params['entity']->title;?>"/>

        <label><?php echo ossn_print('ad:site:url'); ?></label>
        <input type="text" name="siteurl" value="<?php echo $params['entity']->site_url;?>"/>

        <label><?php echo ossn_print('ad:desc'); ?></label>
        <textarea name="description"><?php echo $params['entity']->description;?></textarea>
        <div class="row">
            <div class="col-sm-8">
                <label><?php echo ossn_print('ad:photo'); ?></label>
                <input type="file" name="ossn_ads"/>
                <div class="row">
                <div class="col-sm-8">
                    <input id="imageurl" type="text" value="<?php echo ossn_ads_image_url($params['entity']->guid); ?>" readonly="readonly">
                </div>
                <div class="col-sm-4">
                    <span class="btn btn-info" onclick="copyToClipboard('#imageurl')" style="margin-left: -50px;">Copy image link!</span>
                </div>
                </div>
                <input type="hidden" name="entity" value="<?php echo $params['entity']->guid;?>" />
                <div class="ossn-ad-image" style="background:url('<?php echo ossn_ads_image_url($params['entity']->guid);?>') no-repeat;background-size: contain;"></div>
            </div>
            <div class="col-sm-4">
                <label><?php echo ossn_print('ad:iframe:height') ?></label>
                <input type="number" name="iframe_height" value="<?php echo $params['entity']->iframe_height; ?>">
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
    var htmlTextarea = $('textarea[name="htmleditor"]');
    htmlEditor.getSession().setValue('<?php echo html_entity_decode(str_replace("\r\n", "\\r\\n", str_replace("\t", "\\t", $params['entity']->ad_html))); ?>');
    $('form').submit(function(e) {
        htmlTextarea.val(htmlEditor.getSession().getValue());
    });
    $('input[type="file"]').on("change", function(e) {
        $('form.ossn-ads-form').append($("<input type=\"hidden\" name=\"file-submit\" value=\"file-submit\">"));
        $('form.ossn-ads-form').submit();
    });
    function copyToClipboard(element) {
        var $temp = $("<input>");
        console.log("hallo");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
<br/>
<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('save'); ?>"/>
