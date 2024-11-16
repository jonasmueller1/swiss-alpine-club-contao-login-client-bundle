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

namespace Markocupic\SwissAlpineClubContaoLoginClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LogoutController extends AbstractController
{
    public function __construct(
        private readonly HttpClientInterface $client,
        #[Autowire('%sac_oauth2_client.oidc.client_id%')]
        private readonly string $clientId,
        #[Autowire('%sac_oauth2_client.oidc.client_secret%')]
        private readonly string $clientSecret,
        #[Autowire('%sac_oauth2_client.oidc.auth_provider_endpoint_logout%')]
        private readonly string $logoutEndpoint,
    ) {
    }

    #[Route('/_oauth2_login/hitobito/frontend/logout', name: self::class.'Frontend', defaults: ['_scope' => 'frontend'])]
    public function frontendLogout(string $accessToken): string
    {
        $params = [
            'token' => $accessToken,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $response = $this->client->request('POST', $this->logoutEndpoint, [
            'headers' => [
                'Authorization: Bearer '.$accessToken,
                'Content-Type: application/x-www-form-urlencoded',
            ],
            'body' => $params,
        ]);

        return $response->getContent();
    }
}
