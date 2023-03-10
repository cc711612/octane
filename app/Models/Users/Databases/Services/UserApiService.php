<?php
/**
 * @Author: Roy
 * @DateTime: 2022/6/21 上午 11:25
 */

namespace App\Models\Users\Databases\Services;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\Databases\Entities\UserEntity;
use App\Concerns\Databases\Service;

class UserApiService extends Service
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     * @Author: Roy
     * @DateTime: 2022/6/21 上午 11:27
     */
    protected function getEntity(): Model
    {
        // TODO: Implement getEntity() method.
        if (app()->has(UserEntity::class) === false) {
            app()->singleton(UserEntity::class);
        }

        return app(UserEntity::class);
    }

    /**
     * @param  array  $create
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @Author: Roy
     * @DateTime: 2022/6/21 上午 11:27
     */
    public function create(array $create): Model
    {
        return parent::create($create); // TODO: Change the autogenerated stub
    }
}
