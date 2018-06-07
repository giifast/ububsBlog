<?php
namespace App\Repositories\Common;

class FileRepository extends BaseRepository
{

    const IMAGE_TYPE = 'image';
    const FILE_TYPE  = 'file';

    // 错误提示信息
    private $codeMessage = [
        1 => 'UPLOAD_ERR_INI_SIZE',
        2 => 'UPLOAD_ERR_FORM_SIZE',
        3 => 'UPLOAD_ERR_PARTIAL',
        4 => 'UPLOAD_ERR_NO_FILE',
        5 => 'UPLOAD_ERR_NO_TMP_DIR',
        6 => 'UPLOAD_ERR_CANT_WRITE',
    ];

    // 上传文件对应路径
    private $uploadFileDirConfig = [
        'user-face'         => '/public/images/face/',
        'article-content'   => '/public/images/articleContent/',
        'article-thumbnail' => '/public/images/articleThumbnail/',
        'website-about'     => '/public/images/websiteAbout/',
        'website-thumbnail' => '/public/images/websiteThumbnail/',
    ];

    public function upload($type, $module, $file)
    {
        $savePath = '/public/common/';
        if (isset($this->uploadFileDirConfig[strtolower($module)])) {
            $savePath = $this->uploadFileDirConfig[strtolower($module)];
        }
        $uploadDatas = isset($file['image']) ? $file['image'] : $file['file'];
        switch (strtolower($type)) {
            case self::IMAGE_TYPE:
                $result = $this->uploadImage($uploadDatas, $savePath);
                break;

            case self::FILE_TYPE:
                $result = $this->uploadFile($uploadDatas, $savePath);
                break;

            default:
                # code...
                break;
        }
        return $result;
    }

    public function uploadImage($file, $dir)
    {
        if (count($file) === 1 && $file['error'] > 0) {
            return ['code' => ['file', $this->codeMessage[$file['error']]]];
        }
        $ImgSuffix     = explode('.', $file["name"])[1];
        $sImg          = sha1(date('YmdHis') . uniqid() . rand()) . '.' . $ImgSuffix;
        $reallySaveDir = APP_ROOT . $dir;
        if (!is_dir($reallySaveDir)) {
            dir_make($reallySaveDir);
        }
        $reallySaveFile = $reallySaveDir . $sImg;
        $sDir           = $dir . $sImg;
        while (file_exists($reallySaveFile)) {
            $sImg           = sha1(date('YmdHis') . uniqid() . rand()) . '.' . $ImgSuffix;
            $reallySaveFile = $reallySaveDir . $sImg;
            $sDir           = $dir . $sImg;
        }
        move_uploaded_file($file["tmp_name"], $reallySaveFile);
        return $result = [
            'message' => ['file', '1001'],
            'url'     => $sDir,
        ];
    }
}
