<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Facility;
use App\Models\FacilityCredential;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class FacilitiesController extends Controller
{
    /**
     * Facilities Index
     */
    public function index()
    {
        $data = Facility::all();
        if (!$data) {
            session()->flash('error', 'Facility Not Found');
            return redirect('/admin/facilities/index');
        }
        return view('admin.facilities.index', compact('data'));
    }

    /**
     * getFacility
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getFacility(Request $request)
    {

        if ($request->ajax()) {
            $data = Facility::all();
            if (!$data) {
                session()->flash('error', 'Facility Not Found');
                return redirect('/admin/facilities/index');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('facility_status', function ($data) {
                    if ($data->facility_status == 1) {
                        return '<small class="badge badge-success"><i class="fas fa-check fa-fw"></i> Active</small>';
                    } else {
                        return ' <small class="badge badge-danger"><i class="fas fa-times fa-fw"></i> Inactive</small>';
                    }
                })
                ->editColumn('created_at', function ($data) {
                    $date = \DateTime::createFromFormat('Y-d-m H:i:s', $data->created_at);
                    return $date->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a title="Click to edit this facility" class="btn btn-primary btn-sm" href="' . url('admin/facilities/edit', $data->facility_id) . '"><i class="far fa-edit fa-fw"></i></a>';
                    $actionBtn = $actionBtn . '  ';
                    $actionBtn = $actionBtn . '<a class="btn btn-primary btn-sm" title="Click to edit EHR credentials of this facility" href="' . url('admin/facilitycredential/edit', $data->facility_id) . '"><i class="fas fa-key fa-fw"></i></a>';
                    $actionBtn = $actionBtn . '  ';
                    $actionBtn = $actionBtn . '<a href="#" class="btn btn-danger btn-sm" title="Click to delete this facility" data-toggle="modal" data-target="#basicModal' . $data->facility_id . '" ><i class="far fa-trash-alt fa-fw"></i></a>
                <div class="modal fade" id="basicModal' . $data->facility_id . '" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this facility ?</p>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-default btn-sm" href="#" data-dismiss="modal">Cancel</a>
                                <a class="btn btn-danger btn-sm" title="Click to delete this facility"  href="' . url('admin/facilities/destroy', $data->facility_id) . '">OK</a>
                            </div>
                            </div>
                        </div>
                        </div>';

                    return $actionBtn;
                })
                ->rawColumns(['action', 'facility_status'])
                ->make(true);
        }
    }

    /**
     * Create Facility
     */
    public function create()
    {
        return view('admin.facilities.create');
    }

    /**
     * Store Facility
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facility_name' =>  "required|unique:facilities,facility_name",
            'facility_owner_name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $facilityData = [
            "facility_app_id" => Str::uuid(),
            "facility_name" => request("facility_name"),
            "facility_owner_name" => request("facility_owner_name"),
        ];
        $facility = Facility::create($facilityData);
        $array = [
            'facility_id' => $facility->facility_id
        ];
        FacilityCredential::create($array);
        session()->flash('success', 'Facility Added Successfully.');
        return redirect('/admin/facilities/index');
    }

    /**
     * Destroy Facility
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id  facility id
     */
    public function destroy(Request $request, $id)
    {
        FacilityCredential::where('facility_id', $id)->delete();
        Facility::find($id)->delete();
        session()->flash('success', 'Facility Deleted Successfully.');
        return redirect('/admin/facilities/index');
    }

    /**
     * Edit Facility
     * @param  int $id  facility id
     */
    public function edit($id)
    {
        $facilities = Facility::find($id);
        if (!$facilities) {
            session()->flash('error', 'Facility Not Found');
            return redirect('/admin/facilities/index');
        }
        $data = compact('facilities');
        return view('admin.facilities.edit')->with($data);
    }

    /**
     * Update Facility
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id  facility id
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'facility_app_id' => "required|unique:facilities,facility_app_id,$id,facility_id",
            'facility_name' =>  "required|unique:facilities,facility_name,$id,facility_id",
            'facility_owner_name' => 'required',
            'facility_status' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $facilities = Facility::find($id);
        $facilities->facility_app_id = request('facility_app_id');
        $facilities->facility_name = request('facility_name');
        $facilities->facility_owner_name = request('facility_owner_name');
        $facilities->facility_status = request('facility_status');
        $facilities->save();
        $facilities->update($request->all());
        session()->flash('success', 'Facility credentials updated Successfully.');
        return redirect('/admin/facilities/index');
    }
}
