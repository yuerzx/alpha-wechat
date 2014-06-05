<?php
/**
 * Listing page for property
 * Created by PhpStorm.
 * User: xiao
 * Date: 12/05/2014
 * Time: 10:37 PM
 */

get_header();

?>
<link href="<?= get_template_directory_uri() ?>/framework/royalslider/royalslider.css" rel="stylesheet">
<link href="<?= get_template_directory_uri() ?>/framework/royalslider/skins/minimal-white/rs-default.css" rel="stylesheet">
<!-- slider css -->
<style>
    .visibleNearby {
        width: 100%;
        background: #ffffff;
        color: #151515;
        padding-top: 25px;
    }
    .visibleNearby .rsGCaption {
        font-size: 16px;
        line-height: 18px;
        padding: 12px 0 16px;
        background: #ffffff;
        width: 100%;
        position: static;
        float: left;
        left: auto;
        bottom: auto;
        text-align: center;
    }
    .visibleNearby .rsGCaption span {
        display: block;
        clear: both;
        color: #bbb;
        font-size: 14px;
        line-height: 22px;
    }


    /* Scaling transforms */
    .visibleNearby .rsSlide img {
        opacity: 0.45;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;

        -webkit-transform: scale(0.9);
        -moz-transform: scale(0.9);
        -ms-transform: scale(0.9);
        -o-transform: scale(0.9);
        transform: scale(0.9);
    }
    .visibleNearby .rsActiveSlide img {
        opacity: 1;
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }

    /* Non-linear resizing on smaller screens */
    @media screen and (min-width: 0px) and (max-width: 900px) {
        #gallery-1 {
            padding: 12px 0 12px;
        }
        #gallery-1 .rsOverflow,
        .royalSlider#gallery-1 {
            height: 500px !important;
        }
    }
    @media screen and (min-width: 0px) and (max-width: 500px) {
        #gallery-1 .rsOverflow,
        .royalSlider#gallery-1 {
            height: 400px !important;
        }
        .rsImg{
            margin-top: 32px !important;
        }
        .rsVisibleNearbyWrap{
            height: 320px !important;
        }
        .rsGCaption span{
            padding: 5px;
        }
    }

</style>

<style>
    #page-navigation { display: none; }
</style>


<div style="height: 100%;">
<div id="gallery-1" class="royalSlider rsDefault visibleNearby">
    <?php
    while ( have_posts() ) : the_post();
    ?>
        <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(),'large');?>
        <b class="rsImg" href="<?=$large_image_url[0];?>" data-rsw="500" data-rsh="600"><?= the_title();?><span><?php echo mb_strimwidth(strip_tags(get_the_content()),0,140).'...'; ?></a></span></b>

    <?php endwhile;?>
</div></div>

<script>
    // Important note! If you're adding CSS3 transition to slides, fadeInLoadedSlide should be disabled to avoid fade-conflicts.
    jQuery(document).ready(function($) {
        var si = $('#gallery-1').royalSlider({
            addActiveClass: true,
            arrowsNav: false,
            controlNavigation: 'none',
            autoScaleSlider: true,
            autoScaleSliderWidth: 1000,
            autoScaleSliderHeight: 400,
            loop: true,
            fadeinLoadedSlide: false,
            globalCaption: true,
            keyboardNavEnabled: true,
            globalCaptionInside: false,

            visibleNearby: {
                enabled: true,
                centerArea: 0.7,
                center: true,
                breakpoint: 650,
                breakpointCenterArea: 0.64,
                navigateByCenterClick: true
            }
        }).data('royalSlider');

        // link to fifth slide from slider description.
        $('.rsGCaption').click(function(e) {
            window.location.href = "http://stackoverflow.com";
            return false;
        });
    });
</script>

<script src="<?= get_template_directory_uri() ?>/framework/royalslider/jquery.royalslider.min.js"></script>
</div>
<?php get_footer();?>
</body>
</html>

