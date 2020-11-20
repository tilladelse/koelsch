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
    add_action('init', array($this, 'setupCommunityContext'));
  }

  public function setupCommunityContext(){

    if (is_page_template('page-templates/community.php')){
      $this->initCookie();
    }

  }

  public function initCookie(){
    if ((!isset($_COOKIE[$this::COOKIE_NAME]) || $_COOKIE[$this::COOKIE_NAME] == '0')){
      $this->setCookie();
    }
    $this->deleteCookie();
  }

  /**
   * Sets the cookie.
   * @return void
   */
  public function setCookie(){
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
    return '26%1503';
  }

  public function getCookieValue(){
    $this->getCookie();
    return $this->cookie;
  }
}
?>
