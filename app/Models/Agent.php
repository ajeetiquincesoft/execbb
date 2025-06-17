<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'agents';
    protected $primaryKey = 'AgentUserRegisterId';
    protected $fillable = [
        'AgentTableID',
        'AgentID',
        'LName',
        'FName',
        'Spouse',
        'SpLName',
        'SpFName',
        'Address1',
        'Address2',
        'City',
        'State',
        'Zip',
        'Telephone',
        'Pager',
        'CellPhone',
        'Fax',
        'Email',
        'SocSecNum',
        'DOB',
        'HireDate',
        'License',
        'Termination',
        'Comments',
        'Extension',
        'Display',
        'image',
        'Profile',
        'EmailFlag',
        'Renewal',
        'EmailPW',
        'AgentUserRegisterId',
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
