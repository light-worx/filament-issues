<?php

namespace Lightworx\FilamentIssues\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HelpDocument extends Model
{

    public $table = 'help_documents';
    protected $guarded = ['id'];

}