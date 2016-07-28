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
            $this->checkForDuplicateCode($request);

            $newCoupon = Coupon::create([
                'code' => $request->input('coupon-code'),
                'discount_amount' => (is_null($request->input('coupon-amount')) || $request->input('coupon-amount') == 0) ? NULL : $request->input('coupon-amount'),
                'discount_type' => $request->input('coupon-type')

            ]);

            $newCoupon->save();
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
            $this->checkForDuplicateCode($request);
            
            if ($request->input('coupon-type') == 'percent' && intval($request->input('coupon-amount')) <= 0 && intval($request->input('coupon-amount') > 100)) {
                throw new \Exception('You must enter a percent value between 1 and 100');
            }
            if ($request->input('coupon-button') == 'delete') {
                DB::table('coupons')->where('id', '=', $id)->delete();
            } else if ($request->input('coupon-button') == 'update') {
                $coupon = Coupon::findOrFail($id);
                $coupon->code = $request->input('coupon-code');
                $coupon->discount_amount = (is_null($request->input('coupon-amount')) || $request->input('coupon-amount') == 0) ? NULL : $request->input('coupon-amount');
                $coupon->discount_type = $request->input('coupon-type');
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

    private function checkForDuplicateCode($request) {
        $coupon = Coupon::where('code', $request->input('coupon-code'))->first();
        if ($coupon) {
            throw new \Exception('Coupon code already exists');
        }
    }
}
