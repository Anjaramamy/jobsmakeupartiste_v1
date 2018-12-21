<?php
use MikadoResume\Lib\Front;

$types_array = mkdf_listing_resume_get_resume_types();
$object = new Front\ResumeTypeFieldCreator('all');

?>

<div class="mkdf-rs-adv-search-type-checkboxes clearfix">
    <?php $object->getSearchTypes(); ?>
</div>