<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

if (!function_exists("__internal_log_helper_stringify_message")) {
    function __internal_log_helper_stringify_message($message)
    {
        if (is_array($message)) {
            return var_export($message, true);
        } elseif ($message instanceof Jsonable) {
            return $message->toJson();
        } elseif ($message instanceof Arrayable) {
            return var_export($message->toArray(), true);
        }

        return (string) $message;
    }
}

if (!function_exists("__log")) {
    //Level: info, warning, error, critical, alert, warning, notice
    //TODO: Siapa tau nanti mau ditambahkan error watchdog seperti Sentry, dkk
    function __log($tag, $message, $level = "info", $context = [])
    {
        $ip = request()->ip();
        $agent = request()->header('User-Agent');
        $user = Auth::guard(current_logged_guard_name())->user();
        $context = array_merge($context, [
            "ip" => $ip,
            "agent" => $agent,
            "user" => $user ? $user->getAuthIdentifier() : null
        ]);

        switch ($level) {
            case "info":
                Log::info($tag . "-> " . __internal_log_helper_stringify_message($message), $context);
                break;
            case "success":
                Log::warning($tag . "-> " . __internal_log_helper_stringify_message($message), $context);
                break;
            case "error":
                Log::error($tag . "-> " . __internal_log_helper_stringify_message($message), $context);
                break;
            default:
                Log::info($tag . "-> " . __internal_log_helper_stringify_message($message), $context);
                break;
        }
    }
}
