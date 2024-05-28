<?php

namespace App\Controller;

use App\Entity\Post;
use App\Service\AssetAccessor;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FileUploadController extends AbstractController
{
    #[Route('/file/upload', name: 'app_file_upload')]
    public function upload(
        Request $request,
        FileUploader $uploader
    ): JsonResponse
    {
        $content = json_decode($request->getContent(),true);

        $base64 = $content['file'] ?? null;
        if(!$base64){
            return new JsonResponse(false);
        }

        $data = explode(';base64,', $base64);
        $metadata = $data[0] ?? null;
        $metadata = explode(':',$metadata);
        $metadata = explode('/',$metadata[1]);

        $file_extension = $metadata[1];
        $base64_string = $data[1] ?? null;

        $filename = $uploader->fromBase64($base64_string, $file_extension);
        $baseUrl = $request->getSchemeAndHttpHost() . $request->getBasePath();

        return new JsonResponse($baseUrl. '/' . $filename);
    }

}
