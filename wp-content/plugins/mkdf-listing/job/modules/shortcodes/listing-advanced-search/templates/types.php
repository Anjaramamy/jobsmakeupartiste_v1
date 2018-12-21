<?php
use MikadoListing\Lib\Front;

$types_array = mkdf_listing_job_get_listing_types();
$object = new Front\ListingTypeFieldCreator('all');

?>

<div class="mkdf-ls-adv-search-type-checkboxes clearfix">
    <?php $object->getSearchTypes(); ?>
</div>