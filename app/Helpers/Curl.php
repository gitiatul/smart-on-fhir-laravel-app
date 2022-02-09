<?php

/**
 * HTTP GET request using cURL
 *
 * @param String $url Request endpoint
 * @param Array $httpHeaders Request headers
 * @param String $httpMethod HTTP Method. Default is set to `GET`
 *
 * @return JSON HTTP response in json format
 */
function getCurl($url, $httpHeaders, $httpMethod = "GET")
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $httpMethod,
        CURLOPT_HTTPHEADER => $httpHeaders,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $responseJson = json_decode($response, true);
    return $responseJson;
}

/**
 * HTTP POST request using cURL
 *
 * @param String $url Request endpoint
 * @param Array $httpHeaders Request headers
 * @param String $httpMethod HTTP Method. Default is set to `POST`
 * @param String $postFields Body parameters to be sent in request body.
 *
 * @return JSON HTTP response in json format
 */
function postCurl($url, $httpHeaders, $httpMethod = "POST", $postFields = null)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $httpMethod,
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => $httpHeaders,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $responseJson = json_decode($response, true);
    return $responseJson;
}
