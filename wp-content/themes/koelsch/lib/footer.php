<?php
add_action('koelsch_footer', 'koelsch_footer');
function koelsch_footer(){

  global $community_context;
  global $page_settings;

  ob_start();?>
  <footer id="footer">
    <div class="container">
      <div class="footer-top">
        <div class="flex-row">
          <div class="col col-26">
            <div class="info-block">
              <img class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/divider.jpg" alt="image description">
              <?php if ($community_context->inCommunityContext()):?>
              <div class="logo-block">
                <?php echo get_community_logo($community_context->communityID);?>
              </div>
            <?php else:?>
              <div class="text-block">
                <p>We’re ladies and gentlemen serving ladies and gentlemen.</p>
              </div>
            <?php endif;?>
            </div>
          </div>
          <div class="col col-50 col-community">
            <?php $communityPageID = isset($page_settings[0]['find_community_page']) ? $page_settings[0]['find_community_page'] : false;?>
            <a class="community-link" href="<?php echo $communityPageID ? get_the_permalink($communityPageID) : '#';?>">Find a Community <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" alt="Find a community icon"></a>
          </div>
          <?php
                koelsch_resources_footer_menu();
                koelsch_living_types_menu();
          ?>
        </div>
      </div>
      <div class="contacts-block">
        <div class="flex-row">
          <div class="col">
            <ul class="contact-list decor-line">
              <?php $address = get_footer_address($community_context->communityID);
                    if($address):
              ?>
                <li>
                  <ion-icon name="location-outline"></ion-icon>
                  <?php echo $address;?>
                </li>
              <?php endif;
                    $footerPhone = get_footer_phone($community_context->communityID);
                    if ($footerPhone):
              ?>
                <li>
                  <ion-icon name="call-outline"></ion-icon>
                  <?php echo $footerPhone;?>
                </li>
              <?php endif;?>
            </ul>
          </div>
          <div class="col">
            <ul class="contact-list">
              <?php $careersPageID = isset($page_settings[0]['careers_page']) ? $page_settings[0]['careers_page'] : false;
                    if ($careersPageID){
                      ?>
                      <li>
                        <ion-icon name="people-circle"></ion-icon>
                        <a href="<?php echo get_the_permalink($careersPageID);?>">Careers At Koelsch</a>
                      </li>
                      <?php
                    }
              ?>
              <?php do_action('koelsch_contact_footer_link');?>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="flex-row">
          <div class="col">
            <strong class="logo">
              <a href="<?php echo site_url();?>">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="K/Koelsch Communities">
              </a>
            </strong>
            <span class="copyright">&copy; Copyright <?php echo date('Y');?> <a href="<?php echo site_url();?>">Koelsch Communities</a>. All Rights Reserved.</span>

              <?php wp_nav_menu(array(
                'theme_location'=>'privacy-menu',
                'menu_id'=>'privacy_menu',
                'menu_class'=>'add-menu',
                'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>',
                'container'=>'ul',
                'depth'=>1,
                'fallback_cb'=>'__return_false'
              ));?>
          </div>
          <div class="col">
            <?php do_action('koelsch_footer_site_attribution');?>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <?php echo ob_get_clean();
}

function get_footer_address($communityID){
  if ($communityID){
    $title = get_the_title($communityID);
    $street1 = get_post_meta($communityID, 'street', true);
    $street2 = get_post_meta($communityID, 'street_2', true);
    $city = get_post_meta($communityID, 'city', true);
    $state = get_post_meta($communityID, 'state', true);
    $zip = get_post_meta($communityID, 'zipcode', true);
  }else{
    $address = get_koelsch_setting('address');
    $address = is_array($address) ? $address[0] : false;
    $title = $address && isset($address['company_name']) ? $address['company_name'] : '';
    $street1 = $address && isset($address['street']) ? $address['street'] : '';
    $street2 = $address && isset($address['street_2']) ? $address['street_2'] : '';
    $city = $address && isset($address['city']) ? $address['city'] : '';
    $state = $address && isset($address['state']) ? $address['state'] : '';
    $zip = $address && isset($address['zipcode']) ? $address['zipcode'] : '';
  }

  $return = '<address>';
  $return .= $title.'<br>';
  $return .= $street1.'<br>';
  $return .= $street2 ? $street2.'<br>' : '';
  $return .= $city.', '.$state.' '.$zip;
  $return .= '</address>';

  return $return;
}

function get_footer_phone($communityID){
  if ($communityID){
    $phVal = get_post_meta($communityID, 'phone', true);
    $phone = $phVal ? sanitize_phone_number($phVal) : '';
    $phoneDisplay = $phVal ? sanitize_phone_number($phVal, true) : '';
  }else{
    $address = get_koelsch_setting('address');
    $phVal = $address && isset($address[0]['phone']) ? $address[0]['phone'] : '';
    $phone = $phVal ? sanitize_phone_number($phVal) : '';
    $phoneDisplay = $phVal ? sanitize_phone_number($phVal, true) : '';
  }
  return '<a href="tel:'.$phone.'">'.$phoneDisplay.'</a>';
}

add_action('koelsch_footer_site_attribution', 'koelsch_footer_site_attribution');
function koelsch_footer_site_attribution(){
  if (is_front_page() || is_community_home_page()){
    echo '<span class="by"><a target="_blank" href="https://tilladelsemarketingagency.com">Website by <span>Tilladelse</span><img src="'.get_stylesheet_directory_uri().'/assets/images/tilla-delse.png" alt="website created by Tilladelse"></a></span>';
  }

}

function koelsch_living_types_menu(){
  global $community_context;
  global $page_settings;
  $livingType = $community_context->getCurrentLivingTypes();
  $return = '';
  $menuItems = array();
  if ($livingType){
    $lts = isset($livingType['living_types']) ? $livingType['living_types'] : false;
    if ($lts){
      $pages = $page_settings ? $page_settings[0] : array();
      foreach ($lts as $type){
        $pageID = isset($pages[$type.'_page']) && $pages[$type.'_page'] ? $pages[$type.'_page'] : false;
        if ($pageID){
          $menuItems[get_the_title($pageID)] = get_the_permalink($pageID);
        }
      }
    }
    $return = $menuItems ? '<div class="col col-12 col-nav"><h4>Living Choices</h4><ul class="second-menu">' : '';
    foreach($menuItems as $title=>$url){
      $return .= '<li><a href="'.$url.'">'.$title.'</a></li>';
    }
    $return .= $menuItems ? '</ul></div>' : '';
  }
  echo $return;
}

function koelsch_resources_footer_menu(){
  //TODO: build out dynamic resources menu functionality
  global $community_context;
  $lt = $community_context->getCurrentLivingTypes();
  $menuID = isset($lt['resources_menu_id']) ? $lt['resources_menu_id'] : false;
  if ($menuID){?>
    <div class="col col-12 col-nav">
      <h4>Resources</h4>
      <?php
      wp_nav_menu(array(
              'menu'=> $menuID,
              'menu_id'=>'',
              'menu_class'=>'second-menu main-item',
              'container'=>false,
              'depth'=>1,
              // 'walker'=> new Koelsch_Walker_Nav_Menu,
              'fallback_cb'=>'__return_false'
            ));
    ?></div><?php
  }
}
?>
