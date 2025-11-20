<?php

namespace Lightworx\FilamentIssues\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HelpIssue extends Model
{
    use SoftDeletes;

    public $table = 'help_issues_table';
    protected $guarded = ['id'];

}