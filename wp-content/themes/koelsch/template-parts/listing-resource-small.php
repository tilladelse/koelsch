
<?php global $post;?>
<div class="col">
  <article class="card-horizontal">
    <div class="img-box">
      <?php $featImgID = get_post_thumbnail_id();
      $featImgSrc = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-listing-sm') : false;
      $featImgSrc2X = $featImgID ? get_the_post_thumbnail_url(get_the_id(), 'resource-listing-sm-2x') : false;
      $featImgSrcset = $featImgSrc ? $featImgSrc.', '.$featImgSrc2X.' 2x' : '';
      if ($featImgID){?>
        <img src="<?php echo $featImgSrc;?>" srcset="<?php echo $featImgSrcset;?>" alt="<?php the_title();?> image">
      <?php }?>
    </div>
    <div class="text-block">
      <h4><a href="#"><?php the_title();?></a></h4>
      <p><?php echo get_resource_excerpt(30);?></p>
      <a class="btn-more" href="<?php echo get_the_permalink();?>">Read</a>
    </div>
  </article>
</div>
