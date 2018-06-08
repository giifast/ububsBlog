<?php

function encryptionWithTime($data, $operation = '', $time = 0)
{
	if (is_array($data)) {
		$data = json_encode($data);
	}
	return authcode($data, '', $operation, $time);
}