<?php

$directoryPHP_CLOUD = BASE_DIRECTORY.'backups_temp';

if (isset($uploadDirectory)) {
    $directoryPHP_CLOUD = $uploadDirectory;
}
return [
    'local' => [
        'type' => 'Local',
        'root' => $directoryPHP_CLOUD,
     ],
    's3' => [
        'type'    => 'AwsS3',
        'key'     => '',
        'secret'  => '',
        'region'  => 'us-east-1',
        'version' => 'latest',
        'bucket'  => '',
        'root'    => '',
    ],
    'gcs' => [
        'type'    => 'Gcs',
        'key'     => '',
        'secret'  => '',
        'version' => 'latest',
        'bucket'  => '',
        'root'    => '',
    ],
    'dropbox-v2' => [
        'type'   => 'DropboxV2',
        'token'  => '',
        'key'    => '',
        'secret' => '',
        'app'    => '',
        'root'   => '',
    ],
    'dropbox-v1' => [
        'type'   => 'DropboxV1',
        'token'  => '',
        'key'    => '',
        'secret' => '',
        'app'    => '',
        'root'   => '',
     ],
    'ftp' => [
        'type'     => 'Ftp',
        'host'     => '',
        'username' => '',
        'password' => '',
        'root'     => '',
        'port'     => 21,
        'passive'  => true,
        'ssl'      => true,
        'timeout'  => 30,
    ],
    'sftp' => [
        'type'       => 'Sftp',
        'host'       => '',
        'username'   => '',
        'password'   => '',
        'root'       => '',
        'port'       => 21,
        'timeout'    => 10,
        'privateKey' => '',
    ],
];
