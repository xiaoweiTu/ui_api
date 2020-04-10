<?php
/**
 *
 * User: xiaowei<13177839316@163.com>
 * Date: 2020/4/10
 * Time: 11:46
 */

namespace App\Services;


use App\Exception\WrongRequestException;
use App\Model\Blog\BlogSelfIntro;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Upload\UploadedFile;

class SelfIntroService
{

    /**
     * @Inject()
     * @var UploadService
     */
    protected $uploadService;

    public function get()
    {
        return BlogSelfIntro::query()->first();
    }

    /**
     * @param UploadedFile $file
     *
     * @return bool
     * @throws \Exception
     */
    public function upload(UploadedFile $file)
    {

        if (!$file->isValid()) {
            throw new WrongRequestException("文件无效");
        }

        $old = BlogSelfIntro::query()->first();

        $url = $this->uploadService->image($file);
        if ($old) {
            $old->file_path = $url;
            $old->save();
        } else {
            BlogSelfIntro::query()->create([
                'file_path' => $url
            ]);
        }

        return true;
    }

    protected function getFilePath($name)
    {
        $localPath = BASE_PATH . '/storage/files/';
        return $localPath . $name;
    }

    public function editPassword($params)
    {
        return BlogSelfIntro::query()->where('id', $params['id'])->update(['password'=> $params['password']]);
    }
}
