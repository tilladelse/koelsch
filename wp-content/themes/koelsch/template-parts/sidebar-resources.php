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
?>
<aside id="sidebar">
  <div class="aside-topbar">
    <div id="search-container">
      <!-- Clone search block -->
    </div>
    <?php
    $resID = get_koelsch_setting('resources_page');
    $resLink = get_the_permalink($resID);?>
    <h3><a href="<?php echo $resLink;?>">Resources</h3>
    <?php $term = get_queried_object();
    if ($term->parent > 0){
      $termParent = get_term($term->parent);
      $backTitle =$termParent->name;
      $backLink = get_term_link($term->parent);
    }else{
      $backTitle = 'All Resources';
      $resID = get_koelsch_setting('resources_page');
      $backLink = get_the_permalink($resID);
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
  <div class="aside-holder">
    <a class="aside-opener" href="#">Browse Resource Topics<ion-icon name="chevron-down"></ion-icon></a>
    <?php
    $taxonomy = array('resource-category');
    $list = get_terms($taxonomy, array(
      'order_by'=>'name',
      'order'=>'ASC',
      'depth'=>1,
      'parent'=>$term->term_id,
      'hide_empty'=>false,
      'hierarchical' => true,
    ));
    // var_dump($terms);
    // var_dump($list);
    if ($list): ?>
    <div class="aside-slide">
      <ul class="aside-menu">
        <li class="active">
          <a class="menu-opener" href="#"><?php echo $term->name;?>
          <ion-icon name="chevron-down"></ion-icon></a>
          <div class="menu-slide">
            <ul>
              <?php foreach ($list as $item){
                echo '<li><a href="'.get_term_link($item->term_id).'">'.$item->name.'</a></li>';
              }?>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  <?php endif;?>
  </div>
</aside>
