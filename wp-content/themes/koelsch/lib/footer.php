<?php
add_action('koelsch_footer', 'koelsch_footer');
function koelsch_footer(){

  global $community_context;

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
            <?php
            $pageSettings = get_koelsch_setting('page_settings');
            $communityPageID = isset($pageSettings[0]['find_community_page']) ? $pageSettings[0]['find_community_page'] : false;?>
            <a class="community-link" href="<?php echo $communityPageID ? get_the_permalink($communityPageID) : '#';?>">Find a Community <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" alt="Find a community icon"></a>
          </div>
          <div class="col col-12 col-nav">
            <h4>Resources</h4>
            <ul class="second-menu main-item">
              <li><a href="#">All Resources</a></li>
              <li><a href="#">Cost Comparision</a></li>
              <li><a href="#">Dealing With Guilt</a></li>
              <li><a href="#">Impact Of Loneliness on Health</a></li>
            </ul>
            <ul class="second-menu community-item">
              <li><a href="#">IL Resources</a></li>
              <li><a href="#">Cost Comparision</a></li>
              <li><a href="#">IL Focused Resource Article</a></li>
            </ul>
          </div>
          <div class="col col-12 col-nav">
            <h4>Living Choices</h4>
            <ul class="second-menu main-item">
              <li><a href="#">Independent Living</a></li>
              <li><a href="#">Assisted Living</a></li>
              <li><a href="#">Memory Care</a></li>
            </ul>
            <ul class="second-menu community-item">
              <li><a href="#">Independent Living</a></li>
            </ul>
          </div>
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
              <li>
                <ion-icon name="people-circle"></ion-icon>
                <a href="#">Careers At Koelsch</a>
              </li>
              <li>
                <ion-icon name="chatbox-outline"></ion-icon>
                <a href="#">Contact</a>
              </li>
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
            <span class="copyright">&copy; Copyright 2021 <a href="<?php echo site_url();?>">Koelsch Communities</a>. All Rights Reserved.</span>
            <ul class="add-menu">
              <li><a href="#">Privacy Policy</a></li>
            </ul>
          </div>
          <div class="col">
            <span class="by">Website by <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tilla-delse.png" alt="Tilla delse"></a></span>
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
?>
