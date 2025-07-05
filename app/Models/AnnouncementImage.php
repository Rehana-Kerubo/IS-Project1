<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementImage extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'announcement_id',
        'image_url',        
    ];
    public function announcement()
{
    return $this->belongsTo(Announcement::class);
}

}
