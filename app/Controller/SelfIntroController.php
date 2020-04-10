<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\WrongRequestException;
use App\Request\IntroRequest;
use App\Services\SelfIntroService;
use App\Services\UploadService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class SelfIntroController
 * @AutoController()
 * @package App\Controller
 *
 * User: xiaowei<13177839316@163.com>
 * Date: 2020/4/10
 * Time: 14:10
 */
class SelfIntroController extends AbstractController
{

    /**
     * @Inject()
     * @var SelfIntroService
     */
    protected $service;

    /**
     * for backend
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index()
    {
        return $this->success($this->service->get());
    }

    /**
     * @param IntroRequest $request
     * for backend upload file
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function upload(IntroRequest $request)
    {
        $request->validated();
        return $this->success($this->service->upload($request->file('file')));
    }

    /**
     * @param IntroRequest $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editPassword(IntroRequest $request)
    {
        $request->validated();
        return $this->success($this->service->editPassword($request->all()));
    }

    /**
     * @param IntroRequest $request
     * for home look
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function homeLook(IntroRequest $request)
    {
        $request->validated();
        return $this->success($this->service->homeLook($request->input('password')));
    }
}
