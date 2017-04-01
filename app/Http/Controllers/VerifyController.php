<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DataTables\VerifyDataTable;
use App\Http\Traits\StaticticsTrait;
use App\Verify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{
    use StaticticsTrait;

    /** 审核页面 */
    public function index(VerifyDataTable $dataTable,Request $request)
    {
        $this->getCustomer();

        view()->share('data', $this->datas('0,1,2', Carbon::today() ,$request->user()->id));
        view()->share('data_y', $this->datas('0,1', Carbon::yesterday(), $request->user()->id));
        return $dataTable->render('backstage.verify.verify');
    }

    /**
     * 操作审核客户
     * @param Request $request
     * @param $id   !客户ID
     * @return mixed
     */
    public function update(Request $request, $id){
        $this->validate($request,[
            'status'=>'required|int',
        ]);

        $tar = Verify::find($id);
        $data = $request->only('status','comment');
        $data['verify_at'] = Carbon::now();
        $data['verify_by'] = $request->user()->id;

        //强制修改已审核的客户的审核状态
        if ($tar->status != 0) {     //强制修改已审核的客户的审核状态
            $data['comment'] .= "[该用户于{$tar->verify_at}由{$tar->verify_by}审核为状态{$tar->status} (2:通过,3:拒绝)]";
        }

        $tar->update($data);
        return 'true';
    }

    /**
     * 审核员获取待审核客户
     * @return bool
     */
    public function getCustomer()
    {
        if( Auth::user()->verify()->where('status',0)->count() < 10 ) {
            if( Customer::doesntHave('verify')->count() < 1 ){
                return;
            }
            Customer::doesntHave('verify')->first()->verify()->create([
                'status'=>0,
                'verify_by'=>Auth::user()->id,
            ]);
            $this->getCustomer();
        }
        return;
    }
}
