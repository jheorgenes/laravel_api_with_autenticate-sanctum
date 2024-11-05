<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return all clients in database
        // return response()->json(Client::all(), 200);
        return ApiResponse::success(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required',
        ]);

        //add a new client to the database
        $client = Client::create($request->all());
        return ApiResponse::success([
            'message' => 'Client created successfully',
            'data' => $client
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show clients details
        $client = Client::find($id);

        //return a response
        if($client) {
            return ApiResponse::success($client);
        }
        return ApiResponse::error('Client not found', 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,' . $id, //Verificando se o e-mail é único em relação aos demais registros do banco. Se for o mesmo e-mail desse cadastro, permite a atualização
            'phone' => 'required',
        ]);

        //update the client in the database
        $client = Client::find($id);
        if($client) {
            $client->update($request->all());
            return ApiResponse::success([
                'message' => 'Client updated successfully',
                'data' => $client
            ]);
        }
        return ApiResponse::error('Client not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the client
        $client = Client::find($id);
        if($client) {
            $client->delete();
            return ApiResponse::success(['message' => 'Client deleted successfully']);
        }
        return ApiResponse::error('Client not found', 404);
    }
}
