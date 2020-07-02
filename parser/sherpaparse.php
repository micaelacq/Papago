<?php
/*
* this is a (slightly) simplified version of the sherpaParse function used by Papago for the information sheet production.
* It needs the ISSN available on SHERPA/RoMEO as the only parameter.
* You need an API key (cf. line 14) for using the SHERPA/RoMEO API. You can register for a key on the following page: https://v2.sherpa.ac.uk/api/
*/

//example:
$result = sherpaParse('0018-2613');
var_dump($result);


function sherpaParse($issn) {
  $sherpa = array('url' => 'https://v2.sherpa.ac.uk/', 'apipath' => 'cgi/retrieve', 'key' => 'FF5C7B90-1032-11EA-9359-7FE62A6A9D3C');
  $journal = array(
    'title' => '',
    'url' => '',
    'postprint' => array(
      'authorization' => 'unknown',
      'embargo' => array(
        'num' => '',
        'type' => '')
      ),
    'pdf' => array(
      'authorization' => 'unknown',
      'embargo' => array(
        'num' => '',
        'type' => '')
      ),
    'conditions' => false
  );
  $url = $sherpa['url'] . $sherpa['apipath'] . '?item-type=publication&api-key=' . $sherpa['key'] . '&format=Json&filter=[["issn","equals","' . $issn . '"]]';
  $url = preg_replace("/ /", "%20", $url);
  $journal['api'] = $url;
  $res = file_get_contents($url);
  $json = json_decode($res);
  $versions = array('accepted' => 'postprint', 'published' => 'pdf');
  if (count($json->items)) {
    $journal['title'] = $json->items[0]->title[0]->title;
    $journal['url'] = $json->items[0]->system_metadata->uri;
    foreach($json->items[0]->publisher_policy as $policy) {
      if(isset($policy->permitted_oa) && ($policy->internal_moniker == 'Default Policy' || substr($policy->internal_moniker, 0, 16) == 'Creative Commons')) {
        foreach($policy->permitted_oa as $idx => $permitted) {
          if ($permitted->additional_oa_fee == 'no') { //Green OA possible
            $repository = false;
            foreach($permitted->location->location as $location) {
              if (stripos($location, 'repository') !==false || stripos($location, 'any_website') !==false) {
                $repository = true;
              }
            };
            if (isset($permitted->article_version)) {
              foreach($permitted->article_version as $version) {
                if (array_key_exists($version, $versions)) {
                  if($repository) {
                    $journal[$versions[$version]]['authorization'] = 'can';
                    if ($version == 'accepted' && $journal['pdf']['authorization'] == 'unknown') {
                      $journal['pdf']['authorization'] = 'cannot';
                    }
                    elseif($version == 'published' && $journal['postprint']['authorization'] == 'unknown') {
                      $journal['postprint']['authorization'] = 'cannot';
                    }
                  
                    if (isset($permitted->embargo)) {
                      if ($journal[$versions[$version]]['embargo']['num']) {
                        if ($permitted->embargo->amount < $journal[$versions[$version]]['embargo']['num']) {
                          $journal[$versions[$version]]['embargo']['type'] = $permitted->embargo->units;
                          $journal[$versions[$version]]['embargo']['num'] = $permitted->embargo->amount;
                        } 
                      }
                      else {
                        $journal[$versions[$version]]['embargo']['type'] = $permitted->embargo->units;
                        $journal[$versions[$version]]['embargo']['num'] = $permitted->embargo->amount;
                      }
                    }
                  }
                  else {
                    $journal[$versions[$version]]['authorization'] = 'cannot';
                  }
                  
                }
              }
            }
            elseif ($idx == 0) { //gold OA
              if ($repository) {
                $journal['postprint']['authorization'] = 'can';
              }
            }
          }
        }
      }
      else {
        $journal['postprint']['authorization'] = 'cannot';
        $journal['pdf']['authorization'] = 'cannot';
      }
    }
  }
  else {
    $journal['title'] = '!unknown!'; 
  }
  return $journal;
}



?>

