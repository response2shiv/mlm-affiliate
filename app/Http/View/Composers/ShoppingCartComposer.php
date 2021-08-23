<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class ShoppingCartComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('shoppingCartList', $this->getShoppingCartList());
        $view->with('creditCards', $this->getCreditCards());
    }

    /**
     * Products list for prototype purpose. This will be changed later.
     *
     * @return array
     */
    private function getShoppingCartList(): array
    {
        return [
            'products' => [
                [
                    'title' => 'Desktop publishing software',
                    'long_description' => ' It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is ',
                    'quantity' => 1,
                    'price' => 180.0
                ],
                [
                    'title' => 'Text editor',
                    'long_description' => ' There are many variations of passages of Lorem Ipsum available ',
                    'quantity' => 2,
                    'price' => 50.0
                ],
                [
                    'title' => 'CRM Software',
                    'long_description' => ' Distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is ',
                    'quantity' => 1,
                    'price' => 110.0
                ],
                [
                    'title' => 'PM Software',
                    'long_description' => ' Readable content of a page when looking at its layout. The point of using Lorem Ipsum is ',
                    'quantity' => 1,
                    'price' => 130.0
                ],
                [
                    'title' => 'Photo Editor',
                    'long_description' => ' Page when looking at its layout. The point of using Lorem Ipsum is ',
                    'quantity' => 1,
                    'price' => 70.0
                ]
            ],
            'total' => 5686.0
        ];
    }

    /**
     * Credit cards list for prototype purpose. This will be changed later.
     *
     * @return array
     */
    private function getCreditCards(): array
    {
        return [
            [
                'number' => '**** **** **** 1060',
                'expireDate' => '10/16',
                'name' => 'David Williams',
                'icon' => 'fa-cc-visa',
                'isPrimary' => true,
                'isActive' => true
            ],
            [
                'number' => '**** **** **** 7002',
                'expireDate' => '10/16',
                'name' => 'Anna Smith',
                'icon' => 'fa-cc-mastercard',
                'isPrimary' => false,
                'isActive' => true
            ],
            [
                'number' => '**** **** **** 3466',
                'expireDate' => '10/16',
                'name' => 'Morgan Stanch',
                'icon' => 'fa-cc-discover',
                'isPrimary' => false,
                'isActive' => false
            ],
            [
                'number' => '**** **** **** 3466',
                'expireDate' => '10/16',
                'name' => 'Morgan Stanch',
                'icon' => 'fa-credit-card',
                'isPrimary' => false,
                'isActive' => true
            ],
        ];
    }
}
