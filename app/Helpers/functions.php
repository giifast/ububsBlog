<?php

function encryptionWithTime($data, $operation = '', $time = 0)
{
	if (is_array($data)) {
		$data = json_encode($data);
	}
	return authcode($data, '', $operation, $time);
}

function https_request($url, $data = null)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    if (!empty($data)) { //如果有数据传入数据
        curl_setopt($curl, CURLOPT_POST, 1); //CURLOPT_POST 模拟post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); //传入数据
    }

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);

    return $output;
}