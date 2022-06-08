<?php

namespace App\Actions\Concerns;

use Illuminate\Http\Response;

trait RedirectsActions
{
    public function redirectPath($action)
    {
        if (method_exists($action, 'redirectTo')) {
            $response = $action->redirectTo();
        } else {
            $response = property_exists($action, 'redirectTo')
                                ? $action->redirectTo
                                : config('fortify.home');
        }

        return $response instanceof Response ? $response : redirect($response);
    }
}
