<?php

namespace App\Constants;

class AppConstants{

    public const FILETYPE = 'xlsx';
    public const FILEPATH = '/google-drive';
    public const DISK = 'local';
    public const GET = 'get';
    public const RESPONSETYPE = 'application/json';
    public const DRIVEAPIBASEURL = 'https://www.googleapis.com/drive/v3/files';
    public const DISABLEDMIMETYPES = [
        'audio/mpeg',
        'image/jpeg',
        'application/vnd.google-apps.folder',
        'application/zip'
    ];
    public const ENABLEDMIMETYPES = [
        'application/vnd.google-apps.document'     => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.google-apps.spreadsheet'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.google-apps.drawing'      => 'application/pdf',
        'application/vnd.google-apps.presentation' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.google-apps.script'       => 'application/vnd.google-apps.script+json',
        'default'                                  => 'application/pdf'
    ];
}
