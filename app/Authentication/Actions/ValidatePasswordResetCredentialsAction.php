<?php

namespace App\Authentication\Actions;

use App\Authentication\Traits\ChecksRequestForExpiredResetToken;
use App\Authentication\Traits\ChecksRequestForResetParams;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use stdClass;

class ValidatePasswordResetCredentialsAction
{
    use ChecksRequestForResetParams,
        ChecksRequestForExpiredResetToken;

    private $password_reset_record;

    public function execute(Request|FormRequest $request) :void
    {
        $this->makeSureRequestHasEmailAndToken($request);

        $this->setPasswordResetRecord(
            $this->fetchStoredResetRecord($request)
        );

        if (!$this->password_reset_record) {
            abort(401);
        }

        $this->makeSurePasswordResetTokenHasNotExpired($this->password_reset_record);
    }

    public function setPasswordResetRecord($record)
    {
        $this->password_reset_record = $record;
    }

    public function getPasswordResetRecord()
    {
        return $this->password_reset_record;
    }

    public function fetchStoredResetRecord(Request|FormRequest $request) :?stdClass
    {
        return DB::table('password_resets')
            ->where('email', $request->input('email'))
            ->where('token', $request->input('token'))
            ->first();
    }
}