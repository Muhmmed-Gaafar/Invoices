<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\FireEvent;
use App\Listeners\FireListener;
use Illuminate\Support\Facades\Event;



class EventServiceProvider extends ServiceProvider
        {
                protected $listen = [
                    FireEvent::class => [
                        FireListener::class,
                ],
                ];



                public function boot()
                {
                    parent::boot();
                }

        }


