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
         * Validator::make($inputs, ['schedule' => "conflict_free_schedule:{$block_id},{$start},{$end},{$day},{$schedule_id}" ]);
         */
        Validator::extendImplicit('conflict_free_schedule', function($attribute, $value, $parameters, $validator) {
            $id = $parameters[0];
            $start = $parameters[1];
            $end = $parameters[2];
            $day = $parameters[3];
            $ignore = array_get($parameters, '4');

            $conflicting = Schedule::conflicting($id, $start, $end, $day, $ignore)->first();

            return null == $conflicting;
        });

        /**
         * Validation message replacer so we can provide the conflicting schedule
         */
        Validator::replacer('conflict_free_schedule', function($message, $attribute, $rule, $parameters) {
            $id = $parameters[0];
            $start = $parameters[1];
            $end = $parameters[2];
            $day = $parameters[3];
            $ignore = array_get($parameters, '4');

            $conflicting = Schedule::conflicting($id, $start, $end, $day, $ignore)->first();

            return str_replace(
                [':conflict_department', ':conflict_room'],
                [$conflicting->room->department->name, $conflicting->room->name],
                $message
            );
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
