<?php

namespace Crud\Mvc\core\traits;

use DateTime;

trait FileInfo
{
    public string $path;
    public string $name;
    public int $size;
    public string $mime;
    public array $exif_headers;
    public string|null $date_original = null;
    public int|null $imageHeight = null;
    public int|null $imageWeight = null;


    public function getinfo()
    {
        $this->name = basename($_FILES["fileToUpload"]["name"]);
        $this->path = "uploads/" . $this->name;
        $this->size = $_FILES["fileToUpload"]["size"];
        $this->mime = $_FILES["fileToUpload"]["type"];
        if ($this->mime == 'image/jpeg') {
            $this->exif_headers = exif_read_data($this->path);
            $size = getimagesize($this->path);
            if (array_key_exists('DateTimeOriginal', $this->exif_headers)) {
                $d = new DateTime($this->exif_headers["DateTimeOriginal"]);
                $this->date_original = $d->getTimestamp();
            }
            if (getimagesize($this->path)) {
                $this->imageHeight = $size[0];
                $this->imageWeight = $size[1];
            }
        }
    }
}
