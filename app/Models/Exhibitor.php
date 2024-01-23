<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Exhibitor extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table= 'tbl_exhibitor';
    protected $fillable = [
        'exhibitor_id',
        'company_name',
        'contact_name',
        'contact_email',
        'address',
        'city',
        'state',
        'phone_number',
        'zip_code',
        'electricity_required',
    ];


}
