<?php

namespace Qihucms\SignIn;

use Carbon\Carbon;
use Qihucms\SignIn\Models\SignIn as SignInModel;

class SignIn
{
    /**
     * 签到
     *
     * @param $user_id
     * @return array
     */
    public function sign($user_id): array
    {
        $sign = $this->findByUserId($user_id);

        if ($sign) {

            // 今天是否签到过
            if ($this->todayIsSign($sign->updated_at)) {

                return [
                    'code' => 111,
                    'data' => $sign->count
                ];

            } else {

                // 昨天是否签到过
                if ($this->yesterdayIsSign($sign->updated_at)) {

                    // 更新连续签到的天数
                    $sign->count += 1;

                    if ($sign->save()) {
                        // 连续签到成功
                        return [
                            'code' => 101,
                            'data' => $sign->count + 1
                        ];
                    } else {
                        // 系统错误
                        return [
                            'code' => 110,
                            'data' => $sign->count
                        ];
                    }

                } else {

                    // 重置连续签到天数
                    $sign->count = 1;

                    if ($sign->save()) {

                        // 签到成功
                        return [
                            'code' => 100,
                            'data' => $sign->count + 1
                        ];
                    } else {
                        // 系统错误
                        return [
                            'code' => 110,
                            'data' => $sign->count
                        ];
                    }
                }
            }
        } else {
            // 首次签到
            if (SignInModel::create(['user_id' => $user_id, 'count' => 1])) {
                // 首签成功
                return [
                    'code' => 100,
                    'data' => 1
                ];
            } else {
                // 系统错误
                return [
                    'code' => 110,
                    'data' => 0
                ];
            }
        }
    }

    /**
     * 签到排行榜
     *
     * @param int $limit 每页显示的条数
     * @return mixed
     */
    public function ranking($limit = 10)
    {
        return SignInModel::orderBy('count', 'desc')->latest()->paginate($limit);
    }

    /**
     * 会员的签到记录
     *
     * @param int $user_id
     * @return mixed
     */
    public function findByUserId($user_id)
    {
        return SignInModel::find($user_id);
    }

    /**
     * 验证用户是否签到过
     *
     * @param $user_id
     * @return mixed
     */
    public function isSign($user_id)
    {
        return SignInModel::where('user_id', $user_id)->exists();
    }

    /**
     * 今天是否签到过
     *
     * @param $updated_at
     * @return bool
     */
    public function todayIsSign($updated_at)
    {
        return Carbon::parse($updated_at)->toDateString() == Carbon::now()->toDateString();
    }

    /**
     * 昨天是否签到过
     *
     * @param $updated_at
     * @return bool
     */
    public function yesterdayIsSign($updated_at)
    {
        return Carbon::parse($updated_at)->toDateString() == Carbon::parse('yesterday')->toDateString();
    }
}