<?php

/*
 * Не уверен, как правильно читать такое количество данных, поэтому предполагается, что используется следующий запрос:
 * SELECT `email` FROM `users` WHERE POSITION('@' IN `email`) != 0;
 *
 * Возможно, имеет смысл получить данные через несколько запросов с использованием LIMIT и OFFSET.
 *
 * Для выполнения данного запроса можно использовать PDO либо какую-нибудь ORM. На выходе должны получить такой же массив,
 * как возвращает функция mockUsers
 */

/**
 * @param int $numberOfUsers
 * @return array
 */
function mockUsers(int $numberOfUsers): array
{
    $users = [];

    $domainsList = [
        '',
        'test@mail.ru',
        'test@yandex.ru,test@mail.ru',
        'test@gmail.com',
        'test@yandex.ru,test@mail.ru,test@gmail.com',
        'test@yahoo.com,test@mail.ru,test@gmail.com',
        '123123123',
    ];

    for ($i = 0; $i < $numberOfUsers; $i++) {
        $users[]['email'] = $domainsList[mt_rand(0, count($domainsList) - 1)];
    }

    return $users;
}

/**
 * @param array $users
 * @return array
 */
function getListOfDomains(array $users): array
{
    $emailDomains = [];

    foreach ($users as $user) {
        $emails = explode(',', $user['email']);

        foreach ($emails as $email) {
            $emailChunks = explode('@', $email);

            if (!isset($emailChunks[1])) {
                continue;
            }

            if (!isset($emailDomains[$emailChunks[1]])) {
                $emailDomains[$emailChunks[1]] = 0;
            }

            $emailDomains[$emailChunks[1]]++;
        }
    }

    return $emailDomains;
}

$users = mockUsers(100000000);

echo '-----------------------------------------------------------------------------------------------------------------';

$t1 = microtime(true);
var_dump(getListOfDomains($users));
$t2 = microtime(true) - $t1;
echo $t2 . PHP_EOL;
