<?php

define(THUMBNAIL_DIR, dirname(__FILE__) . '/images/thumb');
define(SLIDE_DIR, dirname(__FILE__) . '/images/large');
define(DOWNLOAD_DIR, dirname(__FILE__) . '/images/download');

define(THUMBNAIL_URL, 'content/images/thumb/%s');
define(SLIDE_URL, 'content/images/large/%s');
define(DOWNLOAD_URL, 'content/images/download/%s');

define(IMAGE_ELEM,
'
                            <li>
                                <a class="thumb" name="" href="%s" title="">
                                    <img src="%s" alt="" />
                                </a>
                                <div class="caption">
                                    <div class="image-title"></div>
                                    <div class="image-desc"></div>
%s
                                </div>
                            </li>
');

define(DOWNLOAD_ELEM,
'
                                    <div class="download">
                                        <a href="%s">打开大尺寸图</a>
                                    </div>
');

$image_extensions = array('.jpg');
$image_list_cache_file = '/tmp/image_list_' . md5(__FILE__);

$image_list_cache = file_get_contents($image_list_cache_file);

if ($image_list_cache === FALSE || strlen($image_list_cache) < 100) {
    $image_list_cache = '';

    $thumb_files = scandir(THUMBNAIL_DIR);
    $slide_files = scandir(SLIDE_DIR);
    $download_files = scandir(DOWNLOAD_DIR);

    if (is_array($thumb_files) && is_array($slide_files)) {

        foreach ($thumb_files as $name) {
            $ext = substr($name, -4);

            if (in_array($ext, $image_extensions) && in_array($name, $slide_files)) {

                if (in_array($name, $download_files)) {
                    $download_elem = sprintf(DOWNLOAD_ELEM, sprintf(DOWNLOAD_URL, $name));
                } else {
                    $download_elem = '';
                }

                $image_elem = sprintf(IMAGE_ELEM, sprintf(SLIDE_URL, $name), sprintf(THUMBNAIL_URL, $name), $download_elem);
                $image_list_cache .= $image_elem;
            }
        }

        file_put_contents($image_list_cache_file, $image_list_cache);
    }
}

echo $image_list_cache;
