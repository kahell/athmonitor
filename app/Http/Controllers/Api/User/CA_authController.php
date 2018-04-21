<?php

namespace App\Http\Controllers\Api\User;
use Illuminate\Http\Request;
use App\Model\user\Coaches;
use Validator;
use App\Support\FilterPaginateOrder;
use App\Http\Controllers\Controller;

class CA_authController extends Controller
{
  public function index()
  {
    return response()
      ->json([
        'status' => true,
        'data' => Coaches::filterPaginateOrder(),
        'message' => 'Success'
      ],200);
  }

  public function create()
  {
    return response()
      ->json([
        'form' => Coaches::initialize(),
        'option' => []
      ],200);
  }

  public function store(Request $request)
  {
    
    $this->validate($request,[
      'user_id' => 'required',
      'sport_id' => 'required',
      'achieve_id' => 'required',
      'fullname' => 'required',
      'gender' => 'required',
      'avatar' => 'required',
      'address' => 'required',
      'bod' => 'required',
      'phone_number' => 'required|unique:users',
      'email' => 'required|email|unique:users',
      'account_status_id' => 'required'
    ]);

    $coach = Coaches::create($request->all());

    return response()
      ->json([
        'saved' => true
      ],200);
  }

  public function show($id)
  {
    $coach = Coaches::with(['user','status','team','sport','achievement'])->findOrFail($id);

    return response()
      ->json([
        'data' => $coach
      ],200);
  }

  public function edit($id)
  {
    $coach = Coaches::with(['user','status','team','sport'])->findOrFail($id);

    return response()
      ->json([
        'form' => $coach,
        'option' => []
      ],200);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'user_id' => 'required',
      'sport_id' => 'required',
      'achieve_id' => 'required'
    ]);

    $coach = Coaches::findOrFail($id);
    $coach->update($request->all());

    return response()
      ->json([
        'saved' => true
      ],200);
  }

  public function destroy($id)
  {
    $coach = Coaches::findOrFail($id);

    // TODO: delete customer's invoices first
    $customer->delete();

    return response()
      ->json([
        'deleted' => true
      ],200);
  }

}
