<?php

namespace App\Http\Models\Document;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'votes_docs';
    protected $fillable = ['vote_id', 'path',];
}
