<?php
/**
 * Created by PhpStorm.
 * User: b3tt0
 * Date: 27/12/19
 * Time: 03:35 PM
 */

namespace App\Repositories;



use App\Models\Client;
use App\Models\User;

class ClientRepository
{

  /**
   * @return mixed
   */
  public function getAll(){
    $response = User::where('type_id', 2)
                ->get();

    return $response;
  }

  public function saveClient($client){

    $response = User::create($client);

    return $response;
  }

  public function saveClientCarships($dealer_ships, $client_id){

    foreach ($dealer_ships as $dealer_ship){
      $dealer = new Client();
      $dealer->user_id = $client_id;
      $dealer->car_dealer_id = $dealer_ship['id'];
      $dealer->save();
    }

  }

}