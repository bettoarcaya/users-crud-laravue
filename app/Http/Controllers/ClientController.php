<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClient;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    protected $clientRepository;

    public function __construct(
       ClientRepository $client_repository
    ){
      $this->clientRepository = $client_repository;
    }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('clients');
    }

    /**
     * return all the available clients
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients(){
      $clients = $this->clientRepository->getAll();
      $data    = compact('clients');

      return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreClient $request
   * @return \Illuminate\Http\Response
   */
    public function store(StoreClient $request){

      $validation    = $request->validated();
      $rand_password = substr(Hash::make(microtime()), 1, 8);
      $client_data   = [
        'name'     => $request->name,
        'email'    => $request->email,
        'lastname' => $request->lastname,
        'password' => $rand_password,
        'type_id'  => 2
      ];

      $dealership_data = $request->carDealership;
      $client          = $this->clientRepository->saveClient($client_data);
      $data            = compact('client');

      $this->clientRepository->saveClientCarships($dealership_data, $client->id);


      return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

      $client = $this->clientRepository->getClient($id);
      $data   = compact('client');

      return response()->json($data, 200);
    }

    public function getCarShips($id){
      $ships = $this->clientRepository->getCarDealerships($id);
      $data  = compact('ships');

      return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $client_data   = [
        'name'     => $request->clientInfo['name'],
        'email'    => $request->clientInfo['email'],
        'lastname' => $request->clientInfo['lastname'],
      ];

      $updated_client = $this->clientRepository->updateClient($client_data, $id);
      $data           = compact('updated_client');

      $this->clientRepository->deleteCarships($request->carShipsInfo['delete'], $id);
      $this->clientRepository->addCarships($request->carShipsInfo['new'], $id);

      return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_client = $this->clientRepository->deleteClient($id);
        $clients        = $this->clientRepository->getAll();
        $data           = compact('deleted_client', 'clients');

        return response()->json($data, 200);
    }
}
