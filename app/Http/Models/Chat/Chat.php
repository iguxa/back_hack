<?php

namespace App\Http\Models\Chat;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Chat\Chat
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Chat\Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Chat\Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Chat\Chat query()
 * @mixin \Eloquent
 */
class Chat extends Model
{
    protected $table = 'chat';
    protected $fillable = ['vote_id', 'comment','replay_comment_id'];
}
