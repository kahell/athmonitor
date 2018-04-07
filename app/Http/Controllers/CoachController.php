<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\Coaches;
use Validator;
use App\Support\FilterPaginateOrder;


class CoachController extends Controller
{
  public function index()
  {
    return response()
      ->json([
        'model' => Coaches::filterPaginateOrder()
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
      'achieve_id' => 'required'
    ]);

    $coach = Coaches::create($request->all());

    return response()
      ->json([
        'saved' => true
      ],200);
  }

  public function show($id)
  {
    $coach = Coaches::findOrFail($id);

    return response()
      ->json([
        'model' => $coach
      ],200);
  }

  public function edit($id)
  {
    $coach = Coaches::findOrFail($id);

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
