<?php

// https://stackoverflow.com/questions/3697748/fastest-way-to-serve-a-file-using-php
class File {
  static function send($path) {
      // Check if the file exists
      if(!file_exists($path)) {
          header('HTTP/1.0 404 Not Found');
          exit();
      }

      // Set the content-type header
      header('Content-Type: ' . File::mimeType($path));

      // Read the file
      readfile($path);
  }

  static function mimeType($path) {
    preg_match("|\.([a-z0-9]{2,4})$|i", $path, $fileSuffix);

    switch(strtolower($fileSuffix[1])) {
        case 'js' :
            return 'application/x-javascript';
        case 'json' :
            return 'application/json';
        case 'jpg' :
        case 'jpeg' :
        case 'jpe' :
            return 'image/jpg';
        case 'png' :
        case 'gif' :
        case 'bmp' :
        case 'tiff' :
            return 'image/'.strtolower($fileSuffix[1]);
        case 'css' :
            return 'text/css';
        case 'xml' :
            return 'application/xml';
        case 'doc' :
        case 'docx' :
            return 'application/msword';
        case 'xls' :
        case 'xlt' :
        case 'xlm' :
        case 'xld' :
        case 'xla' :
        case 'xlc' :
        case 'xlw' :
        case 'xll' :
            return 'application/vnd.ms-excel';
        case 'ppt' :
        case 'pps' :
            return 'application/vnd.ms-powerpoint';
        case 'rtf' :
            return 'application/rtf';
        case 'pdf' :
            return 'application/pdf';
        case 'html' :
        case 'htm' :
        case 'php' :
            return 'text/html';
        case 'txt' :
            return 'text/plain';
        case 'mpeg' :
        case 'mpg' :
        case 'mpe' :
            return 'video/mpeg';
        case 'mp3' :
            return 'audio/mpeg3';
        case 'wav' :
            return 'audio/wav';
        case 'aiff' :
        case 'aif' :
            return 'audio/aiff';
        case 'avi' :
            return 'video/msvideo';
        case 'wmv' :
            return 'video/x-ms-wmv';
        case 'mov' :
            return 'video/quicktime';
        case 'zip' :
            return 'application/zip';
        case 'tar' :
            return 'application/x-tar';
        case 'swf' :
            return 'application/x-shockwave-flash';
        default :
            if(function_exists('mime_content_type')) {
                $fileSuffix = mime_content_type($path);
            }
            return 'unknown/' . trim($fileSuffix[0], '.');
    }
  }
}
?>