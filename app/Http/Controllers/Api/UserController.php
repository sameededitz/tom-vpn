<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function redeemCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'required|string|exists:promo_codes,code'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $promoCode = PromoCode::where('code', $request->promo_code)
            ->where('is_used', false)
            ->where(function ($query) {
                $query->where('expires_at', '>', now())
                    ->orWhereNull('expires_at');
            })
            ->first();

        if (!$promoCode) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired promo code.'
            ], 400);
        }

        $user = Auth::user();
        /** @var \App\Models\User $user **/

        $user->purchases()->create([
            'plan_id' => $promoCode->plan_id,
            'started_at' => now(),
            'expires_at' => now()->addMonths((int)$promoCode->plan->duration),
            'is_active' => true,
        ]);

        $promoCode->update(['is_used' => true]);

        return response()->json([
            'status' => true,
            'message' => 'Promo code redeemed successfully, and the plan has been activated.'
        ], 200);
    }

    public function referrals()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/

        return response()->json([
            'status' => true,
            'referrals' => $user->referrals,
            'referred_by' => $user->referredBy->name
        ], 200);
    }

    public function plans()
    {
        $plans = Plan::where('id', '!=', 1)->get();
        return response()->json([
            'status' => true,
            'plans' => $plans
        ], 200);
    }
}
