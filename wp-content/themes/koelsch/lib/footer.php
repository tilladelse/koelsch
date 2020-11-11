<?php
add_action('koelsch_footer', 'koelsch_footer');
function koelsch_footer(){
  ob_start();?>
  <footer id="footer">
    <div class="container">
      <div class="footer-top">
        <div class="flex-row">
          <div class="col col-26">
            <div class="info-block">
              <img class="divider" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/divider.jpg" alt="image description">
              <div class="text-block main-item">
                <p>We’re ladies and gentlemen serving ladies and gentlemen.</p>
              </div>
              <div class="logo-block community-item">
                <a href="#">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/the-park.png" alt="The Park at laguna springs">
                </a>
              </div>
            </div>
          </div>
          <div class="col col-50 col-community">
            <a class="community-link" href="#">Find a Community <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.png" alt="image description"></a>
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
              <li>
                <ion-icon name="location-outline"></ion-icon>
                <address class="main-item">
                  Koelsch Communities<br>
                  111 Market Street NE #200<br>
                  Olympia, Wa 98502
                </address>
                <address class="community-item">
                  The Park At Laguna Springs<br>
                  Laguna Springs Drive<br>
                  Elk Grove, Ca 95757
                </address>
              </li>
              <li>
                <ion-icon name="call-outline"></ion-icon>
                <a href="tel:3608671900">(360) 867-1900</a>
              </li>
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
              <a href="#">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" alt="K/Koelsch Communities">
              </a>
            </strong>
            <span class="copyright">&copy; Copyright 2021 <a href="#">Koelsch Communities</a>. All Rights Reserved.</span>
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
?>
