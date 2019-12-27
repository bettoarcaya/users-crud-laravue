<?php
/**
 * Created by PhpStorm.
 * User: b3tt0
 * Date: 27/12/19
 * Time: 03:35 PM
 */

namespace App\Repositories;



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

}