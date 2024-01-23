<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table= 'tbl_membership';
    protected $fillable = [
        'membership_id',
        'corporation_name',
        'bussiness_name',
        'contact_person_name',
        'email_id',
        'phone_number',
        'bussiness_address',
    ];
}
