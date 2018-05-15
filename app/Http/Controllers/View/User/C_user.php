<?php

namespace App\Http\Controllers\View\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Http\Controllers\Controller as TCGController;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use App\Model\Users\User;
use App\Model\Users\Statuses;
use App\Model\Teams\Coaches;
use App\Model\Sports\Sports;
use Hash, Mail, Validator, Session, JWTAuth, JWTFactory,Storage;
use Illuminate\Mail\Message;
use App\Http\Controllers\Controller;

class C_user extends TCGController
{
    use BreadRelationshipParser;

    public function index(Request $request)
    {
      // GET THE SLUG, ex. 'posts', 'pages', etc.
      $slug = $this->getSlug($request);

      // GET THE DataType based on the slug
      $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

      // Check permission
      $this->authorize('browse', app($dataType->model_name));

      $getter = $dataType->server_side ? 'paginate' : 'get';

      $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
      $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
      $orderBy = $request->get('order_by');
      $sortOrder = $request->get('sort_order', null);

      // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
      if (strlen($dataType->model_name) != 0) {
          $relationships = $this->getRelationships($dataType);

          $model = app($dataType->model_name);
          $query = $model::select('*')->with($relationships);

          // If a column has a relationship associated with it, we do not want to show that field
          $this->removeRelationshipField($dataType, 'browse');

          if ($search->value && $search->key && $search->filter) {
              $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
              $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
              $query->where($search->key, $search_filter, $search_value);
          }

          if ($orderBy && in_array($orderBy, $dataType->fields())) {
              $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'DESC';
              $dataTypeContent = call_user_func([
                  $query->orderBy($orderBy, $querySortOrder),
                  $getter,
              ]);
          } elseif ($model->timestamps) {
              $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
          } else {
              $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
          }

          // Replace relationships' keys for labels and create READ links if a slug is provided.
          $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
      } else {
          // If Model doesn't exist, get data from table name
          $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
          $model = false;
      }

      // Check if BREAD is Translatable
      if (($isModelTranslatable = is_bread_translatable($model))) {
          $dataTypeContent->load('translations');
      }

      // Check if server side pagination is enabled
      $isServerSide = isset($dataType->server_side) && $dataType->server_side;

      $view = 'voyager::bread.browse';

      if (view()->exists("voyager::$slug.browse")) {
          $view = "voyager::$slug.browse";
      }

      return Voyager::view($view, compact(
          'dataType',
          'dataTypeContent',
          'isModelTranslatable',
          'search',
          'orderBy',
          'sortOrder',
          'searchable',
          'isServerSide'
      ));
    }

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $details = json_decode($row->details);
            $dataType->addRows[$key]['col_width'] = isset($details->width) ? $details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Additional data
        $user_status = null;
        $sport = Sports::all();
        $additionalDataContent["user_status"] = $user_status;
        $additionalDataContent["sport"] = $sport;

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','additionalDataContent'));
    }

    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $rules = [];
        $content = [];
        foreach (User::formValidation() as $key => $value) {
          if(isset($request[$key])){
            $rules[$key] = $value;
            $content[$key] = $request[$key];
          }
        }
        $val = Validator::make($request->all(), $rules);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->has('_validate')) {
            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

            // Initialize
            $name = $content["fullname"];
            $email = $content['email'];
            $verification_code = str_random(30);
            $subject = "Please verify your email address.";

            //Insert Coaches
            $user_id = User::orderBy('id', 'desc')->first()->id;
            $coach = new Coaches();
            $coach->user_id = $user_id;
            $coach->sport_id = $request->sport;
            $coach->save();

            // Insert Statuses
            $status = new Statuses();
            $status->user_id = $user_id;
            $status->account_status_id = 2;
            $status->isBlocked = 0;
            $status->accVerificationCode = $verification_code;
            $status->isResetPass = 0;
            $status->save();

            // Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
            // function($mail) use ($email, $name, $subject){
            //   $mail->from('hai@suitdevelopers.com', "Suitdeveloper");
            //   $mail->to($email, $name);
            //   $mail->subject($subject);
            // });

            event(new BreadDataAdded($dataType, $data));

            if ($request->ajax()) {
                return response()->json(['success' => true, 'data' => $data]);
            }

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                        'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                        'alert-type' => 'success',
                    ]);
        }
    }

    public function show($id)
    {
      $slug = $this->getSlug($request);

      $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

      $relationships = $this->getRelationships($dataType);
      if (strlen($dataType->model_name) != 0) {
          $model = app($dataType->model_name);
          $dataTypeContent = call_user_func([$model->with($relationships), 'findOrFail'], $id);
      } else {
          // If Model doest exist, get data from table name
          $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
      }

      // Replace relationships' keys for labels and create READ links if a slug is provided.
      $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

      // If a column has a relationship associated with it, we do not want to show that field
      $this->removeRelationshipField($dataType, 'read');

      // Check permission
      $this->authorize('read', $dataTypeContent);

      // Check if BREAD is Translatable
      $isModelTranslatable = is_bread_translatable($dataTypeContent);

      // Additional data
      $user_status = User::find($dataTypeContent->id)->status->account_status_id;
      $sport = Sports::all();
      $additionalDataContent["user_status"] = $user_status;
      $additionalDataContent["sport"] = $sport;

      $view = 'voyager::bread.read';

      if (view()->exists("voyager::$slug.read")) {
          $view = "voyager::$slug.read";
      }

      return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'additionalDataContent'));
    }

    public function edit(Request $request, $id)
    {
      $slug = $this->getSlug($request);

      $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

      $relationships = $this->getRelationships($dataType);

      $dataTypeContent = (strlen($dataType->model_name) != 0)
          ? app($dataType->model_name)->with($relationships)->findOrFail($id)
          : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

      foreach ($dataType->editRows as $key => $row) {
          $details = json_decode($row->details);
          $dataType->editRows[$key]['col_width'] = isset($details->width) ? $details->width : 100;
      }

      // If a column has a relationship associated with it, we do not want to show that field
      $this->removeRelationshipField($dataType, 'edit');

      // Check permission
      $this->authorize('edit', $dataTypeContent);

      // Check if BREAD is Translatable
      $isModelTranslatable = is_bread_translatable($dataTypeContent);

      $view = 'voyager::bread.edit-add';

      if (view()->exists("voyager::$slug.edit-add")) {
          $view = "voyager::$slug.edit-add";
      }

      // Additional data
      $additionalDataContent["user_status"] = User::find($dataTypeContent->id)->status->account_status_id;
      $additionalDataContent["sport"] = Sports::all();
      $additionalDataContent["coach"] = Coaches::where("user_id", $dataTypeContent->id)->first();
      // echo json_encode($dataTypeContent->id);exit;

      return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'additionalDataContent'));

      // return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'additionalDataContent'));
    }

    public function update(Request $request, $id)
    {
      $slug = $this->getSlug($request);

      $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

      // Compatibility with Model binding.
      $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

      $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

      // Check permission
      $this->authorize('edit', $data);

      //validation
      $rules = [];
      $content = [];
      foreach (User::formValidation() as $key => $value) {
        if(isset($request[$key]) && !empty($request[$key])){
          $rules[$key] = $value;
          $content[$key] = $request[$key];
        }
      }
      $val = Validator::make($request->all(), $rules);

      if ($val->fails()) {
          return response()->json(['errors' => $val->messages()]);
      }

      if (!$request->ajax()) {
          $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

          //Update Coaches
          $coach = Coaches::where("user_id", $id)->first();
          $coach->sport_id = $request->sport;
          $coach->save();

          // Update Status User
          $status = Statuses::where("user_id",$id)->first();
          $status->account_status_id = $request->status;
          $status->save();

          event(new BreadDataUpdated($dataType, $data));

          return redirect()
              ->route("voyager.{$dataType->slug}.index")
              ->with([
                  'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                  'alert-type' => 'success',
              ]);
      }
    }

    public function destroy($id)
    {
        //
    }
}
