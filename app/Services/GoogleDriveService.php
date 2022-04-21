<?php

namespace App\Services;

use App\Constants\AppConstants;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    private string $url;
    private array $headers;

    public function __construct()
    {
        $this->headers = [
            'Authorization' => 'Bearer '.config('filesystems.disks.google.accessToken'),
            'Accept' => AppConstants::RESPONSETYPE
        ];
    }

    /**
     * @return void
     */

    public function getAndSaveFiles(): void
    {
        $this->setUrl(AppConstants::DRIVEAPIBASEURL);
        $listFiles = $this->request(AppConstants::GET);
        $listFiles = json_decode($listFiles);
        foreach ($listFiles->files as $file){
            $fileMimeType = $this->getFileMimeType($file->mimeType);
            if (!$fileMimeType) continue;
            $fileContent = $this->getSingleFileContent($file->id, $fileMimeType, AppConstants::GET);
            $this->putStorage($file->name, $fileContent);
        }
    }

    /**
     * @param string $url
     *
     * @return void
     */

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param string $fileId
     * @param string $mimeType
     * @param string $type
     *
     * @return false|mixed
     */

    public function getSingleFileContent(string $fileId, string $mimeType, string $type): mixed
    {
        $mimeType = str_replace('/', '%2F', $mimeType);
        $url = AppConstants::DRIVEAPIBASEURL.'/'.$fileId.'/export?mimeType='.$mimeType;
        $this->setUrl($url);
        return $this->request($type);
    }

    /**
     * @param string $type
     *
     * @return false|mixed
     */

    public function request(string $type): mixed
    {
        $response = Http::withHeaders($this->headers)->$type($this->url);
        if($response->status() === 200){
            return $response->body();
        }else{
            return false;
        }
    }

    /**
     * @param string $mimeType
     *
     * @return false|string
     */

    public function getFileMimeType(string $mimeType): bool|string
    {
        if(in_array($mimeType, AppConstants::DISABLEDMIMETYPES)){
            return false;
        }
        elseif(isset(AppConstants::ENABLEDMIMETYPES[$mimeType])) {
            return AppConstants::ENABLEDMIMETYPES[$mimeType];
        }else{
            return $mimeType;
        }
    }

    /**
     * @param string $fileName
     * @param $content
     *
     * @return void
     */

    public function putStorage(string $fileName, $content): void
    {
        $fileName = AppConstants::FILEPATH. '/'. $fileName . '.' .AppConstants::FILETYPE;
        Storage::disk(AppConstants::DISK)->put($fileName, $content);
    }
}
