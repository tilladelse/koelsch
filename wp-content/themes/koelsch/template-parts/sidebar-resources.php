<?php
/**
 *
 * Resources Sidebar
 *
 * @package Koelsch
 * @author  Tilladelse
 * @license GPL-2.0-or-later
 * @link    https://www.tilladelse.com/
 */

 $backTitle = 'All Resources';
 $resID = get_koelsch_setting('resources_page');
 $resLink = $backLink = get_the_permalink($resID);
 $taxonomy = 'resource-category';
?>
<aside id="sidebar">
  <div class="aside-topbar">
    <div id="search-container">
      <!-- Clone search block -->
    </div>
    <h3><a href="<?php echo $resLink;?>">Resources</h3>
    <?php
    if (is_tax()){
      $term = get_queried_object();
      if ($term->parent > 0){
        $termParent = get_term($term->parent);
        $backTitle =$termParent->name;
        $backLink = get_term_link($term->parent);
      }
      $terms = get_taxonomy_terms($taxonomy, $term->term_id);
      $currentObj = (object) array('name'=>$term->name,'children'=>$terms);
      $groups = array($term->term_id=>$currentObj);
    }
    else if(is_singular()){
      global $post;
      $t = wp_get_post_terms($post->ID, $taxonomy);
      $term = $t[0];
      $backTitle =$term->name;
      $backLink = get_term_link($term->term_id);
      $groups = array();
    }else{
      $groups = get_taxonomy_hierarchy($taxonomy);
    }
    ?>
    <a class="btn-back" href="<?php echo $backLink;?>">
      <ion-icon name="arrow-back-sharp"></ion-icon>
      <?php echo $backTitle;?>
    </a>
    <div id="breadcrumbs-container">
      <!-- Clone breadcrumbs -->
    </div>
  </div>
  <?php if ($groups): ?>
  <div class="aside-holder">
    <a class="aside-opener" href="#">Browse Resource Topics<ion-icon name="chevron-down"></ion-icon></a>
    <div class="aside-slide">
      <ul class="aside-menu">
        <?php $i = 0; foreach($groups as $list)://echo '<pre>';var_dump($list);echo '</pre>';?>
        <li class="active">
          <a class="menu-opener" href="#"><?php echo $list->name;?>
          <ion-icon name="chevron-down"></ion-icon></a>
          <div class="menu-slide">
            <ul>
              <?php
              if (isset($list->children)){
                foreach ($list->children as $item){
                  echo '<li><a href="'.get_term_link($item->term_id).'">'.$item->name.'</a></li>';
                }
              }?>
            </ul>
          </div>
        </li>
      <?php endforeach;?>
      </ul>
    </div>
  </div>
  <?php endif;?>
</aside>
