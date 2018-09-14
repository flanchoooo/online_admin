<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Quotation extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = [];
}
