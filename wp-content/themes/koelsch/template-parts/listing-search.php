<?php
global $post;
$taxonomy = 'resource-category';
$t = wp_get_post_terms($post->ID, $taxonomy);
$term = $t ? $t[0] : null;
?>
<div class="col">
  <article class="card">
    <?php $featImgID = get_post_thumbnail_id();
    $featImgSrc = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-listing') : false;
    $featImgSrc2X = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-listing-2x') : false;
    $featImgSrcset = $featImgSrc ? $featImgSrc.', '.$featImgSrc2X.' 2x' : '';?>
    <a href="<?php echo get_the_permalink();?>" class="card-img">
      <?php if ($featImgID):?>
        <img src="<?php echo $featImgSrc;?>" srcset="<?php echo $featImgSrcset; ?>" alt="<?php the_title();?> listing image">
      <?php endif;?>
    </a>
    <h4><a href="#"><?php the_title();?></a></h4>
    <p><?php echo get_resource_excerpt();?><a class="btn-more" href="<?php echo get_the_permalink();?>">Read</a></p>
    <?php display_resource_author();?>
  </article>
</div>
