<?php
 use Curl\Curl;
/**
 * Facilitates connection with Sherpa API
 */
class Sherpa{

  /**
   * In production environment?
   * @var bool
   */
  private const PROD = false;

  /**
   * Debug mode?
   * @var bool
   */
  private const DEBUG = true;

  /**
   * URL Base
   * @var string
   */
  private $URLBase;

  /**
   * Auth key
   * @var string
   */
  private $key;

  /**
   * Company ID
   * @var int
   */
  private $companyID;

  /**
   * Community ID
   * @var int
   */
  private $communityID;


  function __construct(){

    if ($this::PROD == true){
      //set production values
      $this->URLBase = 'https://members.sherpacrm.com/v1';
      $this->key = 'mIByLQL5BOFFyFRqnzS5g7iMQMpAiKqv5EpYW14AfkG2hPY9LLuZQpnct0gaAkua';
      $this->companyID = 293;

    }else{
      //set sandbox values
      $this->URLBase = 'https://members-demo.sherpacrm.com/v1';
      $this->key = 'Cpj5OW0GEw5OIzFq8dibFQYbZ9B9Z0H3Fyi3FaJHLoXKyBYa0gQpDFGsmkHspbUq';
      $this->companyID = 395;
    }


  }

  public function createLead($entry, $form){
    if ($this::DEBUG != true) GFCommon::log_debug( 'Create Lead Triggered' );
    $cID = $entry['30']; //community ID NOTE: double check id
    if ($this::DEBUG != true) GFCommon::log_debug( 'Community ID: '.$cID );

    if ($cID){
      $sherpaCommunityID = get_post_meta($cID, 'sherpa_community_id', true);
      if ($this::DEBUG != true) GFCommon::log_debug( 'sherpa community: '.$sherpaCommunityID );
      if (!$sherpaCommunityID){
        //no community id has been associated with the community, so get outa here.
        return;
      }
    }else{
      //there is no community specified, so get outa here.
      return;
    }

    $this->communityID = $sherpaCommunityID;

    $now = current_time("Y-m-dTH:i:sO");

    //map fields
    $fields = (object)array(
      'requestType'=>$entry['6'],
      'communityName'=>$entry['26'],
      'notificationsSentTo'=>$entry['27'],
      'firstName'=>$entry['1.3'],
      'lastName'=>$entry['1.6'],
      'email'=>$entry['2'],
      'phone'=>$entry['3'],
      'requestBrochure'=>$entry['11'],
      'mailingAddress'=>(object)array(
        'street1'=>$entry['13.1'],
        'street2'=>$entry['13.2'],
        'city'=>$entry['13.3'],
        'state' => $entry['13.4'],
        'zip' => $entry['13.5'],
        'country' => $entry['13.6'],
      ),
      'requestTour'=>$entry['25'],
      'requestTourDate'=>$entry['7'],
      'requestTourTime'=>$entry['12'],
      'message'=>$entry['4'],
      'relationship'=>$this::PROD == true ? $entry['29'] : $entry['31'],
    );


    //setup referral note
    $referralNote = $fields->message ? $fields->firstName.' submitted a message saying: '.$fields->message : '';
    $referralNote .= $fields->requestBrochure == 'Yes' ? ' -- Requested a brochure be sent.' : '';
    if ($fields->requestTour == 'Yes'){
      $date = ' but no date was specified';
      if ($fields->requestTourDate){
        $dateStamp = strtotime($fields->requestTourDate);
        $date = ' on '.date('F jS, Y');
      }

      $time = $fields->requestTourTime ? ' in the '.$fields->requestTourTime : '';
      $referralNote .= ' -- Requested a tour'.$time.$date.'.';
    }

  if ($this::DEBUG != true)   GFCommon::log_debug('referral note: '.print_r( $referralNote, true ) );
    //GFCommon::log_debug('Form data: '.print_r( $fields, true ) );
    //GFCommon::log_debug( 'Date : ' . print_r( $date, true ) );

    $data = array(
      'vendorName'=>$this::PROD == true ? 'Company Website' : 'Tilladelse',
      'sourceCategory'=>'Company Website',
      'sourceName' => 'Company Website',
      'referralNote' => $referralNote,
      'referralDateTime' => $now,
      'primaryContactResidentRelationship'=>$fields->relationship,
      'primaryContactFirstName' => $fields->firstName,
      'primaryContactLastName' =>$fields->lastName,
      'primaryContactEmail' => $fields->email,
      'primaryContactHomePhone' => $fields->phone,
      'residentContactFirstName' => '',
      'residentContactLastName' =>'',
    );

    if ($fields->relationship == 'Yourself'){
      $data['residentContactFirstName'] = $fields->firstName;
      $data['residentContactLastName'] = $fields->lastName;
      $data['residentContactEmail'] = $fields->email;
      $data['residentContactHomePhone'] = $fields->phone;
    }

    if ($fields->requestBrochure == 'yes'){
      $data['primaryContactAddress1'] = $fields->mailingAddress->street1;
      $data['primaryContactAddress2'] = $fields->mailingAddress->street2;
      $data['primaryContactCity'] = $fields->mailingAddress->city;
      $data['primaryContactState'] = $fields->mailingAddress->state;
      $data['primaryContactPostalCode'] = $fields->mailingAddress->zip;
      $data['primaryContactCountry'] = $fields->mailingAddress->country;

    }
    GFCommon::log_debug( 'Data : ' . print_r( $data, true ) );
    // $this->sherpaConnection(array(), 'prospects?pageSize=100&pageNumber=1','get');
    // $this->sherpaConnection(array(), 'leasing-counselors', 'get');
    $r = $this->sherpaConnection($data, 'leads');

    //TODO: continue to debug issue with adding a referral note
    // if (isset($r->errors)){
    //   foreach($r->errors as $error){
    //     if (substr($error->message, 0, 9) == 'Duplicate'){
    //       // $id = $r->data->id;
    //       // $id = 1694;
    //       $leasingCounselors = $this->sherpaConnection(array(), 'leasing-counselors', 'get');
    //       $lcids = array();
    //       if (isset($leasingCounselors->data)){
    //         foreach($leasingCounselors->data as $lc){
    //           $lcids[] = $lc->id;
    //         }
    //       }
    //       // if ($this::DEBUG != true) GFCommon::log_debug( 'Leasing Counselors: '. print_r($leasingCounselors, true) );
    //       $noteData = array(
    //         'entryDate'=>current_time("Y-m-d"),
    //         'entryTime'=>current_time("H:i"),
    //         'description'=>$referralNote,
    //         'advance'=>'Continuation',
    //         // 'strategy'=>'',
    //         // 'nextSteps'=>array(),
    //         // 'completedActionIds'=>array(),
    //         'activity'=>array(
    //           'activityTypeName'=>'Email In',
    //           'duration'=>'00:02',
    //           'leasingCounselorIds'=>array(24983),
    //         )
    //       );
    //       $this->sherpaConnection(array(), 'prospects/'.$id.'/sales-notes','get');
    //       if ($this::DEBUG != true) GFCommon::log_debug( 'Create a sales note: '. print_r($noteData, true) );
    //
    //       $this->createSalesNote($id, $noteData);
    //       break;
    //     }
    //   }
    // }

  }

  public function createSalesNote($prospectID, $data){
    $r = $this->sherpaConnection($data, 'prospects/'.$prospectID.'/sales-notes');
  }

  private function sherpaConnection($data, $endpoint, $method = 'post'){

    $URL = $this->URLBase.'/companies/'.$this->companyID.'/communities/'.$this->communityID.'/'.$endpoint;
    if ($this::DEBUG != true) GFCommon::log_debug( 'Sherpa URL : ' . $URL );

    $c = new Curl();

    $c->setHeader('Content-Type', 'application/json');
    $c->setHeader('Authorization', 'Bearer '.$this->key);

    if ($method == 'post'){
      $c->post($URL, $data);
    }else if ($method == 'get'){
      $c->get($URL, $data);
    }else{
      $c->close();
      exit;
    }

    $response = $c->response;

    if ($this::DEBUG != true){
      GFCommon::log_debug( 'Body : ' . print_r( json_encode($data), true ) );
      GFCommon::log_debug( 'Request Headers : ' . print_r( $c->requestHeaders, true ) );
      GFCommon::log_debug( 'Sherpa response : ' . print_r( $c->response, true ) );
    }
    // GFCommon::log_debug( 'Sherpa error : ' . print_r( $c->error, true ) );

    $c->close();

    return $response;
  }

}
