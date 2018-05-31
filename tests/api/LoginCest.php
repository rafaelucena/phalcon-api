<?php

namespace Niden\Tests\api;

use ApiTester;
use Niden\Exception\Exception;
use Niden\Http\Response;
use Niden\Models\Users;

class LoginCest
{
    public function loginNoDataElement(ApiTester $I)
    {
        $I->expectException(
            new Exception('"data" element not present in the payload'),
            function () use ($I) {
                $I->sendPOST(
                    '/login',
                    json_encode(
                        [
                            'username' => 'user',
                            'password' => 'pass',
                        ]
                    )
                );
            }
        );
    }

    public function loginUnknownUser(ApiTester $I)
    {
        $I->expectException(
            new Exception('Incorrect credentials'),
            function () use ($I) {
                $I->sendPOST(
                    '/login',
                    json_encode(
                        [
                            'data' => [
                                'username' => 'user',
                                'password' => 'pass',
                            ]
                        ]
                    )
                );
            }
        );
    }

    public function loginKnownUser(ApiTester $I)
    {
        $I->haveRecordWithFields(
            Users::class,
            [
                'usr_status_flag' => 1,
                'usr_username'    => 'testuser',
                'usr_password'    => 'testpassword',
                'usr_domain_name' => 'https://phalconphp.com',
                'usr_token_pre'   => '',
                'usr_token_mid'   => '',
                'usr_token_post'  => '',
                'usr_token_id'    => '110011',
            ]
        );

        $I->sendPOST(
            '/login',
            json_encode(
                [
                    'data' => [
                        'username' => 'testuser',
                        'password' => 'testpassword',
                    ]
                ]
            )
        );
        $I->seeResponseIsSuccessful();
        $I->seeResponseContainsJson(
            [
                'jsonapi' => [
                    'version' => '1.0',
                ],
                'errors' => [
                    'code'   => Response::STATUS_SUCCESS,
                    'detail' => '',
                ],
            ]
        );
    }
}
