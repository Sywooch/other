<div class="box box-brand-model">
    <div class="box-heading"><?php echo $heading_title; ?></div>
    <div class="box-content">
        <div class="brand">
            <?php echo $entry_brand; ?><br>
            <select>
                <option value=""><?=$text_select?></option>
                <?php foreach ($manufacturers as $manufacturer) { ?>
                    <option value="<?php echo $manufacturer['manufacturer_id']; ?>"<?php if ($manufacturer_id == $manufacturer['manufacturer_id']) { ?> selected="selected"<?php } ?>><?php echo $manufacturer['name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="model">
            <?php echo $entry_model; ?><br>
            <select>
                <option value=""><?=$text_select?></option>
                <?php foreach ($models as $model) { ?>
                    <option value="<?php echo urlencode($model); ?>"<?php if ($_model == $model) { ?> selected="selected"<?php } ?>><?php echo $model; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.brand select').on('change', function(){
            $.ajax({
                url: 'index.php?route=module/brand_model/models',
                dataType: 'json',
                data: {manufacturer_id: $(this).val()},
                beforeSend: function() {
                    $('.brand select').attr('disabled', true);
                },
                complete: function() {
                    $('.brand select').attr('disabled', false);
                },
                success: function(data) {
                    if (data['models']) {
                        $('.model select').html(data['models']);
                    }
                }
            });
        });

        $('.model select').live('change', function(){
            if ($('.brand select').val() && $(this).val()) {
                var url = '<?php echo $this->url->link('module/brand_model/search',''); ?>&filter_manufacturer_id='+$('.brand select').val()+'&filter_model='+$(this).val();
                window.location.href = url;
            }
        })
    });
</script>
