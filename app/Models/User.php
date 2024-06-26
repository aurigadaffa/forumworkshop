<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['fullname','NIP', 'new_NIP', 'password', 'email', 'unit'];
    protected $hidden   = ['NIP', 'new_NIP', 'password', 'email', 'unit'];

    public function audience_evaluations(){
        //parameter(Nama table yang direlasi 2, nama table pivot, nama table relasi 1, nama table relasi 2)
        return $this->belongsToMany(Workshop::class, 'audience_evaluations', 'user_id', 'workshop_id')
                    ->withPivot('received', 'speaker_suggestion', 'event_suggestion', 'note', 'workshop_id')
                    ->withTimestamps();
    }

    public function speaker_evaluations(){
        return $this->belongsToMany(Workshop::class, 'speaker_evaluations', 'user_id', 'workshop_id')
                    ->withPivot('comfortable', 'event_suggestion', 'file', 'workshop_id')
                    ->withTimestamps();
    }

    public function workshops(){
        return $this->belongsToMany(Workshop::class, 'event_notes');
    }
}
