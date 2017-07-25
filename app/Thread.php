<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        /*static::addGlobalScope('replyCount', function($builder) {
            $builder->withCount('replies');
        });*/

        /*static::addGlobalScope('creator', function($builder) {
            $builder->with('creator');
        });*/

        static::deleting(function($thread) {
            $thread->replies->each->delete();
           /* $thread->replies->each(function($reply){
              $reply->delete();
            });*/
        });

    }


    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
       return $this->replies()->create($reply);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public static function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
