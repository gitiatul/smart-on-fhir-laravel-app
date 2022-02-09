<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\FacilityCredential;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OcAddress;
use Illuminate\Support\Facades\Validator;

class FacilityCredentialController extends Controller
{
    /**
     * Edit Facility Credential
     * @param  int $id  facility id
     */
    public function edit($id)
    {
        $facilityCredential = FacilityCredential::where('facility_id', $id)->first();
        $ocAddress = OcAddress::select('company', 'customer_facility_id', 'address_id')->orderBy('company')->get();
        if (!$facilityCredential) {
            session()->flash('error', 'Facility EHR credentials Not Found');
            return redirect('/admin/facilities/index');
        }
        if (!$ocAddress) {
            session()->flash('error', 'Oc Address Not Found');
            return redirect('/admin/facilities/index');
        }
        $data = compact('facilityCredential', 'ocAddress');
        return view('admin.facilitiesCredential.edit')->with($data);
    }

    /**
     * Update Facility Credential
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id  facility credential id
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'ehr_client_id' => 'required',
            'facility_hl7_id' => 'required',
            'address_id' => 'required',
            'ehr_metadata_endpoint' => 'required|url',
            'ehr_authorize_endpoint' => 'required|url',
            'ehr_token_endpoint' => 'required|url',
            'ehr_fhir_endpoint' => 'required|url'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $facility_credential = FacilityCredential::find($id);
        $facility_credential->ehr_client_id = request('ehr_client_id');
        $facility_credential->ehr_metadata_endpoint = request('ehr_metadata_endpoint');
        $facility_credential->facility_hl7_id = request('facility_hl7_id');
        $facility_credential->address_id = request('address_id');
        $facility_credential->ehr_authorize_endpoint = request('ehr_authorize_endpoint');
        $facility_credential->ehr_token_endpoint = request('ehr_token_endpoint');
        $facility_credential->ehr_fhir_endpoint = request('ehr_fhir_endpoint');
        $OcAddressData = OcAddress::find(request('address_id'));
        $facility_credential->facility_internal_id = $OcAddressData->customer_facility_id;
        $facility_credential->save();
        $facility_credential->update($request->all());
        session()->flash('success', 'Facility EHR credentials updated Successfully.');
        return redirect('/admin/facilities/index');
    }
}
