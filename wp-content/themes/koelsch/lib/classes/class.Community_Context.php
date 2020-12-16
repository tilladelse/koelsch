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
  protected $pageID;

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

  /**
   * The living type ID
   * @var string
   */
  var $livingTypeID;

  /**
   * Whether or not we're in community context
   * @var boolean
   */
  var $inCommunityContext;

	/**
   * Community home page ID
   * @var boolean
   */
  var $communityHomepageID;

  function __construct(){
    add_action('wp_ajax_setup_community_context', array($this, 'setupCommunityContext'));
    add_action('wp_ajax_nopriv_setup_community_context', array($this, 'setupCommunityContext'));
    add_action('wp_head', array($this, 'headScripts'));
  }

  public function inCommunityContext(){
		$this->inCommunityContext = false;

    if ($this->menuID && $this->communityID){
			$this->inCommunityContext = true;
    }

    return $this->inCommunityContext;
  }
  /**
   * Sets up the menu ID and community ID. If we're on a community home page this will grab that info from the DB, if not, get it from the cookie.
   * IMPORTANT this must be called in the loop
   * @return null
   */
  public function getCommunityContext(){
    if (is_page_template('page-templates/community.php')){
      $pageID = get_the_id();
      $this->pageID = $pageID;
      $hpid = $this->getCommunityHomePageID();
      if ($hpid){
        $this->setCookieValue();
				$this->getLivingTypeID();
        return;
      }
    }

    $this->getCookieValue();
    $this->getLivingTypeID();
  }

  public function getLivingTypeID(){
    if ($this->communityID){
      $this->inCommunityContext = TRUE;
      $this->livingTypeID = get_post_meta($this->communityID, 'living_type', true);
    }else{
      $this->inCommunityContext = FALSE;
      //we're not in community context so set to default living type id
      $this->livingTypeID = 'independent-assisted-living-memory-care';
    }
		// var_dump($this->communityID);
  }

  /**
   * Gets the current living types for this community or if not in community context, gets all the living types
   * @return array An array of living Types
   *
   * Return array structure:
   *
   * array(
   *  living type id => array(
   *    'name'=> string
   *    'seal_url'=> string
   *    'living_types' => array
   *    'resources_menu_id', string/int
   *  )
   * )
   *
   */
  public function getCurrentLivingTypes(){

    $ltSettings = get_koelsch_setting('living_types');
    $livingTypes = array();

    if ($ltSettings){

      foreach($ltSettings as $i=>$type){

        if ($type['id'] == $this->livingTypeID){
          return $type;
        }

      }

    }

    return false;

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
              console.log("setup community context");
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
    $this->pageID = isset($_REQUEST['page_id']) ? $_REQUEST['page_id'] : '';
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
		$this->cookie = $menuID.'%'.$communityID;
    return $this->cookie;
  }

  protected function getCommunityHomePageID(){
    if ($this->pageID){
      $ancestors = get_post_ancestors($this->pageID);

      /**
       * This call is initiated by a page with the community page template,
       * so its safe to assume that if there's no ancestors with the community template
       * this page is the community home page
       */

      $hpid = $this->pageID;

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

			$this->communityHomePageID = $hpid;
      return $this->communityHomePageID;
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
