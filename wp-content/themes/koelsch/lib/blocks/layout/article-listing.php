<?php
 $article = get_field( 'resource_article' );
 $format = get_field( 'format' );
 // echo '<pre>';var_dump($article);echo '</pre>';
 if (is_array($article)){
   $article = $article[0];
   $featImgID = get_post_thumbnail_id($article->ID);
   if ($format == 'horizontal'){
     $length = '20';
     $featImgSrc = $featImgID ? get_the_post_thumbnail_url($article->ID, 'resource-listing') : false;
     $featImgSrc2X = $featImgID ? get_the_post_thumbnail_url($article->ID, 'resource-listing-2x') : false;
   }else{
     $length = '50';
     $featImgSrc = $featImgID ? get_the_post_thumbnail_url($article->ID, 'resource-listing-horiz') : false;
     $featImgSrc2X = $featImgID ? get_the_post_thumbnail_url($article->ID, 'resource-listing-horiz-2x') : false;
   }
   $featImgSrcset = $featImgSrc ? $featImgSrc.', '.$featImgSrc2X.' 2x' : '';
   ?>
   <article class="<?php echo $format == 'horizontal' ? 'card-horizontal': 'card';?>">
     <a href="<?php echo get_the_permalink($article->ID);?>" class="<?php echo $format == 'horizontal' ? 'img-box': 'card-img';?>">
       <?php if ($featImgID):?>
         <img src="<?php echo $featImgSrc;?>" srcset="<?php echo $featImgSrcset; ?>" alt="<?php echo $article->post_title;?> listing image">
       <?php endif;?>
     </a>
     <?php echo $format == 'horizontal' ? '<div class="text-block">' : '';?>
     <h4><a href="<?php echo get_the_permalink($article->ID);?>"><?php echo $article->post_title;?></a></h4>
     <?php $excerpt = get_resource_excerpt($length, $article->ID);?>
     <p><?php echo $excerpt;?> <a class="btn-more" href="<?php echo get_the_permalink($article->ID);?>">Read</a></p>
     <?php echo $format == 'horizontal' ? '</div>' : '';?>
     <?php if ($format != 'horizontal') display_resource_author($article->ID);?>
   </article>
<?php } ?>
