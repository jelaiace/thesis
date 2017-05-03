<?php

namespace App\Providers;

use App\Schedule;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /**
         * Validation that a block's (class / section) schedules has no overlapping time
         *
         * @usage Basic usage
         * Validator::make($inputs, ['schedule' => "conflict_free_schedule:{$block_id},{$start},{$end}" ]);
         *
         * @usage Ignore a certain id (when updating)
         * @usage Validator::make($inputs, ['schedule' => "conflict_free_schedule:{$block_id},{$start},{$end},{$schedule_id}" ]);
         */
        Validator::extendImplicit('conflict_free_schedule', function($attribute, $value, $parameters, $validator) {
            $id = $parameters[0];
            $start = $parameters[1];
            $end = $parameters[2];
            $ignore = array_get($parameters, '3');

            // Check  start and end time are not the same
            // Check if there are overlapping schedules
            // Must start before and after start
            // Must end before and after end
            $query = Schedule::where('block_id', $id)
                ->where('start_time', '<', $end)
                ->where('end_time', '>', $start);

            if ($ignore) {
                $query->where('id', '!=', $ignore);
            }
            
            $conflicting = $query->first();

            return null == $conflicting;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
