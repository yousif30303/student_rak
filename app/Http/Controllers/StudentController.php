<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class StudentController extends BaseController
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'registration_id' => 'required',
                'name' => 'required',
                'password' => 'required',
                'branch' => 'required',
                'mobile' => 'required',
                'category' => 'required'
            ]);

            if ($validator->fails())
            return $this->errorWithData($validator->errors()->first(), $validator->errors());
            
            
            $student = Student::create([
                'reg_id' => $request->registration_id,
                'name' => $request->name,
                'password' => md5($request->password),
                'branch' => $request->branch,
                'mobile' => $request->mobile,
                'category' => $request->category,
            ]);


            $data = [
                'student' => $student
            ];
            return $this->success($data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }

    }


    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'registration_id' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails())
                return $this->errorWithData($validator->errors()->first(), $validator->errors());
            
                $student = Student::where('reg_id', $request->registration_id)->first();
                

            if (is_null($student))
                return $this->error('Invalid Registeration ID');
            
            $password = $student->password;


            if (md5($request->password) != $password) 
                return $this->error('Wrong password. Please try an other password');
                

            $data = [
                'student' => $student,
                'api_token' => $student->createToken('Api Token')->plainTextToken
            ];
            return $this->success($data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }
    }


    public function profile()
    {
        try {
            return $this->success(auth()->user());
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }
    }


    public function forgetpassword(Request $request)
    {
        try {
        $mobile_number =  Student::where('reg_id', $request->registration_id)->first()->mobile;
        
        $chars = "0123456789";
        $password = substr( str_shuffle( $chars ), 0, 4 );

        Student::where('reg_id',$request->registration_id)->update(['password'=>md5($password)]);
        return $this->success([], 'Password has been sent successfully');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }
        
    }

    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|confirmed|min:5',
                'password_confirmation' => 'required|min:5',
            ]);

            if ($validator->fails())
                return $this->errorWithData($validator->errors()->first(), $validator->errors());

                if (md5($request->old_password) != auth()->user()->password) 
                return $this->error('Wrong password. Please try an other password');

            $user = auth()->user()->update(['password' => md5($request->password)]);
            if ($user){
                auth()->user()->tokens()->delete();
            }
            return $this->success([], 'Password has been updated');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }
    }


    public function logout()
    {
        try {
            $user = auth()->user();
            if ($user){
                auth()->user()->tokens()->delete();
            }
            return $this->success([], 'User has been logged out');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }
    }

    public function Contact(Request $request)
    {

        Mail::to('yousif30303@gmail.com')->send(
            new Contact($request->message)
        );
    }

    /*public function getStudent(Request $request)
    {
        return (new Student())->getStudentDetails($request->registration_id);
    }*/

    

}
