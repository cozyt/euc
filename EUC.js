/**
 * EUC
 * A collection of methods used for handling cookies specifically to
 * help comply with the EU cookie law.
 */

var EUC = {
	version: 1,
	acceptVal: 1,


    /**
     * Sets a cookie when the application loads initially. This will be used to
     * determine the state of the users acceptance of cookies for the
     * application. Such as if the user has been shown a cookie notice or when
     * the user uses the application for the first time.
     *
     * The cookie is constantly updated with a new expiry date to prevent it
     * from expiring.
     *
     * @return void
     */
	init : function() {
		if(EUC.enabled() && EUC.isCurrent() === false) {
			EUC.optIn();
			EUC.showNotice();
		} else {
			EUC.hideNotice();
		}
	},


    /**
     * Method to handle the user opting in to using cookies and acceptance of
     * the cookie policy for the application
     *
     * @return void
     */
	optIn : function() {
		localStorage.setItem('cookie_version', EUC.acceptVal);
	},


    /**
     * Method to handle the user opting out of using cookies and non-compliance
     * with the cookie policy of the application.
     * Will also, optionally, remove any pre-set Google Analytics cookies
     *
     * @return void
     */
	optOut : function() {
		localStorage.setItem('cookie_version', -1);
	},


    /**
     * Current version of the cookie
     *
     * @return int
     */
	currentVersion : function() {
		return parseInt(localStorage.getItem('cookie_version'), 10);
	},


    /**
     * Determine if cookies have been rejected.
     *
     * @return boolean
     */
	rejected : function() {
		return EUC.currentVersion() === -1;
	},


    /**
     * Determine if cookies are enabled.
     * Cookies are always enabled unless they have been rejected, even if
     * cookies have not yet even be set or the cookie notice has not yet
     * been shown.
     *
     * @return boolean
     */
	enabled : function() {
		return EUC.rejected() === false;
	},


    /**
     * Determine if the cookie matches the current version.
     *
     * @return boolean
     */
	isCurrent : function() {
		return EUC.currentVersion() === EUC.version;
	},


	/**
	 * [showNotice description]
	 * @return {[type]} [description]
	 */
	showNotice : function() {
		$('.cookie-notice__state').prop('checked', !1);
	},


	/**
	 * [hideNotice description]
	 * @return {[type]} [description]
	 */
	hideNotice : function() {
		$('.cookie-notice__state').prop('checked', !0);
	}
};
