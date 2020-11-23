<?php
class Community_Context{

  /**
	 * Cookie name
	 *
	 * @var string
	 */
	const COOKIE_NAME = 'koelsch';

  /**
	 * Cookie expires in days
	 *
	 * @var string
	 */
	const EXPIRES = 365;

  /**
   * The cookie
   * @var string
   */
  protected $cookie;

  /**
   * The id of the page that calls setup community context
   * @var string
   */
  protected $page_id;

  /**
   * The menu ID
   * @var string
   */
  var $menuID;

  /**
   * The community ID
   * @var string
   */
  var $communityID;

  function __construct(){
    add_action('wp_ajax_setup_community_context', array($this, 'setupCommunityContext'));
    add_action('wp_ajax_nopriv_setup_community_context', array($this, 'setupCommunityContext'));
    add_action('wp_head', array($this, 'headScripts'));
  }

  public function inCommunityContext(){
    if ($this->menuID && $this->communityID){
      return true;
    } 
    return false;
  }
  /**
   * Sets up the menu ID and community ID. If we're on a community home page this will grab that info from the DB, if not, get it from the cookie.
   * IMPORTANT this must be called in the loop
   * @return null
   */
  public function getCommunityContext(){
    if (is_page_template('page-templates/community.php')){
      $pageID = get_the_id();
      $this->page_id = $pageID;
      $hpid = $this->getCommunityHomePageID();
      if ($hpid){
        $this->setCookieValue();
        return;
      }
    }
    $this->getCookieValue();
  }

  public function setupCommunityContext(){
    if ( defined('DOING_AJAX') && DOING_AJAX ){
      $this->setCookie();
      die(0);
    }
  }

  public function headScripts(){
    if (is_page_template('page-templates/community.php')){
      global $post;
      echo '<script type="text/javascript" id="community_context">
          jQuery(document).ready(function(){
              // console.log("setup community context");
              jQuery.ajax({type : "post",url : koelsch.ajaxurl,data : {action: "setup_community_context", page_id:"'.$post->ID.'"}});
          });
      </script>';
    }
  }

  /**
   * Sets the cookie.
   * @return void
   */
  public function setCookie(){
    $this->page_id = isset($_REQUEST['page_id']) ? $_REQUEST['page_id'] : '';
    //cookie expires in 30 days
    $xpires = time()+(86400 * self::EXPIRES);
    $val = $this->setCookieValue();
    setcookie($this::COOKIE_NAME, $val, $xpires, COOKIEPATH);
  }

  /**
   * Deletes the cookie.
   * @return void
   */
  public function deleteCookie(){
    if (isset($_COOKIE[$this::COOKIE_NAME])){
      setcookie($this::COOKIE_NAME, '0', -1, COOKIEPATH);
      unset($_COOKIE[$this::COOKIE_NAME]);
    }
  }

  public function getCookie(){
    if (isset($_COOKIE[$this::COOKIE_NAME]) && $_COOKIE[$this::COOKIE_NAME] != '0'){
      $this->cookie = $_COOKIE[$this::COOKIE_NAME];
    }
  }

  protected function setCookieValue(){
    $communityHomePage = $this->getCommunityHomePageID();
    $communityID = get_post_meta($communityHomePage, 'community_post_id', true);
    $menuID = get_post_meta($communityID, 'menu_id', true);
    $this->menuID = $menuID;
    $this->communityID = $communityID;
    return $menuID.'%'.$communityID;
  }

  protected function getCommunityHomePageID(){
    if ($this->page_id){
      $ancestors = get_post_ancestors($this->page_id);

      /**
       * since this call is initiated by a page with the community page template,
       * its safe to assume that if there's no ancestors with the community template
       * this page is the community home page
       */

      $hpid = $this->page_id;

      if ($ancestors){
        $communityAncestors = array();
        foreach($ancestors as $a){
          $pageTemplate = get_page_template_slug($a);
          if ($pageTemplate == 'page-templates/community.php'){
            $communityAncestors[] = $a;
          }
        }
        if ($communityAncestors){
          // it will be the last one added to the array
          $hpid = end($communityAncestors);
        }
      }
      return $hpid;
    }
  }

  public function getCookieValue(){
    $this->getCookie();
    if ($this->cookie){
      $arr = explode('%', $this->cookie);
      $this->menuID = $arr[0];
      $this->communityID = $arr[1];
    }
    return $this->cookie;
  }
}
?>
