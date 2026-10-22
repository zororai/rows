<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    /**
     * Where to send the admin after saving, e.g. back to the public page they came from.
     * Only same-site paths are accepted so the parameter can't be used as an open redirect.
     */
    protected function returnPath(Request $request): ?string
    {
        $path = $request->input('return');

        if (! is_string($path) || ! str_starts_with($path, '/') || str_starts_with($path, '//') || str_contains($path, '\\')) {
            return null;
        }

        return $path;
    }
}
