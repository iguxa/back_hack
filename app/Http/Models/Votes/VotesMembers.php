<?php

namespace App\Http\Models\Votes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Votes\VotesMembers
 *
 * @property int $id
 * @property int|null $votes_id
 * @property int|null $user_id
 * @property int|null $vote_value
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers whereVoteValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesMembers whereVotesId($value)
 * @mixin \Eloquent
 */
class VotesMembers extends Model
{
    protected $table = 'votes_members';

    public $timestamps = false;

    protected $fillable = [
        'votes_id',
        'user_id',
        'vote_value',
        'comment'
    ];
}
