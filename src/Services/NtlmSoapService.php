<?php

namespace michalkortas\WebserviceNtlm\Services;

use Illuminate\Support\Facades\Log;

class NtlmSoapService
{
    public static function initClient($url, $connection = 'default')
    {
        $connectionParams = config('ntlmsoapservice.' . $connection);

        define('USERPWD', $connectionParams['domain'].'\\'.$connectionParams['user'].':'.$connectionParams['password']);

        stream_wrapper_unregister('http');
        stream_wrapper_register('http', 'michalkortas\WebserviceNtlm\Services\NtlmStream') or die("Failed to register protocol");

        try
        {
            return new NtlmSoapClient($url, ['trace' => 1]);
        }
        catch (\SoapFault $e)
        {
            Log::error($e, ['url'=>$url]);
            return false;
        }

    }
}
