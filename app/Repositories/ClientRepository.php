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
use Illuminate\Support\Facades\DB;

class ClientRepository
{

  /**
   * @return mixed
   */
  public function getAll(){
    $response = User::where('type_id', 2)
                    ->paginate(10);

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

  public function getClient($user_id){
    $response = User::findOrFail($user_id);

    return $response;
  }

  public function getCarDealerships($user_id){

    $response = DB::table('clients')
                  ->where('user_id', $user_id)
                  ->join('car_dealerships', 'car_dealerships.id', '=', 'clients.car_dealer_id')
                  ->get();

    return $response;
  }

  public function deleteClient($user_id){
    $response = User::findOrfail($user_id)
                    ->delete();

    return $response;
  }

  public function updateClient($client, $user_id){

    $response = User::findOrFail($user_id)
                    ->update($client);

    return $response;
  }

  public function deleteCarships($car_ships, $user_id){
    foreach ($car_ships as $car_ship_id){
      DB::table('clients')
        ->where('user_id', $user_id)
        ->where('car_dealer_id', $car_ship_id)
        ->delete();
    }
  }

  public function addCarships($car_ships, $user_id){
    foreach ($car_ships as $car_ship_id){
      $client = new Client();
      $client->user_id = $user_id;
      $client->car_dealer_id = $car_ship_id;
      $client->save();
    }
  }

}