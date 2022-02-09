<?php

/**
 * Extract Patient Dob from patientArr array of patient fhir r4 resource
 *
 * @param  Array  $patientArr array extracted from patient fhir r4 resource
 *
 * @return String Patient Dob
 */
function extractPatientDob($patientArr)
{

    (isset($patientArr['birthDate'])) ? $patientDob = $patientArr['birthDate'] : $patientDob = null;
    return $patientDob;
}

/**
 * Extract Patient Gender from patientArr array of patient fhir r4 resource
 *
 * @param  Array  $patientArr array extracted from patient fhir r4 resource
 *
 * @return String Patient Gender
 */
function extractPatientGender($patientArr)
{

    (isset($patientArr['gender'])) ? $patientGeneder = $patientArr['gender'] : $patientGeneder = null;
    return $patientGeneder;
}

/**
 * Extract Patient Address from patientArr array of patient fhir r4 resource
 *
 * @param  Array  $patientArr array extracted from patient fhir r4 resource
 *
 * @return Array Patient Address
 */
function extractAddress($patientArr)
{
    $address = [
        "city" => null,
        "state" => null,
        "county" => null,
        "street" => null,
        "postal_code" => null,
        "country_code" => null,
    ];

    if (!array_key_exists('address', $patientArr)) {
        // name array not found
        return $address;
    }

    $addrArr = $patientArr['address'];
    $addrNew = array_column($addrArr, 'use');
    array_unshift($addrNew, " ");
    $addrIndex = 0;

    // check for official
    if (array_search('home', $addrNew)) {
        $addrIndex = array_search('home', array_column($addrArr, 'use'));
    }

    $addrName = $addrArr[$addrIndex];
    if (array_key_exists('line', $addrName)) {
        $address['street'] = $addrName['line'][0];
    }
    (isset($addrName['state'])) ?  $address['state'] = $addrName['state'] : null;
    (isset($addrName['city'])) ?   $address['city'] = $addrName['city'] : null;
    (isset($addrName['postalCode'])) ? $address['postal_code'] = $addrName['postalCode'] :  null;
    (isset($addrName['district'])) ?  $address['county'] = $addrName['district'] : null;
    (isset($addrName['country'])) ?    $address['country_code'] = $addrName['country'] : null;

    return $address;
}

/**
 * Extract Patient Deceased from patientArr array of patient fhir r4 resource
 *
 * @param  Array  $patientArr array extracted from patient fhir r4 resource
 *
 * @return String Patient Deceased
 */
function extractDeceasedBoolean($patientArr)
{
    $patientDecease = null;
    if (empty($patientArr['deceasedBoolean'])) {
        return null;
    }
    if (!(isset($patientArr['deceasedBoolean'])) && (isset($patientArr['deceasedDateTime']))) {
        return null;
    }

    $patientDecease = $patientArr['deceasedBoolean'];
    if ($patientDecease == "false") {
        return null;
    }
    $patientDecease = $patientArr['deceasedDateTime'];

    return $patientDecease;
}
