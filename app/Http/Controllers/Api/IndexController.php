<?php
/**
 * @Author: Roy
 * @DateTime: 2022/12/21 下午 09:24
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallets\Databases\Services\WalletApiService;
use Illuminate\Support\Arr;

class IndexController extends Controller
{

    public function index(Request $request, int $wallet_id)
    {
        $requester = $request->toArray();
        Arr::set($requester, 'wallets.id', $wallet_id);

        $Wallet = app(WalletApiService::class)
            ->setRequest($requester)
            ->getWalletWithDetail();

        if (is_null($Wallet)) {
            return response()->json([
                'status' => false,
                'data'   => [],
            ]);
        }

        return response()->json([
            'status' => false,
            'data'   => $Wallet,
        ]);
    }
}
