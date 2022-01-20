<?php
    /*if( !isset( $lessons ) || ! !isset( $library ) ):
        return;
    endif;*/
?>

<div class="lesson-selector">
    <div class="lesson-selector__column lesson-selector__column--lessons">
        <div class="lesson-selector__title">
            <h4><?php echo esc_attr__( 'Course' , LMSCX_DOMAIN ); ?></h4>
        </div>
        <div class="lesson-selector__content">
            <?php print_r( $lessons ); ?>
        </div>
    </div>
    <div class="lesson-selector__column lesson-selector__column--library">
        <div class="lesson-selector__title">
            <h4><?php echo esc_attr__( 'Lesson Library' , LMSCX_DOMAIN ); ?></h4>
        </div>
        <div class="lesson-selector__content">
            <?php print_r( $library ); ?>
        </div>
    </div>
</div>