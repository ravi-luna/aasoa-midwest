<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table= 'tbl_attendee';
    protected $fillable = [
        'attendee_id',
        'name',
        'company_name',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'zip_code',
        'attendee_name_2',
        'attendee_email_2',
        'attendee_name_3',
        'attendee_email_3',
        'attendee_name_4',
        'attendee_email_4',
        'category',
    ];
}
