<?php

namespace michalkortas\WebserviceNtlm;

use Illuminate\Support\ServiceProvider;

class WebserviceNtlmProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/ntlmsoapservice.php' => config_path('ntlmsoapservice.php'),
        ]);
    }

    public function register()
    {
        //
    }
}
