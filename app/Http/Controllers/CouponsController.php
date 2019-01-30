<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use DB;
use Session;
class CouponsController extends Controller
{
    public function addCoupon(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            $coupon->status = $data['status'];
            $coupon->save();
            return redirect()->route('view.coupon')->with('flash_message_success', 'Coupon Added');
        }
        return view ('admin.coupons.add_coupon');
    }

    public function viewCoupons()
    {
        $coupons = Coupon::latest()->get();
        return view ('admin.coupons.view_coupons', compact('coupons'));
    }

    public function editCoupon(Request $request, $id){
        $couponDetails = Coupon::findOrFail($id);
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = Coupon::find($id);
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            $coupon->status = $data['status'];
            $coupon->save();
            return redirect()->route('view.coupon')->with('flash_message_success', 'Coupons Edit Success');
        }
        return view ('admin.coupons.edit_coupon', compact('couponDetails'));

    }

    public function deleteCoupon($id){
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('view.coupon')->with('flash_message_success', 'Coupons Delete Success');

    }

    public function applyCoupon(Request $request){
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('flash_message_error', 'You have Entered a Invalid Coupon');
        } else {
            $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first();

//            incase of coupon inactive
            if($couponDetails->status == 0){
                return redirect()->back()->with('flash_message_error', 'This Coupon is Not Active');
            }

//            incase of coupon has expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('flash_message_error', 'This Coupon Has Expired');
            }

            // after the coupon is valid for discount check if amount type is fixed or percentage

            $session_id = Session::get('session_id');
            $userCart = DB::table('carts')->where(['session_id' => $session_id])->get();
            $total_amount = 0;

            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            if($couponDetails->amount_type == "Fixed"){
                $couponAmount = $couponDetails->amount;
            } else {
                $couponAmount = $total_amount * ($couponDetails->amount / 100);
            }

            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $data['coupon_code']);

            return redirect()->back()->with('flash_message_success', 'Coupon Has Been Successfully Applied');
        }
    }
}
