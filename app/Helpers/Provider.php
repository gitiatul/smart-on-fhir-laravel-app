<?php

/**
 * Provider NPI
 */
/**
 * Extract provider npi from identifier array of practitioner fhir r4 resource
 *
 * @param  Array  $Arr Identifier array extracted from practitioner fhir r4 resource
 *
 * @return String Provider NPI
 */
function extractProviderNPI($Arr)
{
    $NPI = null;
    if (!array_key_exists('identifier', $Arr)) {
        return $NPI;
    }
    $npiArr = $Arr['identifier'];
    $npiNew = array_column($npiArr, 'use');
    array_unshift($npiNew, " ");

    $npiIndex = 0;

    // check for official
    if (array_search('official', $npiNew)) {
        $npiIndex = array_search('official', array_column($npiArr, 'use'));
        $npiName = $npiArr[$npiIndex];
        if (array_key_exists('type', $npiName)) {
            if (isset($npiName['type']['text'])) {
                if ($npiName['type']['text'] == "NPI") {
                    $NPI = $npiName['value'];
                }
            }
        }
    } else if (array_search('usual', $npiNew)) {
        $npiIndex = array_search('usual', array_column($npiArr, 'use'));
        $npiName = $npiArr[$npiIndex];
        if (array_key_exists('type', $npiName)) {
            if (isset($npiName['type']['text'])) {
                if ($npiName['type']['text'] == "NPI") {
                    $NPI = $npiName['value'];
                }
            }
        }
    }


    return $NPI;
}
