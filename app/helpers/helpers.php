<?php

use Carbon\Carbon;

/**
 * @param $bytes
 * @param int $precision
 * @return string
 */
function formatedSize($bytes, $precision = 1)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}

/**
 * @param string $message
 * @param mixed  $data
 *
 * @return array
 */
function makeResponse($message, $data)
{
    return [
        'success' => true,
        'data'    => $data,
        'message' => $message,
    ];
}

/**
 * @param string $message
 * @param array  $data
 *
 * @return array
 */
function makeError($message, array $data = [])
{
    $res = [
        'success' => false,
        'message' => $message,
    ];

    if (!empty($data)) {
        $res['data'] = $data;
    }

    return $res;
}

function nl2br_limit($string, $num)
{
    return preg_replace('/\n/', '<br/>', preg_replace('/(\s{' . $num . '})\s+/', '$1', $string));
}

function to_currency_string($number)
{
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    return $formatter->formatCurrency($number, 'USD');
}

function from_decimal_to_cents($number)
{
    return round($number * 100);
}

function from_cents_to_decimal($number)
{
    return round($number / 100, 2);
}