<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class File extends Model
{
    use HasFactory;

    public $tempFileHash;

    public const FILE_TYPE_1 = 1;

    public const FILE_TYPE_2 = 2;

    public const FILE_TYPE_3 = 3;

    protected $fillable = [
        'name',
        'description',
        'type',
        'file',
    ];

    public function getTempFileUrl()
    {
        // $url = url("/files/".$this->tempFileHash."/show");
        $url = route('file.show', ['file' => $this->tempFileHash]);

        return $url;
    }
}
