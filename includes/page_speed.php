<?php

//To get google page speed score
function get_page_speed_score($url)
{

    $api_key = "416ca0ef-63e4-4caa-a047-ead672ecc874"; // Google Cloud Platform API key
    $result_url = "http://www.webpagetest.org/runtest.php?url=" . $url . "&runs=1&f=xml&k=" . $api_key;
    $run_result = simplexml_load_file($result_url);
    $test_id = $run_result->data->testId;

    $status_code = 100;

    while ($status_code != 200) {
        sleep(10);
        $xml_result = "http://www.webpagetest.org/xmlResult/" . $test_id . "/";
        $result = simplexml_load_file($xml_result);
        $status_code = $result->statusCode;
        $page_speed_score = (float) ($result->data->median->firstView->loadTime) / 1000;
    }
    
    return $page_speed_score;
}
