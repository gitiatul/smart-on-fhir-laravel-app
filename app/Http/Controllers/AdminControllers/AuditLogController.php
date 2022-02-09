<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;


class AuditLogController extends Controller
{
    /**
     * Auditlogs Index
     */
    public function index()
    {
        return view('admin.auditLogs.index');
    }

    /**
     * Auditlogs List
     * @param  \Illuminate\Http\Request  $request
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = AuditLog::all();
            return Datatables::of($data)
                ->editColumn('created_at', function ($data) {
                    $date = \DateTime::createFromFormat('Y-d-m H:i:s', $data->created_at);
                    return $date->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a title="Show Audit log" class="btn btn-primary btn-sm showAuditLog" href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->auditlog_id . '"><i class="fas fa-eye"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Auditlogs show
     */
    public function show($id)
    {
        $auditlog = AuditLog::find($id);
        if (!$auditlog) {
            session()->flash('error', 'Audit Log Not Found');
            return redirect('/admin/auditlogs/index');
        }
        return response()->json($auditlog);
    }
}
