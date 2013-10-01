<?php

function mg_is_image_file($filename)
{
    return preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $filename) ? TRUE : FALSE;
}
