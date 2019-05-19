<?php

namespace App\Http\Controllers\Admin;

use App\Detail_Voucher;
use App\Http\Requests\Admin\VoucherStoreRequest;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    //

    public  function  index(Request $request)
    {

        if(!empty($request->fil)){
            $fil = $request->fil;
            $vouchers = Voucher::all();
            $detailVouchers = Detail_Voucher::query()->where('voucher_id','=',$fil)->paginate(30);
            return view('admin.vouchers.index',[
                'vouchers' => $vouchers,
                'fil' => $fil,
                'detailVouchers' => $detailVouchers
            ]);
        }
        else
        {

            $vouchers = Voucher::all();
            $detailVouchers = Detail_Voucher::query()
                ->where('voucher_id','=',$vouchers->first()->id)->paginate(30);
            return view('admin.vouchers.index',[
                    'vouchers' => $vouchers,
                    'detailVouchers' => $detailVouchers
                ]);
        }
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(VoucherStoreRequest $request)
    {
        $name = $request->name;
        $tag = $request->tag;
        $arrs = explode(',', $tag);
        $datas = [];
        foreach ($arrs as $arr)
        {

           $datas[] = explode('%-',$arr);
        }


        foreach ($datas as $data)
        {
            if(!is_numeric(($data[0]) ) || !is_numeric(($data[1])) )
            {
                flash()->error('Sai cú pháp!');
                return redirect()->route('admin.vouchers.create');
            }
        }


        $now = Carbon::now()->second;
        $voucher = new Voucher();
        $voucher->name = $name;
        $voucher->save();
        foreach ($datas as $data)
        {
            for($i = 1; $i<=$data[1]; $i++)
            {
                $detail = new Detail_Voucher();
                $detail->code = str_random(11).$now;
                $detail->value = $data[0];
                $detail->voucher_id = $voucher->id;
                $detail->state = 0;
                $detail->save();
            }
        }

        flash()->success('Thêm thành công!');
        return redirect()->route('admin.voucher.index');

    }

    public function update(Request $request)
    {
        $voucher = $request->voucher;
        $detailVoucher = Detail_Voucher::query()->where('voucher_id', '=', $voucher)->update(['state' => 1]);
        flash()->success('Cập nhật thành công!');
        return redirect()->back();
    }

    public function updateDetailVoucher(Detail_Voucher $voucher)
    {
        $voucher->state = 1;
        $voucher->save();
        flash()->success('Cập nhật thành công!');
        return redirect()->back();
    }
}
