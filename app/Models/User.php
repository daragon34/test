<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects(){

        return $this->belongsToMany('App\Models\Project');
    }

    public function getListProjectsAttribute(){
        
        if ($this->rol==1)
            return $this->projects;

        return Project::all();
    }
    
    public function getIsAdminAttribute(){
        return $this->rol==0;
    }
    public function getIsSupportAttribute(){
        return $this->rol==1;
    }

    public function getIsClientAttribute(){
        return $this->rol==2;
    }
}
