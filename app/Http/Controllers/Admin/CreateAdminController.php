<?php

namespace App\Http\Controllers\Admin;

use Throwable;


class CreateAdminController extends BaseAdminController
{
    public function __invoke()
    {
        try {
            return $this->view('admin.pages.create');
        } catch (Throwable $e) {
            // Log here
            return redirect()
                ->back()
                ->withErrors('An error occurred');
        }
    }
}
