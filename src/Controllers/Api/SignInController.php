<?php

namespace Qihucms\SignIn\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Qihucms\SignIn\Resources\SignInCollection;
use Qihucms\SignIn\SignIn;

class SignInController extends Controller
{
    protected $signIn;

    /**
     * SignInController constructor.
     * @param SignIn $signIn
     */
    public function __construct(SignIn $signIn)
    {
        $this->middleware('auth:api')->only('sign');
        $this->signIn = $signIn;
    }

    /**
     * 会员签到
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sign()
    {
        $result = $this->signIn->sign(Auth::id());
        if ($result['code'] < 110) {
            return $this->jsonResponse($result, __('sign_in.message.' . $result['code']));
        }
        return $this->jsonResponse([__('sign_in.message.' . $result['code'])], '', 422);
    }

    /**
     * 签到排行榜
     *
     * @param Request $request
     * @return SignInCollection
     */
    public function ranking(Request $request)
    {
        $limit = $request->input('limit', 10);
        $items = $this->signIn->ranking($limit);
        return new SignInCollection($items);
    }
}