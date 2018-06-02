<?php
namespace App\Repositories\Common;

use FwSwoole\Core\Tool\Dir;

class FileRepository extends BaseRepository
{

    const TYPE_IMAGE         = 'IMAGE';
    // 用户头像
    const TYPE_USER_FACE     = 'USER_FACE';
    // 文章内容图片
    const TYPE_ARTICLE_IMAGE = 'ARTICLE_IMAGE';
    // 文章缩略图
    const TYPE_ARTICLE_THUMBNAIL = 'ARTICLE_THUMBNAIL';

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
        'USER_FACE' => '/public/images/face/',
        'ARTICLE_IMAGE' => '/public/images/articleContent/',
        'ARTICLE_THUMBNAIL' => '/public/images/articleThumbnail/',
    ];

    public function upload($type, $file)
    {
        $type = strtoupper($type);
        switch ($type) {
            case self::TYPE_IMAGE:
                # code...
                break;

            case self::TYPE_ARTICLE_IMAGE:
                $result = $this->uploadImage($file['image'], $this->uploadFileDirConfig[$type]);
                break;

            case self::TYPE_ARTICLE_THUMBNAIL:
                $result = $this->uploadImage($file['file'], $this->uploadFileDirConfig[$type]);
                break;

            case self::TYPE_USER_FACE:
                # code...
                break;

            default:
                # code...
                break;
        }
        return $result;
    }

    public function uploadImage($file, $relativeSaveDir)
    {
        if (count($file) === 1 && $file['error'] > 0) {
            return ['code' => ['file', $this->codeMessage[$file['error']]]];
        }
        $imageSuffix   = explode('.', $file["name"])[1];
        $saveImageName = generateRandomSha1() . '.' . $imageSuffix;
        $reallySaveDir       = FWSWOOLE_ROOT . $relativeSaveDir;
        if (!is_dir($reallySaveDir)) {
            Dir::make($reallySaveDir);
        }
        $reallySaveFile   = $reallySaveDir . $saveImageName;
        $relativeSaveFile = $relativeSaveDir . $saveImageName;
        while (file_exists($reallySaveFile)) {
            $saveImageName = generateRandomSha1() . '.' . $imageSuffix;
            $reallySaveFile      = $reallySaveDir . $saveImageName;
            $relativeSaveFile    = $relativeSaveDir . $saveImageName;
        }
        move_uploaded_file($file["tmp_name"], $reallySaveFile);
        return $result = [
            'message' => ['file', '1001'],
            'url'     => $relativeSaveFile,
        ];
    }
}
