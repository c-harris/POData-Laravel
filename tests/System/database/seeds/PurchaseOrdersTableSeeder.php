<?php

use Illuminate\Database\Seeder;

class PurchaseOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('purchase_orders')->delete();
        
        \DB::table('purchase_orders')->insert(
            [
            0 =>
            [
                'id' => 90,
                'supplier_id' => 1,
                'created_by' => 2,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 2,
            ],
            1 =>
            [
                'id' => 91,
                'supplier_id' => 3,
                'created_by' => 2,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 2,
            ],
            2 =>
            [
                'id' => 92,
                'supplier_id' => 2,
                'created_by' => 2,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 2,
            ],
            3 =>
            [
                'id' => 93,
                'supplier_id' => 5,
                'created_by' => 2,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 2,
            ],
            4 =>
            [
                'id' => 94,
                'supplier_id' => 6,
                'created_by' => 2,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 2,
            ],
            5 =>
            [
                'id' => 95,
                'supplier_id' => 4,
                'created_by' => 2,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 2,
            ],
            6 =>
            [
                'id' => 96,
                'supplier_id' => 1,
                'created_by' => 5,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #30',
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 5,
            ],
            7 =>
            [
                'id' => 97,
                'supplier_id' => 2,
                'created_by' => 7,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #33',
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 7,
            ],
            8 =>
            [
                'id' => 98,
                'supplier_id' => 2,
                'created_by' => 4,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #36',
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 4,
            ],
            9 =>
            [
                'id' => 99,
                'supplier_id' => 1,
                'created_by' => 3,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #38',
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 3,
            ],
            10 =>
            [
                'id' => 100,
                'supplier_id' => 2,
                'created_by' => 9,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #39',
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 9,
            ],
            11 =>
            [
                'id' => 101,
                'supplier_id' => 1,
                'created_by' => 2,
                'submitted_date' => '2006-01-14 00:00:00',
                'creation_date' => '2006-01-22 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #40',
                'approved_by' => 2,
                'approved_date' => '2006-01-22 00:00:00',
                'submitted_by' => 2,
            ],
            12 =>
            [
                'id' => 102,
                'supplier_id' => 1,
                'created_by' => 1,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #41',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 1,
            ],
            13 =>
            [
                'id' => 103,
                'supplier_id' => 2,
                'created_by' => 1,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #42',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 1,
            ],
            14 =>
            [
                'id' => 104,
                'supplier_id' => 2,
                'created_by' => 1,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #45',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 1,
            ],
            15 =>
            [
                'id' => 105,
                'supplier_id' => 5,
                'created_by' => 7,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => 'Check',
                'notes' => 'Purchase generated based on Order #46',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 7,
            ],
            16 =>
            [
                'id' => 106,
                'supplier_id' => 6,
                'created_by' => 7,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #46',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 7,
            ],
            17 =>
            [
                'id' => 107,
                'supplier_id' => 1,
                'created_by' => 6,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #47',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 6,
            ],
            18 =>
            [
                'id' => 108,
                'supplier_id' => 2,
                'created_by' => 4,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #48',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 4,
            ],
            19 =>
            [
                'id' => 109,
                'supplier_id' => 2,
                'created_by' => 4,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #48',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 4,
            ],
            20 =>
            [
                'id' => 110,
                'supplier_id' => 1,
                'created_by' => 3,
                'submitted_date' => '2006-03-24 00:00:00',
                'creation_date' => '2006-03-24 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #49',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 3,
            ],
            21 =>
            [
                'id' => 111,
                'supplier_id' => 1,
                'created_by' => 2,
                'submitted_date' => '2006-03-31 00:00:00',
                'creation_date' => '2006-03-31 00:00:00',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => 'Purchase generated based on Order #56',
                'approved_by' => 2,
                'approved_date' => '2006-04-04 00:00:00',
                'submitted_by' => 2,
            ],
            22 =>
            [
                'id' => 140,
                'supplier_id' => 6,
                'created_by' => null,
                'submitted_date' => '2006-04-25 00:00:00',
                'creation_date' => '2006-04-25 16:40:51',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-04-25 16:41:33',
                'submitted_by' => 2,
            ],
            23 =>
            [
                'id' => 141,
                'supplier_id' => 8,
                'created_by' => null,
                'submitted_date' => '2006-04-25 00:00:00',
                'creation_date' => '2006-04-25 17:10:35',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-04-25 17:10:55',
                'submitted_by' => 2,
            ],
            24 =>
            [
                'id' => 142,
                'supplier_id' => 8,
                'created_by' => null,
                'submitted_date' => '2006-04-25 00:00:00',
                'creation_date' => '2006-04-25 17:18:29',
                'status_id' => 2,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => 'Check',
                'notes' => null,
                'approved_by' => 2,
                'approved_date' => '2006-04-25 17:18:51',
                'submitted_by' => 2,
            ],
            25 =>
            [
                'id' => 146,
                'supplier_id' => 2,
                'created_by' => 2,
                'submitted_date' => '2006-04-26 18:26:37',
                'creation_date' => '2006-04-26 18:26:37',
                'status_id' => 1,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => null,
                'approved_date' => null,
                'submitted_by' => 2,
            ],
            26 =>
            [
                'id' => 147,
                'supplier_id' => 7,
                'created_by' => 2,
                'submitted_date' => '2006-04-26 18:33:28',
                'creation_date' => '2006-04-26 18:33:28',
                'status_id' => 1,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => null,
                'approved_date' => null,
                'submitted_by' => 2,
            ],
            27 =>
            [
                'id' => 148,
                'supplier_id' => 5,
                'created_by' => 2,
                'submitted_date' => '2006-04-26 18:33:52',
                'creation_date' => '2006-04-26 18:33:52',
                'status_id' => 1,
                'expected_date' => null,
                'shipping_fee' => '0.0000',
                'taxes' => '0.0000',
                'payment_date' => null,
                'payment_amount' => '0.0000',
                'payment_method' => null,
                'notes' => null,
                'approved_by' => null,
                'approved_date' => null,
                'submitted_by' => 2,
            ],
            ]
        );
    }
}
