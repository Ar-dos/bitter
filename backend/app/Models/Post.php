<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = ['pivot','id','updated_at', 'deleted_at','user_id'];
    protected $table = 'posts';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id')->select(array('name','id'))->get();
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'post_tag')->select('title');
    }
    public function mentions(){
        return $this->belongsToMany(User::class,'post_user');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse( $date)->format('h:m d.m.y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse( $date)->format('h:m d.m.y');
    }
}
