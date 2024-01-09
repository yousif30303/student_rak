<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'mysql';

    protected $fillable = [
        'reg_id',
        'name',
        'branch',
        'password',
        'mobile',
        'category',
        'language'
    ];

    protected $hidden = [
        'password',
        'id',
    ];

    //protected $table = 'bdcuser.app_user_login';

    /*public static function register($registration_id,$branch,$password,$mobile,$category)
    {
        try {
            $sql = "insert into bdcuser.app_user_login (ID, REGID, BRANCH, PASSWORD, LANG, NOTIFFLAG, MOBILE, CATEGORY, CREATEDATE) values(BDCUSER.APP_USER_LOGIN_SQ.nextval, '" . $registration_id . "', '" . $branch . "', '" . $password . "', '', 0, '".$mobile."', '".$category."', sysdate)";
            return DB::connection('oracle')->insert($sql);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }*/


    /*public static function login($registration_id)
    {
        try {
            $sql = "SELECT * FROM bdcuser.app_user_login WHERE reg_id = '".$registration_id."'";
            return DB::connection('oracle')->select($sql);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }*/

    /*public function getStudentDetails($registration_id)
    {
        try {
            $sql = "select REGNNUMB , studname , branch ,mobileno , appltype from bdcuser.app_user_std_profile pr where PR.REGNNUMB =  '" . $registration_id . "'";

            return collect(DB::connection('oracle')->select($sql))->first();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }*/

}
