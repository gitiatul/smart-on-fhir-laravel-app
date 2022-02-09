<?php

namespace App\Http\Controllers\EpicControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Facility;
use App\Models\FacilityCredential;
use App\Models\EpicCalPeople;
use App\Models\EpicProvider;
use Illuminate\Support\Str;
use Exception;


class SmartController extends Controller
{
    /**
     * @var String Epic application scope
     */
    protected $EPIC_APP_SCOPE = "launch openid Patient.Read (R4)";
    /**
     * @var String SMART-on-FHIR redirect endpoint
     */
    protected $EPIC_REDIRECT_URL = "/epic/callback";

    /**
     * @var String Epic response type
     */
    protected $EPIC_RESPONSE_TYPE = "code";
    /**
     * @var String Epic grant type
     */
    protected $EPIC_GRANT_TYPE = "authorization_code";
    /**
     * @var Array Gender
     */
    protected $GENDER = [
        "male" => "1",
        "female" => "2",
        "other" => "3",
        "unknown" => "4",
        "not available" => "5",
        "not applicable" => "6",
    ];

    /**
     * Epic launch
     *
     * @param  \Illuminate\Http\Request  $request
     */
    // epic/launch?launch=123&iss=123-asd-456-qwe-789&appid=0d344894-2a51-431d-a1c8-ec9ade2affed
    public function epicLaunch(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "launch" => "required",
                "iss" =>  "required",
                "appid" => "required"
            ],
            [
                'launch.required' => 'Launch is Required',
                'iss.required' => 'Iss is Required',
                'appid.required' => 'App Id is Required'
            ]
        );

        if ($validator->fails()) {
            session()->flash('epicError', 'Required Fields Are Missing. Request is invalid');
            return view('errors.error');
        }

        $appid = $request->input("appid");
        try {
            $id = Facility::where("facility_app_id", $appid)->first();
            if (!$id) {
                session()->flash('epicError', 'Facility Not Found. Request is invalid');
                return view('errors.error');
            }
            $key = FacilityCredential::where("facility_credentials_id", $id->facility_id)->first();
            if (!$key) {
                session()->flash('epicError', 'Facility Credential Not Found. Request is invalid');
                return view('errors.error');
            }
            $authorizeEndpoint = $key->ehr_authorize_endpoint;
            $scope = $this->EPIC_APP_SCOPE;
            $responseType = $this->EPIC_RESPONSE_TYPE;
            $redirectUri = url($this->EPIC_REDIRECT_URL);
            $clientId = $key->ehr_client_id;
            $launchToken = $request->input("launch");
            $fhirendpoint = $key->ehr_fhir_endpoint;
            $state = Str::uuid();

            session()->forget(["LAUNCH_STATE", "FACILITY_CREDS_ID"]);
            $request->session()->put('LAUNCH_STATE', $state);
            $request->session()->put('FACILITY_CREDS_ID', $key->facility_credentials_id);

            $redirectPath = $authorizeEndpoint . "?scope=" . $scope . "&response_type=" . $responseType . "&redirect_uri=" . $redirectUri . "&client_id=" . $clientId . "&launch=" . $launchToken . "&state=" . $state . "&aud=" . $fhirendpoint;
            return redirect($redirectPath);
        } catch (\Illuminate\Database\QueryException $ex) {
            session()->flash('epicError', 'Please Contact To Admin');
            return view('errors.error');
        } catch (Exception $error) {
            session()->flash('epicError', 'App Id Not Found. Request is invalid');
            return view('errors.error');
        }
    }


    /**
     * Epic callback
     *
     * @param  \Illuminate\Http\Request  $request
     */
    // epic/callback?code=123&state=123-asd-456-qwe-789
    public function epicCallback(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "code" => "required",
                "state" =>  "required"
            ],
            [
                'code.required' => 'Code is Required',
                'state.required' => 'State is Required',
            ]
        );

        if ($validator->fails()) {
            session()->flash('epicError', 'Required Fields Are Missing. Request is invalid');
            return view('errors.error');
        }

        $stateFromLaunch = $request->session()->get('LAUNCH_STATE');
        $facilityCredsId = $request->session()->get('FACILITY_CREDS_ID');
        session()->forget(["LAUNCH_STATE", "FACILITY_CREDS_ID"]);

        $state = $request->input("state");
        if ($stateFromLaunch != $state) {
            session()->flash('epicError', 'State from launch & callback do not match. Request is invalid');
            return view('errors.error');
            die;
        }
        try {
            $key = FacilityCredential::where("facility_credentials_id", $facilityCredsId)->first();
            if (!$key) {
                session()->flash('epicError', 'Facility Credential Not Found. Request is invalid');
                return view('errors.error');
            }
            $tokenEndpoint =  $key->ehr_token_endpoint;
            $clientId = $key->ehr_client_id;
            $redirectUri = url($this->EPIC_REDIRECT_URL);
            $grantType = $this->EPIC_GRANT_TYPE;
            $authCode = $request->input("code");
            $httpMethod = 'POST';
            $httpHeaders = [
                "Content-Type: application/x-www-form-urlencoded"
            ];
            $postFields = 'grant_type=' . $grantType . '&code=' . $authCode . '&redirect_uri=' . $redirectUri . '&client_id=' . $clientId;
            $responseJson = postCurl($tokenEndpoint, $httpHeaders, $httpMethod, $postFields);
        } catch (\Illuminate\Database\QueryException $ex) {
            session()->flash('epicError', 'Please Contact To Admin');
            return view('errors.error');
        } catch (Exception $e) {
            session()->flash('epicError', 'Request is invalid');
            return view('errors.error');
        }
        try {
            $fhirendPoint = $key->ehr_fhir_endpoint;
            $httpMethod = 'GET';
            $epicAccessToken = $responseJson['access_token'];
            $ProviderFhirId = $responseJson['EpicUserFhirId'];
            $httpHeaders = [
                "Authorization: Bearer " . $epicAccessToken,
                "Accept: application/fhir+json"
            ];
            // Practitioner
            $practitionerReadUrl = $fhirendPoint . "/Practitioner/" . $ProviderFhirId;
            $providerArr = getCurl($practitionerReadUrl, $httpHeaders);

            $providerFacilityId = $key->facility_id;
            $getData = Facility::where("facility_id", $providerFacilityId)->first();
            $providerFacilityName = $getData->facility_name;
            $providerNPI = extractProviderNPI($providerArr);
            $providerName = extractName($providerArr);
            $providerFirstName = $providerName["first"];
            $providerLastName = $providerName["last"];
            $providerSuffix = $providerName["suffix"];
            $providerPrefix = $providerName["prefix"];
            $providerEmail = extractEmail($providerArr);
            $providerMobile = extractMobile($providerArr);
            $providerSecPhone = extractPhone($providerArr);

            $providerArray = [];
            $providerArray['firstname'] = $providerFirstName;
            $providerArray['lastname'] = $providerLastName;
            $providerArray['suffix'] = $providerSuffix;
            $providerArray['prefix'] = $providerPrefix;
            $providerArray['npi'] = $providerNPI;
            $providerArray['fhirid'] = $ProviderFhirId;
            $providerArray['email'] = $providerEmail;
            $providerArray['mobile'] = $providerMobile;
            $providerArray['secphone'] = $providerSecPhone;
            $providerArray['facilityid'] = $providerFacilityId;
            $providerArray['facilityname'] = $providerFacilityName;

            $providerFlag = 0;
            $patientFlag = 0;
            $PractitionerData = EpicProvider::where("P_FHIR_ID", $ProviderFhirId)->first();
            if (!$PractitionerData) {
                $getData = EpicProvider::where("P_FNAME", $providerFirstName)->where("P_LNAME", $providerLastName)->where("P_NPI", $providerNPI)->first();
                if (!$getData) {
                    $providerFlag = 1;
                    $providerPUID = null;
                } else {
                    $getData->update(["P_FHIR_ID" => $ProviderFhirId]);
                    $providerPUID = $getData->P_UID;
                }
            } else {
                $providerPUID = $PractitionerData->P_UID;
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            session()->flash('epicError', 'Please Contact To Admin');
            return view('errors.error');
        } catch (Exception $e) {
            session()->flash('epicError', 'Practitioner Request is invalid');
            return view('errors.error');
        }
        try {

            //Patient
            $patientFhirId = $responseJson['patient'];
            $patientReadUrl = $fhirendPoint . "/Patient/" . $patientFhirId;
            $patientArr = getCurl($patientReadUrl, $httpHeaders);

            $patientName = extractName($patientArr);
            $patientFirstName = $patientName['first'];
            $patientLastName = $patientName['last'];
            $patientMedName = $patientName['med'];
            $patientEmail = extractEmail($patientArr);
            $patientMobile = extractMobile($patientArr);
            $patientDob = extractPatientDob($patientArr);
            $patientGender = extractPatientGender($patientArr);
            $patientPhonehome = extractPhone($patientArr);
            $patientAddress = extractAddress($patientArr);
            $patientCity = $patientAddress['city'];
            $patientState = $patientAddress['state'];
            $patientCounty = $patientAddress['county'];
            $patientStreet = $patientAddress['street'];
            $patientPostalcode = $patientAddress['postal_code'];
            $patientCountrycode = $patientAddress['country_code'];
            $patientDeceasedBoolean = extractDeceasedBoolean($patientArr);

            //Creating PatientArray
            $patientArray = [];
            $patientArray['firstname'] = $patientFirstName;
            $patientArray['lastname'] = $patientLastName;
            $patientArray['med'] = $patientMedName;
            $patientArray['fhirid'] = $patientFhirId;
            $patientArray['email'] = $patientEmail;
            $patientArray['mobile'] = $patientMobile;
            $patientArray['phonehome'] = $patientPhonehome;
            $patientArray['gender'] = $patientGender;
            $patientArray['dob'] = $patientDob;
            $patientArray['city'] = $patientCity;
            $patientArray['state'] = $patientState;
            $patientArray['county'] = $patientCounty;
            $patientArray['street'] = $patientStreet;
            $patientArray['postal_code'] = $patientPostalcode;
            $patientArray['country_code'] = $patientCountrycode;
            $patientArray['deceased'] = $patientDeceasedBoolean;

            $patientGenderValue = $this->GENDER[$patientGender];

            $PatientData = EpicCalPeople::where("p_fhir_id", $patientFhirId)->first();
            if (!$PatientData) {
                $patientchecker = EpicCalPeople::where("p_fname", $patientFirstName)->where("p_lname", $patientLastName)->where("p_dob", $patientDob)->where("p_gender", $patientGenderValue)->first();
                if (!$patientchecker) {
                    //create new patient
                    $patientFlag = 1;
                    $patientPUID = null;
                } else {
                    $patientchecker->update(["p_fhir_id" => $patientFhirId]);
                    $patientPUID = $patientchecker->p_UID;
                }
            } else {
                $patientPUID = $PatientData->p_UID;
            }
            return view('epic.create', compact('patientArray', 'providerArray', 'providerFlag', 'patientFlag', 'providerPUID', 'patientPUID'));
        } catch (\Illuminate\Database\QueryException $ex) {
            session()->flash('epicError', 'Please Contact To Admin');
            return view('errors.error');
        } catch (Exception $e) {
            session()->flash('epicError', 'Patient Request is invalid');
            return view('errors.error');
        }
    }

    /**
     * Store Provider Data
     * @param  \Illuminate\Http\Request  $request
     */
    public function providerStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'P_FNAME' =>  'required',
                'P_LNAME' =>  'required',
                'P_email' =>  'required|email',
                'P_SMS' =>  'required|digits:10',
                'P_NPI' => 'required'
            ],
            [
                'P_LNAME.required' => 'Last Name is Required',
                'P_FNAME.required' => 'First Name is Required',
                'P_email.required' => 'Email is Required',
                'P_email.email' => 'Email is not valid',
                'P_SMS.required'   => 'Mobile Number is Required',
                'P_SMS.digits'   => 'Mobile Number is not valid',
                'P_NPI.required'   => 'NPI is Required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $providerData = [
            "P_FNAME" => request("P_FNAME"),
            "P_LNAME" => request("P_LNAME"),
            "P_SUFFIX" => request("P_SUFFIX"),
            "P_SALUTE" => request("P_SALUTE"),
            "P_email" => request("P_email"),
            "P_SMS" => request("P_SMS"),
            "P_NPI" => request("P_NPI"),
            "P_PID" => "0",
            "P_ID" => Str::uuid(),
            "P_FHIR_ID" => request("P_FHIR_ID"),
            "P_PSID" => null,
            "P_PHONETIC" =>  "*****",
            "P_FACILITY" => request("P_FACILITY"),
            "P_FACILITY_ID" => request("P_FACILITY_ID"),
            "P_code" => null,
            "P_active" => "1",
            "P_appt" => "1",
            "P_sec_phone" => request("P_sec_phone"),
            "password" => null,
            "salt" => null,
            "P_TM_room" => null,
            "P_IMG" => null,
            "P_order_UID" => "0",
        ];
        try {
            $provider = EpicProvider::create($providerData);
            $providerPUID = $provider->P_UID;
            return response()->json(['success' => true, 'status' => 1, 'providerPUID' => $providerPUID]);
        } catch (\Illuminate\Database\QueryException $ex) {
            session()->flash('epicError', 'Please Contact To Admin');
            return view('errors.error');
        } catch (Exception $error) {
            session()->flash('epicError', 'Provider Creation Error');
            return view('errors.error');
        }
    }

    /**
     * Store Patient Data
     * @param  \Illuminate\Http\Request  $request
     */
    public function patientStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'p_fname' =>  'required',
                'p_lname' =>  'required',
                'p_email' =>  'required|email',
                'p_phone_cell' =>  'required|digits:10',
                'p_dob' => 'required|date',
                'p_gender' => 'required'
            ],
            [
                'p_fname.required' => 'First Name is Required',
                'p_lname.required' => 'Last Name is Required',
                'p_email.required' => 'Email is Required',
                'p_email.email' => 'Email is not valid',
                'p_phone_cell.required'   => 'Phone Number is Required',
                'p_phone_cell.digits'   => 'Phone Number is not valid',
                'p_dob.required'   => 'Date Of Birth is Required',
                'p_dob.date'   => 'Date Of Birth is not valid',
                'p_gender.required'   => 'Gender is Required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $patientData = [
            "p_fname" => request("p_fname"),
            "p_lname" => request("p_lname"),
            "p_email" => request("p_email"),
            "p_phone_cell" => request("p_phone_cell"),
            "p_dob" => request("p_dob"),
            "p_gender" => request("p_gender"),
            "p_PRACTID" => "0",
            "p_pid" => "0",
            "p_fhir_id" => request("p_fhir_id"),
            "p_mname" => request("p_mname"),
            "p_phone_home" => request("p_phone_home"),
            "p_street" => request("p_street"),
            "p_city" => request("p_city"),
            "p_county" => request("p_county"),
            "p_state" => request("p_state"),
            "p_postal_code" => request("p_postal_code"),
            "p_country_code" => request("p_country_code"),
            "p_allow_sms" => "YES",
            "p_allow_avm" => "YES",
            "p_allow_email" => "YES",
            "p_deceased" => request("p_deceased"),
            "p_language" => "en",
            "p_allow_surveys" => "1",
            "p_last_CAPHS" => null,
            "needs_verification" => null,
            "last_json" => null,

        ];
        try {
            $patient = EpicCalPeople::create($patientData);
            $patientPUID = $patient->p_UID;
            return response()->json(['success' => true, 'status' => 1, 'patientPUID' => $patientPUID]);
        } catch (\Illuminate\Database\QueryException $ex) {
            session()->flash('epicError', 'Please Contact To Admin');
            return view('errors.error');
        } catch (Exception $error) {
            session()->flash('epicError', 'Patient Creation Error');
            return view('errors.error');
        }
    }
}
