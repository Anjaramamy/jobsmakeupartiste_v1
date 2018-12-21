<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="mkdf-tags-holder">
    <div class="mkdf-tags">
        <?php the_tags('', ', ', ''); ?>
    </div>
</div>
<?php } ?>