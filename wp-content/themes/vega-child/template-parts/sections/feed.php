<?php
use Includes\Modules\KMAFacebook\FacebookController;

$vega_wp_frontpage_latest_posts = vega_wp_get_option('vega_wp_frontpage_latest_posts');

if($vega_wp_frontpage_latest_posts == 'Y') {

$vega_wp_frontpage_latest_posts_n = vega_wp_get_option('vega_wp_frontpage_latest_posts_n');
$vega_wp_frontpage_latest_posts_heading = vega_wp_get_option('vega_wp_frontpage_latest_posts_heading');
$vega_wp_frontpage_latest_posts_section_id = vega_wp_get_option('vega_wp_frontpage_latest_posts_section_id');

$class = vega_wp_get_col_class($vega_wp_frontpage_latest_posts_n);
$classes = explode('|', $class);
?>
<!-- ========== Latest Posts ========== -->
<div class="section frontpage-recent-posts" id="<?php echo esc_attr($vega_wp_frontpage_latest_posts_section_id) ?>" <?php  vega_wp_section_bg_color('vega_wp_frontpage_latest_posts_bg_color'); ?>>
    <div class="container">

        <?php if($vega_wp_frontpage_latest_posts_heading != '') { ?>
            <h2 class="block-title wow bounceIn"><?php echo esc_html($vega_wp_frontpage_latest_posts_heading) ?></h2>
        <?php } ?>

        <div class="row">
        <?php
            global $post; $i = 0;
            $facebook = new FacebookController();
            $feed = $facebook->getFbPosts(3);
            if(count($feed) > 0){
                foreach( $feed as $result ){ ?>
                    <div class="col-4 <?php echo $classes[$i]; $i++; ?>">
                        <?php include(locate_template('template-parts/partials/mini-article.php')); ?>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <p style="text-align: center;">This content is currently unavailable.</p>
            <?php } ?>
            <?php wp_reset_postdata();?>
        </div>

    </div>
    <p class="text-center"><a class="btn btn-primary-custom btn-margin-bottom" href="/our-work/">View Our Work</a></p>
</div>
<!-- ========== /Latest Posts ========== -->
<?php } ?>