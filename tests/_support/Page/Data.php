<?php

namespace Page;

use Niden\Constants\Relationships;
use function Niden\Core\envValue;
use Niden\Mvc\Model\AbstractModel;

class Data
{
    public static $companiesUrl                                     = '/companies';
    public static $companiesRecordUrl                               = '/companies/%s';
    public static $companiesRecordRelationshipUrl                   = '/companies/%s/%s';
    public static $companiesRecordRelationshipRelationshipUrl       = '/companies/%s/relationships/%s';
    public static $loginUrl                                         = '/login';
    public static $individualTypesUrl                               = '/individual-types';
    public static $individualTypesRecordUrl                         = '/individual-types/%s';
    public static $individualTypesRecordRelationshipUrl             = '/individual-types/%s/%s';
    public static $individualTypesRecordRelationshipRelationshipUrl = '/individual-types/%s/relationships/%s';
    public static $productsUrl                                      = '/products';
    public static $productsRecordUrl                                = '/products/%s';
    public static $productsRecordRelationshipUrl                    = '/products/%s/%s';
    public static $productsRecordRelationshipRelationshipUrl        = '/products/%s/relationships/%s';
    public static $productTypesUrl                                  = '/product-types';
    public static $productTypesRecordUrl                            = '/product-types/%s';
    public static $productTypesRecordRelationshipUrl                = '/product-types/%s/%s';
    public static $productTypesRecordRelationshipRelationshipUrl    = '/product-types/%s/relationships/%s';
    public static $usersUrl                                         = '/users';
    public static $wrongUrl                                         = '/sommething';

    /**
     * @return array
     */
    public static function loginJson()
    {
        return [
            'username' => 'testuser',
            'password' => 'testpassword',
        ];
    }

    /**
     * @param        $name
     * @param string $address
     * @param string $city
     * @param string $phone
     *
     * @return array
     */
    public static function companyAddJson($name, $address = '', $city = '', $phone = '')
    {
        return [
            'name'    => $name,
            'address' => $address,
            'city'    => $city,
            'phone'   => $phone,
        ];
    }

    /**
     * @param AbstractModel $record
     *
     * @return array
     * @throws \Niden\Exception\ModelException
     */
    public static function companyResponse(AbstractModel $record)
    {
        return [
            'id'         => $record->get('id'),
            'type'       => Relationships::COMPANIES,
            'attributes' => [
                'name'    => $record->get('name'),
                'address' => $record->get('address'),
                'city'    => $record->get('city'),
                'phone'   => $record->get('phone'),
            ],
            'links'      => [
                'self' => sprintf(
                    '%s/%s/%s',
                    envValue('APP_URL'),
                    Relationships::COMPANIES,
                    $record->get('id')
                ),
            ],
        ];
    }

    /**
     * @param AbstractModel $record
     *
     * @return array
     * @throws \Niden\Exception\ModelException
     */
    public static function individualTypeResponse(AbstractModel $record)
    {
        return [
            'id'         => $record->get('id'),
            'type'       => Relationships::INDIVIDUAL_TYPES,
            'attributes' => [
                'name'        => $record->get('name'),
                'description' => $record->get('description'),
            ],
            'links'      => [
                'self' => sprintf(
                    '%s/%s/%s',
                    envValue('APP_URL'),
                    Relationships::INDIVIDUAL_TYPES,
                    $record->get('id')
                ),
            ],
        ];
    }

    /**
     * @param AbstractModel $record
     *
     * @return array
     * @throws \Niden\Exception\ModelException
     */
    public static function productResponse(AbstractModel $record)
    {
        return [
            'type'       => Relationships::PRODUCTS,
            'id'         => $record->get('id'),
            'attributes' => [
                'typeId'      => $record->get('typeId'),
                'name'        => $record->get('name'),
                'description' => $record->get('description'),
                'quantity'    => $record->get('quantity'),
                'price'       => $record->get('price'),
            ],
            'links'      => [
                'self' => sprintf(
                    '%s/%s/%s',
                    envValue('APP_URL'),
                    Relationships::PRODUCTS,
                    $record->get('id')
                ),
            ],
        ];
    }

    /**
     * @param AbstractModel $record
     *
     * @return array
     * @throws \Niden\Exception\ModelException
     */
    public static function productTypeResponse(AbstractModel $record)
    {
        return [
            'id'         => $record->get('id'),
            'type'       => Relationships::PRODUCT_TYPES,
            'attributes' => [
                'name'        => $record->get('name'),
                'description' => $record->get('description'),
            ],
            'links'      => [
                'self' => sprintf(
                    '%s/%s/%s',
                    envValue('APP_URL'),
                    Relationships::PRODUCT_TYPES,
                    $record->get('id')
                ),
            ],
        ];
    }

    /**
     * @param AbstractModel $record
     *
     * @return array
     * @throws \Niden\Exception\ModelException
     */
    public static function userResponse(AbstractModel $record)
    {
        return [
            'id'         => $record->get('id'),
            'type'       => Relationships::USERS,
            'attributes' => [
                'status'        => $record->get('status'),
                'username'      => $record->get('username'),
                'issuer'        => $record->get('issuer'),
                'tokenPassword' => $record->get('tokenPassword'),
                'tokenId'       => $record->get('tokenId'),
            ],
            'links'      => [
                'self' => sprintf(
                    '%s/%s/%s',
                    envValue('APP_URL'),
                    Relationships::USERS,
                    $record->get('id')
                ),
            ],
        ];
    }
}
