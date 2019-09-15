<?php

namespace App\Http\Models\Votes;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Models\Votes\VotesMembers;

/**
 * App\Http\Models\Votes\Votes
 *
 * @property int $id
 * @property int|null $type_id
 * @property int|null $state
 * @property int|null $q_type
 * @property int|null $q_value
 * @property string|null $title
 * @property string|null $description
 * @property int|null $creator
 * @property int|null $arbiter
 * @property string|null $publish
 * @property string|null $deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereArbiter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereCreator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes wherePublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereQType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereQValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Votes\Votes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Votes extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'description',
        'state',
        'q_type',
        'q_value',
        'type_id',
        'creator',
        'arbiter',
        'publish',
        'title',
        'deadline'
    ];

    public static function getAllWithPaginate(): LengthAwarePaginator
    {
        return self::paginate(20);
    }

    public function comments()
    {
        return $this->hasMany(VotesMembers::class);
    }
}
