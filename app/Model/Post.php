<?php

declare(strict_types=1);

namespace App\Model;

class Post extends AbstractModel
{
    protected static $tableName = 'post';

    // add user data to post
    protected static function createObject(array $data): AbstractModel
    {
        if ($userId = $data['user_id'] ?? null) {
            $user = User::getOne('id', $userId);
            $data['user_name'] = "{$user->getFirstName()} {$user->getLastName()}";
        }
        return parent::createObject($data);
    }
}
