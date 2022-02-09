<?php

/**
 * Extract provider & patient name from Name array of practitioner and patient fhir r4 resource
 *
 * @param  Array  $Arr Name array extracted from practitioner and patient fhir r4 resource
 *
 * @return Array Patient and Provider Name
 */
function extractName($Arr)
{
    $name = [
        "first" => null,
        "med" => null,
        "last" => null,
        "prefix" => null,
        "suffix" => null,
    ];

    if (!array_key_exists('name', $Arr)) {
        // name array not found
        return $name;
    }

    $nameArr = $Arr['name'];
    $nameNew =  array_column($nameArr, 'use');
    array_unshift($nameNew, " ");
    $nameIndex = 0;

    // check for official
    if (array_search('official', $nameNew)) {
        $nameIndex = array_search('official', array_column($nameArr, 'use'));
    } else if (array_search('usual', $nameNew)) {
        // if official not found, then check for usual
        $nameIndex = array_search('usual', array_column($nameArr, 'use'));
    }

    $providerName = $nameArr[$nameIndex];
    if (array_key_exists('given', $providerName)) {
        $name['first'] = $providerName['given'][0];
        (isset($providerName['given'][1])) ? $name['med'] = $providerName['given'][1] : null;
    }
    if (isset($providerName['family'])) {
        $name['last'] = $providerName['family'];
    }
    if (array_key_exists('prefix', $providerName)) {
        $name["prefix"] = $providerName['prefix'][0];
    }
    if (array_key_exists('suffix', $providerName)) {
        $name["suffix"] = $providerName['suffix'][0];
    }
    return $name;
}

/**
 * Extract Patient and Provider Email from Telecom array of practitioner and patient fhir r4 resource
 *
 * @param  Array  $Arr Email array extracted from practitioner and patient fhir r4 resource
 *
 * @return String Patient and Provider Email
 */
function extractEmail($Arr)
{
    $email = null;

    if (!array_key_exists('telecom', $Arr)) {
        return $email;
    }
    $emailArr = $Arr['telecom'];
    $emailNew = array_column($emailArr, 'system');
    array_unshift($emailNew, " ");

    $emailIndex = 0;
    if (array_search('email', $emailNew)) {
        $emailIndex = array_search('email', array_column($emailArr, 'system'));
        $emailName = $emailArr[$emailIndex];
        if (isset($emailName['value'])) {
            $email = $emailName['value'];
        }
    }
    return $email;
}

/**
 * Extract Patient and Provider Mobile from Telecom array of practitioner and patient fhir r4 resource
 *
 * @param  Array  $Arr Telecom array extracted from practitioner and patient fhir r4 resource
 *
 * @return String Patient and Provider Mobile
 */
function extractMobile($Arr)
{
    $mobile = null;

    if (!array_key_exists('telecom', $Arr)) {
        return $mobile;
    }

    $mobileArr = $Arr['telecom'];
    $mobileIndex = 0;
    $mobileNew = array_column($mobileArr, 'system');
    array_unshift($mobileNew, " ");

    if (array_search('sms', $mobileNew)) {
        $mobileIndex = array_search('sms', $mobileNew);
        $mobileUse = array_column($mobileArr, 'use');
        array_unshift($mobileUse, " ");
        if (array_search('mobile', $mobileUse)) {
            $mobileIndex = $mobileIndex - 1;
            $mobileName = $mobileArr[$mobileIndex];
            if (isset($mobileName['value'])) {
                $mobile = $mobileName['value'];
            }
        }
    }

    return $mobile;
}

/**
 * Extract Patient and Provider Phone from Telecom array of practitioner and patient fhir r4 resource
 *
 * @param  Array  $Arr Telecom array extracted from practitioner and patient fhir r4 resource
 *
 * @return String Patient and Provider Phone
 */
function extractPhone($Arr)
{
    $Phone = null;

    if (!array_key_exists('telecom', $Arr)) {
        return $Phone;
    }
    $phoneArr = $Arr['telecom'];
    $phoneIndex = 0;
    $phoneNew = array_column($phoneArr, 'system');
    array_unshift($phoneNew, " ");
    if (array_search('phone', $phoneNew)) {
        $phoneIndex = array_search('phone', $phoneNew);
        $phoneUse = array_column($phoneArr, 'use');
        array_unshift($phoneUse, " ");
        if (array_search('home', $phoneUse)) {
            $phoneIndex = $phoneIndex - 1;
            $phoneName = $phoneArr[$phoneIndex];
            if (isset($phoneName['value'])) {
                $Phone = $phoneName['value'];
            }
        }
    }
    return $Phone;
}
