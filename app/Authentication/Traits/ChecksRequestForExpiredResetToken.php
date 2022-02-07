<?php

namespace App\Authentication\Traits;

use stdClass;

trait ChecksRequestForExpiredResetToken
{
    protected function makeSurePasswordResetTokenHasNotExpired(
        stdClass $record
    ) :void
    {
        if (! $record) {
            abort(404);
        }

        $password_timeout = config('auth.password_timeout');

        if ($record->created_at < now()->subSeconds($password_timeout)) {
            abort(401);
        }
    }
}
