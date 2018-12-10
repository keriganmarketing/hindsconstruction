<?php ?>
<div class="section">
    <div class="container">
        <?php if(is_front_page()){ ?><h2 class="block-title">Contact Us</h2><?php } ?>
        <div class="row">
            <div class="col-md-7">
                <h3>Service Area</h3>
                <img src="/wp-content/themes/vega-child/images/areas-we-serve-2.png" class="img-responsive" >
            </div>
            <div class="recent-entry col-md-5">
                <h3>Email</h3>
                <?php echo do_shortcode('[contact-form-7 id="186" title="Contact"]'); ?>
            </div>
        </div>
    </div>
</div>
