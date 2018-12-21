// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if (typeof mkdfSocialLoginVars !== 'undefined') {
    var facebookAppId = mkdfSocialLoginVars.social.facebookAppId;
}
if (facebookAppId) {
    window.fbAsyncInit = function () {
        FB.init({
            appId: facebookAppId, //265124653818954 - test app ID
            cookie: true,  // enable cookies to allow the server to access
            xfbml: true,  // parse social plugins on this page
            version: 'v2.5' // use version 2.5
        });

        window.FB = FB;
    };
}

(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof mkdf !== 'undefined' ) {
        mkdf.modules.socialLogin = socialLogin;
    }

    socialLogin.mkdfUserLogin = mkdfUserLogin;
    socialLogin.mkdfUserRegister = mkdfUserRegister;
    socialLogin.mkdfUserLostPassword = mkdfUserLostPassword;
    socialLogin.mkdfInitLoginWidgetModal = mkdfInitLoginWidgetModal;
    socialLogin.mkdfInitFacebookLogin = mkdfInitFacebookLogin;
    socialLogin.mkdfInitGooglePlusLogin = mkdfInitGooglePlusLogin;
    socialLogin.mkdfUpdateUserProfile = mkdfUpdateUserProfile;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitLoginWidgetModal();
        mkdfUserLogin();
        mkdfUserRegister();
        mkdfUserLostPassword();
        mkdfUpdateUserProfile();
    }

    /**
     * All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitFacebookLogin();
        mkdfInitGooglePlusLogin();
        mkdfMembershipFullScreen();
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
    }

    /**
     * Initialize login widget modal
     */
    function mkdfInitLoginWidgetModal() {

        var modalOpener = $('.mkdf-login-opener'),
            modalHolder = $('.mkdf-login-register-holder');

        if (modalOpener) {
            var tabsHolder = $('.mkdf-login-register-content');

            //Init opening login modal
            modalOpener.click(function (e) {
                e.preventDefault();
                modalHolder.fadeIn(300);
                modalHolder.addClass('opened');
            });

            //Init closing login modal
            modalHolder.click(function (e) {
                if (modalHolder.hasClass('opened')) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
            $('.mkdf-login-register-content').click(function (e) {
                e.stopPropagation();
            });
            // on esc too
            $(window).on('keyup', function (e) {
                if (modalHolder.hasClass('opened') && e.keyCode == 27) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });

            //Init tabs
            tabsHolder.tabs();
        }
    }

    /**
     * Login user via Ajax
     */
    function mkdfUserLogin() {
        $('.mkdf-login-form').on('submit', function (e) {
            e.preventDefault();
            var ajaxData = {
                action: 'mkdf_membership_login_user',
                security: $(this).find('#mkdf-login-security').val(),
                login_data: $(this).serialize()
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }

            });
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function mkdfUserRegister() {

        $('.mkdf-register-form').on('submit', function (e) {

            e.preventDefault();
            var ajaxData = {
                action: 'mkdf_membership_register_user',
                security: $(this).find('#mkdf-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function mkdfUserLostPassword() {

        var lostPassForm = $('.mkdf-reset-pass-form');
        lostPassForm.submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'mkdf_membership_user_lost_password',
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response = JSON.parse(data);
                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function mkdfRenderAjaxResponseMessage(response) {

        var responseHolder = $('.mkdf-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.mkdf-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'mkdf-membership-message-succes';
        } else {
            messageClass = 'mkdf-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Facebook Login
     */
    function mkdfInitFacebookLogin() {
        var loginForm = $('.mkdf-facebook-login-holder');
        loginForm.submit(function (e) {
            e.preventDefault();
            window.FB.login(function (response) {
                mkdfFacebookCheckStatus(response);
            }, {scope: 'email, public_profile'});
        });

    }

    /**
     * Check if user is logged into Facebook and App
     *
     * @param response
     */
    function mkdfFacebookCheckStatus(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            mkdfGetFacebookUserData();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    /**
     * Get user data from Facebook and login user
     */
    function mkdfGetFacebookUserData() {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', {'fields': 'id, name, email, link, picture'}, function (response) {
            var nonce = $('.mkdf-facebook-login-holder [name^=mkdf_nonce_facebook_login]').val();
            response.nonce = nonce;
            response.image = response.picture.data.url;
            var data = {
                action: 'mkdf_membership_check_facebook_user',
                response: response
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

        });
    }

    /**
     * Google Login
     */
    function mkdfInitGooglePlusLogin() {

        if (typeof mkdfSocialLoginVars !== 'undefined') {
            var clientId = mkdfSocialLoginVars.social.googleClientId;
        }
        if (clientId) {
            gapi.load('auth2', function () {
                window.auth2 = gapi.auth2.init({
                    client_id: clientId
                });
                mkdfInitGooglePlusLoginButton();
            });
        } else {
            var loginForm = $('.mkdf-google-login-holder');
            loginForm.submit(function (e) {
                e.preventDefault();
            });
        }

    }

    /**
     * Initialize login button for Google Login
     */
    function mkdfInitGooglePlusLoginButton() {

        var loginForm = $('.mkdf-google-login-holder');
        loginForm.submit(function (e) {
            e.preventDefault();
            window.auth2.signIn();
            mkdfSignInCallback();
        });

    }

    /**
     * Get user data from Google and login user
     */
    function mkdfSignInCallback() {
        var signedIn = window.auth2.isSignedIn.get();
        if (signedIn) {
            var currentUser = window.auth2.currentUser.get(),
                profile = currentUser.getBasicProfile(),
                nonce = $('.mkdf-google-login-holder [name^=mkdf_nonce_google_login]').val(),
                userData = {
                    id: profile.getId(),
                    name: profile.getName(),
                    email: profile.getEmail(),
                    image: profile.getImageUrl(),
                    link: 'https://plus.google.com/' + profile.getId(),
                    nonce: nonce
                },
                data = {
                    action: 'mkdf_membership_check_google_user',
                    response: userData
                };
            $.ajax({
                type: 'POST',
                data: data,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    mkdfRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        }
    }

    /**
     * Update User Profile
     */
    function mkdfUpdateUserProfile() {
        var updateForm = $('#mkdf-membership-update-profile-form');
        if ( updateForm.length ) {
            var btnText = updateForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            updateForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'mkdf_membership_update_user_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        mkdfRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

    function mkdfMembershipFullScreen() {
        var membership = $('.mkdf-membership-main-wrapper');
        var profileContent = $('.page-template-user-dashboard .mkdf-content');
        var footer = $('.mkdf-page-footer');

        var reduceHeight = 0;

        if(!mkdf.body.hasClass('mkdf-header-transparent') && mkdf.windowWidth > 1024) {
            reduceHeight = reduceHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight;
        }
        if(footer.length > 0) {
            reduceHeight += footer.outerHeight();
        }

        if(mkdf.windowWidth > 1024) {
            var height = mkdf.windowHeight - reduceHeight;
            profileContent.css({'min-height': height  + 'px'});
        }
    }

})(jQuery);