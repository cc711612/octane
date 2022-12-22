<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Wallets\Databases\Entities\WalletDetailEntity;

class InitializationWalletDetailSeeder extends Seeder
{
    private $num = 100000;
    private $table = WalletDetailEntity::Table;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Result = [];
        Schema::disableForeignKeyConstraints();
        for ($i = 0; $i < $this->num; $i++) {
            $Result[] = [
                'wallet_id'                => 1,
                'type'                     => random_int(1, 2),
                'payment_wallet_user_id'   => null,
                'title'                    => "測試明細Title",
                'symbol_operation_type_id' => random_int(1, 2),
                'select_all'               => 1,
                'value'                    => random_int(100, 10000),
            ];
            if (count($Result) >= 200) {
                WalletDetailEntity::insert($Result);
                $Result = [];
            }
        }
        WalletDetailEntity::insert($Result);
        Schema::enableForeignKeyConstraints();

        echo self::class.sprintf(" Table : %s Seeder Complete", $this->table).PHP_EOL.PHP_EOL;
    }
}
