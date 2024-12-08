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

namespace Markocupic\SwissAlpineClubContaoLoginClientBundle\EventListener;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Doctrine\DBAL\Connection;
use Markocupic\SwissAlpineClubContaoLoginClientBundle\Event\ParseAccessTokenEvent;
use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsEventListener]
class ParseAccessTokenListener
{
    public function __construct(
        private readonly Connection $connection,
        private readonly RequestStack $requestStack,
        private readonly ScopeMatcher $scopeMatcher,
    ) {
    }

    public function __invoke(ParseAccessTokenEvent $event): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $uuid = Uuid::uuid4()->toString();
        $response = $event->getResponse();

        if ($this->scopeMatcher->isBackendRequest($request)) {
            $session->set('sac_login_session_backend', $uuid);
        } else {
            $session->set('sac_login_session_frontend', $uuid);
        }

        $set = [
            'tstamp' => time(),
            'uuid' => $uuid,
            'expires' => time() + 3600 * 24,
            'id_token' => $response['id_token'],
        ];

        $this->connection->insert('tl_sac_login_session', $set);
    }
}
