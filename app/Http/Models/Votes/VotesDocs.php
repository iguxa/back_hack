<?php

namespace App\Http\Models\Votes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Http\Models\Votes\VotesDocs
 *
 * @property int $id
 * @property int $vote_id
 * @property string $path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesDocs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesDocs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesDocs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesDocs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesDocs wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\VotesDocs whereVoteId($value)
 * @mixin \Eloquent
 */
class VotesDocs extends Model
{
    protected $table = 'votes_docs';
}
