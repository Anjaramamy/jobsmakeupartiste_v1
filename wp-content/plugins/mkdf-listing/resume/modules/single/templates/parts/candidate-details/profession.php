<?php

$id = get_the_ID();
$item_profession = get_post_meta($id, '_candidate_title', true);

?>

<div class="mkdf-rs-item-profession">
    <h6 class="mkdf-rs-item-profession-inner">
        <?php

        if(!empty($item_profession)) {
            echo wp_kses_post($item_profession);
        }

        ?>
    </h6>

</div>