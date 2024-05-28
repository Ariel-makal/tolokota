<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use function PHPUnit\Framework\throwException;

class FileUploader
{
    private string $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    function fromBase64($base64_string, $extension): string
    {
        $path = 'uploads'. DIRECTORY_SEPARATOR . uniqid(). '.' . $extension;
        $output_file = $this->targetDirectory . $path;

        $file = fopen($output_file, "wb");

        fwrite($file, base64_decode($base64_string));
        fclose($file);

        return $path;
    }

    public function image(UploadedFile $file,$code): \PHPUnit\Framework\MockObject\Stub\Exception|string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $code.'.'.$file->guessExtension();

        if (!$this->verifyPictureExtension($file)){
            throw new FileException('Extension incompatible');
        }

        try
        {
            $file->move($this->getTargetDirectory(), $fileName);
        }
        catch (FileException $e)
        {
            throwException($e);
        }

        return $fileName;
    }

    public function icon(UploadedFile $file): \PHPUnit\Framework\MockObject\Stub\Exception|string
    {

        if (!$this->verifyPictureExtension($file)){
            throw new FileException('Extension incompatible');
        }

        $original_image = $file;

        // Get the width and height of the original image
        list($original_width, $original_height) = getimagesize($original_image);

        // Define the desired width and height of the view
        $view_width = 120;
        $view_height = 120;

        // Calculate the scale ratio based on the original and desired dimensions
        $scale_ratio = min($view_width / $original_width, $view_height / $original_height);

        // Calculate the new width and height of the resized image
        $new_width = round($original_width * $scale_ratio);
        $new_height = round($original_height * $scale_ratio);

        // Create a new image resource with the new dimensions
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // make the background transparent
        imagesavealpha($new_image, true);
        $trans_colour = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
        imagefill($new_image, 0, 0, $trans_colour);

        // Create an image resource from the original image
        $source_image = $this::createImage($original_image);

        // Resize and copy the original image to the new image
        imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

        // Define the path of the resized image
        $originalFilename = pathinfo($original_image->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $resized_image = $this->getTargetIconDirectory().$safeFilename.".".$file->guessExtension();

        // Save the resized image as a JPEG file
        $this::saveImage($original_image, $new_image, $resized_image);

        // Free up memory
        imagedestroy($new_image);
        imagedestroy($source_image);

        return 'images/icons/'.$safeFilename.".".$file->guessExtension();
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }

    public function getTargetIconDirectory(): string
    {
        return $this->targetDirectory."icons/";
    }

    private function verifyPictureExtension($file): bool
    {
        return match (strtolower($file->guessExtension())) {
            'webp', 'jpeg', 'png', 'jpg' => true,
            default => false
        };
    }

    private function createImage($file){
        return match ($file->guessExtension())
        {
            'png' => imagecreatefrompng($file),
            'jpg' => imagecreatefromjpeg($file),
            'webp' => imagecreatefromwebp($file),
            default => throw new FileException('Extension incompatible'),
        };
    }

    private function saveImage($file,$new_image, $resized_image){
        return match ($file->guessExtension())
        {
            'png' => imagepng($new_image, $resized_image),
            'jpg' => imagejpeg($new_image, $resized_image),
            'webp' => imagewebp($new_image, $resized_image),
            default => throw new FileException('Cannot save the image resource'),
        };
    }

    public function safeFileName($file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        return $safeFilename.'.'.$file->guessExtension();
    }

}