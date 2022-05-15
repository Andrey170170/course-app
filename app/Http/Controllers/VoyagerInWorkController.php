<?php

namespace App\Http\Controllers;

use App\Models\DriverCategory;
use App\Models\ShuttleHasCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class VoyagerInWorkController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{

    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->ajax()) {
            DB::beginTransaction();
            $d_categ = array();
            $sh_categ = array();
            $d= DriverCategory::where('drivers_d_id', $request->input('iw_d_id'))->get();
            $sh = ShuttleHasCategory::where('shc_s_id', $request->input('iw_sh_id'))->get();
            foreach ($d as $driv) {
                $d_categ[] = $driv['categories_c_id'];
            }
            foreach ($sh as $shut) {
                $sh_categ[] = $shut['shc_c_id'];
            }
            $res = collect($d_categ)->intersect(collect($sh_categ));
            $this->insertUpdateData($request, $slug, $dataType->editRows, $data);
            if ($res->count() == 0) {
                DB::rollBack();
                return response()->json(['errors' => "Error"]);
            }
            DB::commit();

            event(new BreadDataUpdated($dataType, $data));

            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
    }

    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);

        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }

        if (!$request->has('_validate')) {
            DB::beginTransaction();
            $d_id = $request->input('iw_d_id');
            $sh_id = $request->input('iw_sh_id');
            $d = DriverCategory::where('drivers_d_id', $d_id)->get();
            $sh = ShuttleHasCategory::where('shc_s_id', $sh_id)->get();
            $d_categ = array();
            $sh_categ = array();
            foreach ($d as $driv) {
                $d_categ[] = $driv['categories_c_id'];
            }
            foreach ($sh as $shut) {
                $sh_categ[] = $shut['shc_c_id'];
            }
            $res = collect($d_categ)->intersect(collect($sh_categ));
            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
            if ($res->count() == 0) {
                DB::rollBack();
                return response()->json(['errors' => "Error"]);
            }
            DB::commit();

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
}
