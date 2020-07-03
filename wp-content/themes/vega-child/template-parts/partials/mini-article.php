<?php

$dateposted = human_time_diff(time(),strtotime($result->post_date)) . ' ago';
$content  = wp_trim_words($result->post_date, 17, '... <a href="#" >read more.</a>');
$photoUrl = $result->full_image_url != null ? $result->full_image_url : 'http://hindsconstruction.dev/wp-content/uploads/2018/01/gulfaire-home-2.jpg';

$vega_wp_blog_feed_meta = vega_wp_get_option('vega_wp_blog_feed_meta');
if($vega_wp_blog_feed_meta == 'Y') {
    $vega_wp_blog_feed_meta_author = vega_wp_get_option('vega_wp_blog_feed_meta_author');
    $vega_wp_blog_feed_meta_category = vega_wp_get_option('vega_wp_blog_feed_meta_category');
    $vega_wp_blog_feed_meta_date = vega_wp_get_option('vega_wp_blog_feed_meta_date');
}
$vega_wp_blog_feed_buttons = vega_wp_get_option('vega_wp_blog_feed_buttons');
global $key;


?>
<div class="post-grid recent-entry" id="recent-post-<?php the_ID(); ?>">
    <div class="recent-entry-image image">
        <?php if($result->status_type != 'added_video') { ?>
        <div class="embed-responsive embed-responsive-4by3 align-items-center">
            <a target="_blank" href="<?php echo $result->post_link; ?>" target="_blank">
                <img src="<?php echo $photoUrl; ?>" alt="<?php echo $content; ?>" class="embed-responsive-item" >
            </a>
        </div>
        <?php } else { ?>
        <div class="embed-responsive embed-responsive-4by3">
            <iframe
                    src="<?php echo $result->link ?>"
                    style="border:none;overflow:hidden"
                    scrolling="no"
                    frameborder="0"
                    allowTransparency="true"
                    allowFullScreen="true"
                    class="embed-responsive-item"
                    width="100%"
                    height="170">

            </iframe>
        </div>
        <?php } ?>

    </div>

    <div class="recent-entry-content">
        <?php echo $content; ?>
    </div>

    <?php if($vega_wp_blog_feed_meta == 'Y') { $temp = array(); $str = ''; ?>
        <!-- Post Meta -->
        <div class="recent-entry-meta">
            <?= ($dateposted!='' ? '<p class="time-posted">posted '.$dateposted.'</p>' : null); ?>
        </div>
        <!-- /Post Meta -->
    <?php } ?>

    <!-- Post Buttons -->
    <div class="recent-entry-buttons">
        <a target="_blank" href="<?php echo $result->post_link; ?>" class="btn btn-default btn-readmore">Read more</a>
    </div>
    <!-- /Post Buttons -->

</div>