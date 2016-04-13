<?php

namespace Euc\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Euc\EUC;

class EucController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function privacy()
    {
        return view(config('app.privacy_document'));
    }

    public function cookiesOptIn()
    {
        EUC::optIn();

        return view('pages.meta.cookies-optin');
    }

    public function cookiesOptOut()
    {
        EUC::optOut();

        return view('pages.meta.cookies-optout');
    }
}
