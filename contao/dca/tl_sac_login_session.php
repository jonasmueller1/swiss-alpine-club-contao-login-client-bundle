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

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_sac_login_session'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'doNotCopyRecords' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],
    'fields' => [
        'id'       => [
            'sql' => 'int(10) unsigned NOT NULL auto_increment',
        ],
        'tstamp'   => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],
        'expires'  => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],
        'uuid'     => [
            'sql' => "varchar(1024) NULL default ''",
        ],
        'id_token' => [
            'sql' => 'text NULL',
        ],
    ],
];
