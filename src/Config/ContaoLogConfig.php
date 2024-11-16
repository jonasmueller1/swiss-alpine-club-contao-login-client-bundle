<?php

declare(strict_types=1);

/*
 * This file is part of Swiss Alpine Club Contao Login Client Bundle.
 *
 * (c) Marko Cupic <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/swiss-alpine-club-contao-login-client-bundle
 */

namespace Markocupic\SwissAlpineClubContaoLoginClientBundle\Config;

final class ContaoLogConfig
{
    public const string SAC_OAUTH2_DEBUG_LOG = 'SAC_SSO_DEBUG_LOG';
    public const string SAC_OAUTH2_FRONTEND_LOGIN_FAIL = 'SAC_SSO_FRONTEND_LOGIN_FAIL';
    public const string SAC_OAUTH2_BACKEND_LOGIN_FAIL = 'SAC_SSO_BACKEND_LOGIN_FAIL';
}
