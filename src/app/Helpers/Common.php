<?php

function handleUpload($namaFile,$namaFolder){
    if (isset($namaFolder)){
        $namaFolder = str_replace(' ','-',$namaFolder);
    }
    else{
        $namaFolder = 'media-all';
    }

    if (isset($namaFile)){
        $md5 = md5(date('Y-m-d- H:i:s').$namaFile->getClientOriginalName());
        $namaFileUpload = $namaFolder.'/'.'djati-'.substr($md5,0,7).'.'.$namaFile->getClientOriginalExtension();
        \Storage::disk('local')->putFileAs('/', $namaFile, $namaFileUpload);
        return $namaFileUpload;
    }
    else{
        return false;
    }
}

?>