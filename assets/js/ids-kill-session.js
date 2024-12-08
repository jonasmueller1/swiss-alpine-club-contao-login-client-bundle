/*
 * This file is part of Swiss Alpine Club Contao Login Client Bundle.
 *
 * (c) Marko Cupic <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/swiss-alpine-club-contao-login-client-bundle
 */

"use strict";

window.addEventListener('DOMContentLoaded', () => {

    // Handle Contao frontend logout
    let feLogoutLinks = document.querySelectorAll('.trigger-ids-kill-session[data-href]');

    for (const link of feLogoutLinks) {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            if (link.hasAttribute('data-href')) {
                link.text = link.dataset.logoutLabel ?? 'du wirst abgemeldet …';
                link.removeAttribute('data-href');
                logout('frontend', link.getAttribute('href'), link.dataset.targetpath);
            }
        });
    }

    // Handle Contao backend logout
    let beLogoutLinks = document.querySelectorAll('#tmenu a[href$="contao/logout"]');

    for (const link of beLogoutLinks) {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            logout('backend', link.getAttribute('href'), false);
        });
    }

    /**
     * 1. Retrieve the Hitobito logout uri
     * 2. Redirect to the Hitobito logout endpoint.
     * 3. Thanks to the post_logout_redirect_uri query param Hitobito itself will redirect us back to Contao.
     *
     * @param contaoScope
     * @param contaoLogoutEndpoint
     * * @param postLogoutRedirectUri
     */
    async function logout(contaoScope, contaoLogoutEndpoint, postLogoutRedirectUri = null) {

        let logoutUrl = `/_oauth2_login/hitobito/${contaoScope}/logout`;

        if (contaoScope === 'frontend' && null !== postLogoutRedirectUri) {
            logoutUrl = `/_oauth2_login/hitobito/frontend/logout?post_logout_redirect_uri=${btoa(postLogoutRedirectUri)}`;
        }

        try {
            // Retrieve the Hitobito logout uri
            const response = await fetch(logoutUrl);

            if (!response.ok) {
                const errorMsg = `Could not fetch the hitobito logout url. Server returned status: ${response.status}`;
                return handleError(errorMsg);
            }

            const json = await response.json();

            // Call the Contao logout endpoint
            await fetch(contaoLogoutEndpoint);

            // Redirect to the Hitobito logout endpoint.
            // Thanks to the "post_logout_redirect_uri" query param
            // Hitobito itself will redirect us back to Contao.
            window.location.href = json['logoutUri'];
        } catch (error) {
            handleError(contaoScope, error.message);
        }
    }

    function handleError(contaoScope, errorMsg) {
        console.error(errorMsg);
        performContaoDefaultLogout(contaoScope);
    }

    function performContaoDefaultLogout(contaoScope) {
        if (contaoScope === 'frontend') {
            window.location.href = '/_contao/logout';
        } else {
            window.location.href = '/contao/logout';
        }
    }
});
