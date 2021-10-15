<?php

$text = '
<div class="' . $data['col_width'] . '">
     @include("admin.dropzone",[
    "thumbnailWidth"=>"80",
    "thumbnailHeight"=>"80",
    "parallelUploads"=>"20",
    "maxFiles"=>"30",
    "maxFileSize"=>"",
    "acceptedMimeTypes"=>it()->acceptedMimeTypes("' . $data['file_type'] . '"),
    "autoQueue"=>true,
    "dz_param"=>"{Convention}",
    "type"=>"create",
    "route"=>"' . $data['route'] . '",
    "path"=>"' . $data['route'] . '",
    ])
</div>
';

$text = str_replace('{Convention}', $data['col_name_convention'], $text);
$text = str_replace('{lang}', $data['lang_file'], $text);
echo $text;
?>