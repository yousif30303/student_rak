<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Course;
use App\Models\Student;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\RegisterNotifi;
use App\Models\Example;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class ApiController extends BaseController
{
    public function testDetail(Request $request)
    {
        try {
            $upcoming_details = (new Test())->getUpcomingTest($request->registration_id);
            $history_details = (new Test())->getHistoryTest($request->registration_id);
            $data = [
                'upcoming_details' => $upcoming_details,
                'history_details' => $history_details
            ];
            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }
    }

    public function trainingDetail(Request $request)
    {
        try {
            $upcoming_details = (new Training())->getUpcomingTraining($request->registration_id);
            $history_details = (new Training())->getHistoryTraining($request->registration_id);
            $data = [
                'upcoming_details' => $upcoming_details,
                'history_details' => $history_details
            ];
            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), true);
        }
    }


    public function regTest()
    {
        $students = RegisterNotifi::where('stregdate', '2023-05-05 00:00:00')->where('PREFFERD_GOLDEN_CHANCE', 'Y')->get()->toArray();

            foreach ($students as $student) {

                Student::create([
                    'reg_id' => $student['stid'],
                    'name' => $student['stname'],
                    'password' => 1245,
                    'branch' => 'wasel',
                    'mobile' => $student['stmobile'],
                    'category' => $student['stcategory'],
                ]);

//                PermitRenew::where('regnnumb',$permit->regnnumb)->where('docnumbr',$permit->docnumbr)->update(['emailsnd','Y']);

            }
    }


    public function courseDetails(Request $request)
    {        
        $locale = $request->header('Accept-Language');
        return Course::select(['id','category','small_img','big_img','description_'.$locale])->get();
    }

    public function groupExample1()
    {
        $collection = collect([
 
            ['id'=>1, 'name'=>'Rahul', 'city' => 'Mumbai', 'country' => 'India','iq'=>'low'],
 
            ['id'=>2, 'name'=>'Sumit', 'city' => 'New York', 'country' => 'US','iq'=>'high'],
 
            ['id'=>3, 'name'=>'Ronak', 'city' => 'Gujarat', 'country' => 'India','iq'=>'low'],
 
            ['id'=>4, 'name'=>'Harish', 'city' => 'New York', 'country' => 'US','iq'=>'high'],

            ['id'=>5, 'name'=>'ggg', 'city' => 'Gujarat', 'country' => 'India','iq'=>'mid'],
 
            ['id'=>6, 'name'=>'www', 'city' => 'New York', 'country' => 'US','iq'=>'mid'],

            ['id'=>7, 'name'=>'nn', 'city' => 'Gujarat', 'country' => 'India','iq'=>'mid'],
 
            ['id'=>8, 'name'=>'mm', 'city' => 'New York', 'country' => 'US','iq'=>'mid'],
 
        ]);
        // Grouping the collection by city
        $group = $collection->groupBy('country')->transform(function($item,$k){
            return $item->groupBy('iq');
        });
        echo $group;

    }

    public function groupExample()
    {     $object = new \stdClass();
        $object->name = 'yousif';
        $object->age = 25;
        $test = collect([2,4,6]);
        $object = collect([$object]);
        $data = $object->map(function($item){
             $item->location = 'dubai';
             return $item;
        });

        dd($object);
    }

    function example() {
        $ex = Example::where('dtcomp', '2023-06-19 00:00:00')->where('descr','Road Test')->where('status','F')->get()->toArray();
        //$ex = Example::where('regnnumb',15486820)->get()->toArray();
        dd($ex);
    }

    
}