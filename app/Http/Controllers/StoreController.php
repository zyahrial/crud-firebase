<?php

namespace App\Http\Controllers;

use Validator;
// use App\Models\Store;
use Illuminate\Support\Facades\Crypt;
use Kreait\Firebase\Database;

use Redirect,Response;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

//Soal1 : CRUD dengan firebase 
class StoreController extends BaseController
{
    private $database;

    public function __construct() {
        $this->database = app('firebase.database');
    }

    public function insert(Request $request) {

        $this->name = $request->get('name');
        $this->store_id = $request->get('store_id');
        $this->area = $request->get('area');
        $this->address = $request->get('address');

        $data =  $this->database
        ->getReference('store')
        ->push([
            'name' => $this->name,
            'store_id' => $this->store_id,
            'area' => $this->area,
            'address' => $this->address
            ]);
    
        return response()->json($data->getvalue(), 200);    
    }

    public function index() {
        $data = $this->database->getReference('store')->getvalue();
        return response()->json($data);
    }
    
    public function update(Request $request, $uid)
    {
        $this->name = $request->get('name');
        $this->store_id = $request->get('store_id');
        $this->area = $request->get('area');
        $this->address = $request->get('address');

        $data = [
            'name' => $this->name,
            'store_id' => $this->store_id,
            'area' => $this->area,
            'address' => $this->address
        ];
        $updates = [
            'store/'.$uid => $data,
        ];
        $update = $this->database->getReference()->update($updates);
        if (!$update) {
            return response()->json([
                'error' => 'Store does not exist.'
            ], 400);
        }
        $this->success = "Update success";
        return response()->json($this->success , 200);    
    }

    public function show(Request $request, $uid)
    {
        $data = $this->database->getReference('store/' . $uid)->getvalue();
        return response()->json($data);
    }
    
    public function delete(Request $request, $uid) {

        $delete = $this->database->getReference('store/'.$uid)->remove();   
        $this->success = "Delete Succefull";
        return response()->json($this->success , 200);    
    }
}