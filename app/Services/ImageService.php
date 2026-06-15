<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    protected int $maxWidth;
    protected int $maxHeight;
    protected int $quality;
    protected int $thumbWidth;
    protected int $thumbHeight;

    public function __construct()
    {
        $this->maxWidth   = (int) config('image.max_width', 1920);
        $this->maxHeight  = (int) config('image.max_height', 1080);
        $this->quality    = (int) config('image.quality', 80);
        $this->thumbWidth  = (int) config('image.thumbnail_width', 400);
        $this->thumbHeight = (int) config('image.thumbnail_height', 300);
    }

    /**
     * Upload & compress gambar utama, kembalikan path relatif ke storage/app/public
     */
    public function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $filename = Str::uuid() . '.jpg';
        $path = $folder . '/' . $filename;

        $image = Image::read($file->getPathname())
            ->scaleDown(width: $this->maxWidth, height: $this->maxHeight)
            ->toJpeg(quality: $this->quality);

        Storage::disk('public')->put($path, $image);

        return $path;
    }

    /**
     * Buat thumbnail dari file yang sudah diupload
     */
    public function thumbnail(string $sourcePath, string $folder = 'thumbnails'): string
    {
        $filename = basename($sourcePath);
        $thumbPath = $folder . '/' . $filename;

        $sourceContent = Storage::disk('public')->get($sourcePath);

        $thumb = Image::read($sourceContent)
            ->cover(width: $this->thumbWidth, height: $this->thumbHeight)
            ->toJpeg(quality: $this->quality);

        Storage::disk('public')->put($thumbPath, $thumb);

        return $thumbPath;
    }

    /**
     * Upload + buat thumbnail sekaligus
     * Kembalikan ['gambar' => '...', 'gambar_thumbnail' => '...']
     */
    public function uploadWithThumbnail(UploadedFile $file, string $folder = 'uploads'): array
    {
        $mainPath  = $this->upload($file, $folder);
        $thumbPath = $this->thumbnail($mainPath, $folder . '/thumbnails');

        return [
            'gambar'            => $mainPath,
            'gambar_thumbnail'  => $thumbPath,
        ];
    }

    /**
     * Hapus gambar dan thumbnail dari storage
     */
    public function delete(?string $path, ?string $thumbPath = null): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
        if ($thumbPath && Storage::disk('public')->exists($thumbPath)) {
            Storage::disk('public')->delete($thumbPath);
        }
    }
}
