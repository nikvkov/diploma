<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mockery\Exception;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function person()
    {
        try {
            return $this->hasOne('App\PersonData');
        }catch (Exception $ex){
            return null;
        }
    }

    public function files()
    {
        return $this->hasMany('App\DataFile');
    }

    //размер файлов
    public function getFilesSize()
    {
        return $this->files->sum('size');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function adminOrders()
    {
        return $this->hasMany('App\AdminOrder');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function getById($id){

       // return $this->getbyid($id)->firstOrFail();
      return $this->whereRaw('id = ?',[$id])->firstOrFail();

    }

    //получить все cообщения
    public function getAllUsers(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
        return $this ->get();

    }//getAllNonReadMessages

    //получить все cообщения
    public function getUsersAtDate(){

        //  return $this::where(['active' => '1', 'position' => 'right'])->get();
       // return $this ->whereRaw('created_at = ? )', [date("Y-m-d")])->get();
        return $this ->whereRaw('DATE(created_at) = CURDATE()')->get();

    }//getAllNonReadMessages

    /*Заготовки*/
    function scopeGetbyid($query, $id){
        $query->where(['id'=>$id]);
    }
}

