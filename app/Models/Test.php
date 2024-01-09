<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;

    protected $table = 'bdcuser.app_user_login';

    public function getUpcomingTest($registration_id)
    {
        try {
            $sql = "select ts.REGNNUMB as registration_id,loc.locnname as branch, (select engdescr from ERPRAK.DI_MS_CODEMAST where HARDCODE = 'TST' and SOFTCODE = ts.testcode) as test_name,
            ts.testdate as test_date, TO_CHAR(ts.starttim,'HH24MI')||'-'||TO_CHAR(ts.ENDDTIME,'HH24MI') as test_time, ts.tsResult as test_result
            from ERPRAK.TRTSTTRN ts ,orbbdc.trbrnmas loc  where ts.compcode = '100' and loc.locncode = ts.locncode and  ts.testdate <= sysdate-1
            and ts.REGNNUMB = '" . $registration_id . "' order by ts.testdate";

                
            return DB::connection('oracle')->select($sql);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getHistoryTest($registration_id)
    {
        try {
            $sql = "select ts.REGNNUMB as registration_id,loc.locnname as branch, (select engdescr from ERPRAK.DI_MS_CODEMAST where HARDCODE = 'TST' and SOFTCODE = ts.testcode) as test_name,
            ts.testdate as test_date, TO_CHAR(ts.starttim,'HH24MI')||'-'||TO_CHAR(ts.ENDDTIME,'HH24MI') as test_time, ts.tsResult as test_result
            from ERPRAK.TRTSTTRN ts ,orbbdc.trbrnmas loc  where ts.compcode = '100' and loc.locncode = ts.locncode and  ts.testdate <= sysdate-1
            and ts.REGNNUMB = '" . $registration_id . "' order by ts.testdate";

                
            return DB::connection('oracle')->select($sql);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
