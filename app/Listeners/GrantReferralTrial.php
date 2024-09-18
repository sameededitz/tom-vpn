<?php

namespace App\Listeners;

use App\Models\ReferralSetting;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GrantReferralTrial
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        $user = $event->user;
        if ($user->referred_by) {
            /** @var \App\Models\User $referrer **/
            /** @var \App\Models\User $user **/
            $referrer = $user->referredBy;
            // dd($referrer);

            if ($referrer) {
                // Assign trial period to the referrer
                $referralCount = $referrer->referrals()->count();
                // dd($referralCount);
                $trialTime = ReferralSetting::getTrialTimeForReferrals($referralCount);
                // dd($trialTime);

                if ($trialTime > 0) {
                    $referrer->purchases()->create([
                        'plan_id' => null, // or a specific plan ID for referral trials
                        'started_at' => now(),
                        'expires_at' => now()->addHours($trialTime),
                        'is_active' => true,
                    ]);
                }

                // Assign 2-hour trial to the referred user
                $user->purchases()->create([
                    'plan_id' => 1, // or a specific plan ID for referral trials
                    'started_at' => now(),
                    'expires_at' => now()->addHours(2),
                    'is_active' => true,
                ]);
            }
        }
    }
}
