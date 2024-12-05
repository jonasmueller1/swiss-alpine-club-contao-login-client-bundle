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

namespace Markocupic\SwissAlpineClubContaoLoginClientBundle\Security\Authenticator\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class ResourceOwnerHasInvalidSacMemberIdException extends AuthenticationException
{
    public const string MESSAGE = 'Authentication process aborted! Resource owner has no sac member id.';
    public const string KEY = 'resourceOwnerHasInvalidSacMemberId';
}