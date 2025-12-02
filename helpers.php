<?php

function base_url($path = '') {

    $protocol = isset($_SERVER['HTTP']) && $_SERVER['HTTPS'] !== "off" ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];

    $baseUrl = $protocol . $host;

    return $baseUrl . '/' . ltrim($path, '/');
}