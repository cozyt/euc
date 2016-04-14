<?php
/**
 * EUC
 * A collection of methods used for handling cookies in Laravel specifically to
 * help comply with the EU cookie law.
 *
 * @url https://bitbucket.org/cozyt/euc
 * @dependencies string Config::get('app.privacy_document')) Path to the privacy policy document defined as a view path
 * @author A. Harvey @since 0.1
 * @version 0.1
 * @since 0.1
 */

namespace Euc;

use Config;
use Cookie;
use File;
use View;

class EUC
{
    /**
     * Sets a cookie when the application loads initially. This will be used to
     * determine the state of the users acceptance of cookies for the
     * application. Such as if the user has been shown a cookie notice or when
     * the user uses the application for the first time.
     *
     * The cookie is constantly updated with a new expiry date to prevent it
     * from expiring.
     *
     * @param object $response
     * @example App::after(function($request, $response) { EUC::setInitial(); } // in app/filters.php
     * @return void
     */
    public static function init()
    {
        if( self::enabled() && ! self::isCurrent() )
        {
            self::optIn();
        }
    }

    /**
     * Method to handle the user opting in to using cookies and acceptance of
     * the cookie policy for the application
     *
     * @return object
     */
    public static function optIn()
    {
        return self::set(self::currentVersion(), time() + 30);
    }

    /**
     * Method to handle the user opting out of using cookies and non-compliance
     * with the cookie policy of the application.
     * Will also, optionally, remove any pre-set Google Analytics cookies
     *
     * @return object
     */
    public static function optOut()
    {
        return self::set(-1, time() + 30);
    }

    /**
     * Returns the general cookie name
     *
     * @return string
     */
    public static function name()
    {
        return 'cookies_accepted'; // md5(Config::get('app.url'));
    }


    /**
     * Get the value of the cookie
     *
     * @return string
     */
    public static function get()
    {
        return Cookie::get(self::name());
    }


    /**
     * Set a value for the cookie
     *
     * @param obj $response The current response object
     * @param int $value The value to store in the cookie
     * @param int $time The time that the cookie should expire
     * @return object
     */
    public static function set($value=NULL, $time=0)
    {
        return Cookie::queue(self::name(), $value, $time);
    }


    /**
     * Current version of the cookie
     *
     * @return int
     */
    public static function currentVersion()
    {
        $filepath = Config::get('view.paths.0') . '/' . str_replace('.', '/', Config::get('app.privacy_document'));

        if (file_exists($filepath . '.php')) {
            return File::lastModified($filepath . '.php');
        }

        if(file_exists($filepath . '.blade.php')) {
            return File::lastModified($filepath . '.blade.php');
        }

        return 0;
    }


    /**
     * Determine if cookies have been rejected.
     *
     * @return boolean
     */
    public static function rejected()
    {
        return self::get() == -1;
    }


    /**
     * Determine if cookies are enabled.
     * Cookies are always enabled unless they have been rejected, even if
     * cookies have not yet even be set or the cookie notice has not yet
     * been shown.
     *
     * @return boolean
     */
    public static function enabled()
    {
        return ! self::rejected();
    }


    /**
     * Determine if the cookie matches the current version.
     *
     * @return boolean
     */
    public static function isCurrent()
    {
        $cookieVal = self::get();

        if ($cookieVal === null) {
            return false;
        }

        return $cookieVal === self::currentVersion();
    }

}
