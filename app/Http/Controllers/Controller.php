<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    /**
     * Standard response helper used across controllers.
     *
     * @param bool $success
     * @param string $message
     * @param Request $request
     * @param int $statusCode
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function respondWithJson(bool $success, string $message, Request $request, int $statusCode = 200)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => $success,
                'message' => $message,
            ], $statusCode);
        }

        return redirect()->back()->with('success', $message);
    }
}
