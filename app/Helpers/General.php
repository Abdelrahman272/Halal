<?php


function renderImage($path)
{
    return $path->photoable()->first() != null ? asset($path->photoable()->first()->src) : asset('uploads/categories/image-placeholder-base.png');
}
