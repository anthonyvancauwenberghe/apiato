<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserPasswordRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;

class UpdateUserPasswordAction extends Action
{
    /**
     * @param UpdateUserPasswordRequest $request
     * @return User
     * @throws IncorrectIdException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(UpdateUserPasswordRequest $request): User
    {
        $sanitizedData = $request->sanitizeInput([
            'current_password',
            'new_password',
        ]);

        return app(UpdateUserTask::class)->run(['password' => $sanitizedData['new_password']], $request->id);
    }
}
