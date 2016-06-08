<?php
/**
 * Detailed download output
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly
?>
<div class="download-box col-sm-4 col-xs-6">
    
    <?php $dlm_download->the_short_description(); ?>
        <div>
            <a class="" title="<?php if ( $dlm_download->has_version_number() ) {printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_the_version_number() );} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
                <div class="frame">
                    <?php $dlm_download->the_image(); ?>
                </div>
                
                <h5><?php $dlm_download->the_title(); ?></h5>
                Télécharger (<?php $dlm_download->the_filesize(); ?>)
            </a>
        </div>
</div>


