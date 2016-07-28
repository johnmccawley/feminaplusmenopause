<?php

namespace App\Http\Controllers;

use Auth;
use DB as DB;
use App\User;
use App\Coupon;
use App\Http\Requests\CouponRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class CouponController extends Controller
{
    private $user;

    function __construct() {
        $this->user = (Auth::user()) ? User::findOrFail(Auth::user()->id) : null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CouponRequest $request)
    {
        try {
            $coupon = Coupon::where('code', $request->input('coupon-code'))->first();

            if (!$coupon) {
                $newCoupon = Coupon::create([
                    'code' => $request->input('coupon-code'),
                    'discount_percent' => (is_null($request->input('coupon-percent')) || $request->input('coupon-percent') == 0) ? NULL : $request->input('coupon-percent'),
                    'discount_amount' => (is_null($request->input('coupon-amount')) || $request->input('coupon-amount') == 0) ? NULL : $request->input('coupon-amount')
                ]);

                $newCoupon->save();
            } else {
                throw new \Exception('Coupon code already exists');
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return redirect('/coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (is_null($this->user) || $this->user->email != env('ADMIN_EMAIL')) {
            return redirect('/');
        } else {
            $coupons = DB::table('coupons')->get();
            return view('coupon', ['coupons' => $coupons]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, $id)
    {
        try {
            if ($request->input('coupon-button') == 'delete') {
                DB::table('coupons')->where('id', '=', $id)->delete();
            } else if ($request->input('coupon-button') == 'update') {
                $coupon = Coupon::findOrFail($id);
                $coupon->code = $request->input('coupon-code');
                $coupon->discount_percent = (is_null($request->input('coupon-percent')) || $request->input('coupon-percent') == 0) ? NULL : $request->input('coupon-percent');
                $coupon->discount_amount = (is_null($request->input('coupon-amount')) || $request->input('coupon-amount') == 0) ? NULL : $request->input('coupon-amount');
                $coupon->save();
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }


        return redirect('/coupon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
