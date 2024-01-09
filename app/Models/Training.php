<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    public function getUpcomingTraining($registration_id)
    {
        try {
            $sql = "select tr.REGNNUMB as registration_id , loc.locnname as branch, tr.trandate as training_date,TO_CHAR(tr.starttim,'HH24MI')||'-'||TO_CHAR(tr.ENDDTIME,'HH24MI') as training_time, 
            tr.DIEMPCDE as instructor_sb , Initcap(D.DRVRNAME) instructor_name,   tr.attnflag as attendance_flag from ERPRAK.trschdtl tr ,orbbdc.trbrnmas loc, ERPRAK.DI_LK_TRDRVMAS d where tr.compcode = '100' and  loc.locncode = tr.locncode
            and tr.DIEMPCDE = D.DRIVERID And tr.nooftran > 0 and  tr.trandate >= sysdate-1  and tr.REGNNUMB ='" . $registration_id . "' order by tr.trandate ";

                
            return DB::connection('oracle')->select($sql);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getHistoryTraining($registration_id)
    {
        try {
            $sql = "select tr.REGNNUMB as registration_id , loc.locnname as branch, tr.trandate as training_date,  
            TO_CHAR(tr.starttim,'HH24MI')||'-'||TO_CHAR(tr.ENDDTIME,'HH24MI') as training_time, tr.DIEMPCDE as instructor_sb , Initcap(D.DRVRNAME) instructor_name,   tr.attnflag as attendance_flag 
            from ERPRAK.trschdtl tr ,orbbdc.trbrnmas loc, ERPRAK.DI_LK_TRDRVMAS d where tr.compcode = '100' and  loc.locncode = tr.locncode
            and tr.DIEMPCDE = D.DRIVERID And tr.nooftran > 0 and TR.TRANDATE <= sysdate-1 and tr.REGNNUMB = '" . $registration_id . "' order by tr.trandate";

                
            return DB::connection('oracle')->select($sql);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
