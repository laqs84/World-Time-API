<?php
 
/**
 * @file
 * Contains of \Drupal\hello\Controller\HelloRouteController.php
 */
 
namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Serialization\Json;
/**
 * Returns responses for User module routes.
 */
class HelloRouteController extends ControllerBase {
 
  /**
   * Returns the route content.
   *
   * @return array
   *   A renderable array containing the page content.
   */
  public function index1() { //most simple
    return array('#markup' => 'Hello1 world page text (from controller) !');
  }
  public function index2() { // with translated text
    return [
        '#type' => 'markup',
        '#markup' => $this->t('Hello2 world page text (from controller) !')
    ];
  }

  public function index3() { //with call to call to config
    return ['#theme' => 'hello_text', 
            '#text' => $this->getResults()
    ];
  }
  public function index4($timezone, $area) { // with parameter
    return array('#markup' => "Hello4 $timezone page text (from controller) !");
  }
 
  function index5() { 
    $user = \Drupal::currentUser();
    if ($user->hasPermission('access administration menu')) {
      return array('#markup' => 'Hello5 world page text (you have permissions) !');
    } else {
      return array('#markup' => 'Hello5 world page text (you DONT have permissions) !');
    }
  }
  
    public function getResults() {
    $data = array();
   

    if (function_exists('hello_reponse')) {
      $response = hello_reponse('http://worldtimeapi.org/api/timezone/Europe/Belgrade', 'GET');
      $response2 = hello_reponse('https://worldtimeapi.org/api/timezone/America/Costa_Rica', 'GET');
      $response3 = hello_reponse('https://worldtimeapi.org/api/timezone/America/New_York', 'GET');
      
      $json = "[".$response.",".$response2.",".$response3."]";
      }

    if ($response) {
      $result =  json_decode($json, true);
      
      
      $data = $result;

        
    return $data;
  }
  else{
    return [];
  }
  
  }
  
  
}
 
