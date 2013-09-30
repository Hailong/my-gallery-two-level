<?php

function mg_is_image_file($filename)
{
    $ext = substr($filename, -4);
    if (!in_array($ext, array('.jpg'))) {
        return FALSE;
    }

    return TRUE;
}
