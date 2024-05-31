<?php

namespace inc\v1\mime_type;


class MimeType
{
    public static function getMimeType($extension): string
    {
        return match ($extension) {
            "html", "php" => "text/html",
            "css" => "text/css",
            "js" => "application/javascript",
            "json" => "application/json",
            "png" => "image/png",
            "jpeg", "jpg" => "image/jpeg",
            "gif" => "image/gif",
            "svg" => "image/svg+xml",
            "ico" => "image/x-icon",
            "xml" => "text/xml",
            "m4v", "mp4" => "video/mp4",
            "mp2", "mpega", "mpga", "m2a", "mp3" => "audio/mpeg",
            "ogg" => "audio/ogg",
            "wav" => "audio/wav",
            "webm" => "video/webm",
            "pdf" => "application/pdf",
            "doc" => "application/msword",
            "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "xls" => "application/vnd.ms-excel",
            "xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "ppt" => "application/vnd.ms-powerpoint",
            "pptx" => "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "zip" => "application/zip",
            "rar" => "application/x-rar-compressed",
            "7z" => "application/x-7z-compressed",
            "tar" => "application/x-tar",
            "gz" => "application/x-gzip",
            "bz2" => "application/x-bzip2",
            "m4b", "m4p", "m4a" => "audio/mp4",
            "qt", "mov" => "video/quicktime",
            "avi" => "video/x-msvideo",
            "wmv" => "video/x-ms-wmv",
            "ogv" => "video/ogg",
            "m2ts", "mpeg", "m2v", "m2p", "m2t", "mpg" => "video/mpeg",
            default => "text/plain"
        };
    }

    public static function setContentTypeHeader($mime)
    {
        header("Content-Type: $mime");
    }
}