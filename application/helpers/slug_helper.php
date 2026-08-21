<?php

function create_slug($string)
{
    $slug = strtolower($string);

    // hapus karakter selain huruf dan angka
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $slug);

    // hapus double dash
    $slug = preg_replace('/-+/', '-', $slug);

    return trim($slug, '-');
}
