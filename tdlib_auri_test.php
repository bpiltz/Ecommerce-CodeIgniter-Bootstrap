<?php
Error_Reporting(E_ALL);
ini_set('display_errors', 1);

$api_id = 3779551; // must be an integer
$api_hash = '06d9876921084cfa91082847c20ce04b';
$phone_number = '+491702782646';

try {
    \TDApi\LogConfiguration::setLogVerbosityLevel(\TDApi\LogConfiguration::LVL_ERROR);
    
    $client = new \TDLib\JsonClient();
    
    $tdlibParams = new \TDApi\TDLibParameters();
    $tdlibParams
        ->setParameter(\TDApi\TDLibParameters::USE_TEST_DC, true)
        ->setParameter(\TDApi\TDLibParameters::DATABASE_DIRECTORY, '/var/tmp/tdlib')
        ->setParameter(\TDApi\TDLibParameters::FILES_DIRECTORY, '/var/tmp/tdlib')
        ->setParameter(\TDApi\TDLibParameters::USE_FILE_DATABASE, false)
        ->setParameter(\TDApi\TDLibParameters::USE_CHAT_INFO_DATABASE, false)
        ->setParameter(\TDApi\TDLibParameters::USE_MESSAGE_DATABASE, false)
        ->setParameter(\TDApi\TDLibParameters::USE_SECRET_CHATS, false)
        ->setParameter(\TDApi\TDLibParameters::API_ID, $api_id)
        ->setParameter(\TDApi\TDLibParameters::API_HASH, $api_hash)
        ->setParameter(\TDApi\TDLibParameters::SYSTEM_LANGUAGE_CODE, 'en')
        ->setParameter(\TDApi\TDLibParameters::DEVICE_MODEL, php_uname('s'))
        ->setParameter(\TDApi\TDLibParameters::SYSTEM_VERSION, php_uname('v'))
        ->setParameter(\TDApi\TDLibParameters::APPLICATION_VERSION, '0.0.10')
        ->setParameter(\TDApi\TDLibParameters::ENABLE_STORAGE_OPTIMIZER, true)
        ->setParameter(\TDApi\TDLibParameters::IGNORE_FILE_NAMES, false);
    $result = $client->setTdlibParameters($tdlibParams);
    echo "1: ";
    var_dump($result);
    $result = $client->setDatabaseEncryptionKey();
    echo "2: ";
    var_dump($result);
    $state = $client->getAuthorizationState();
    echo "3: ";
    var_dump($result);
    // you must check the state and follow workflow. Lines below is just for an example.
    $result = $client->setAuthenticationPhoneNumber($phone_number, 3); // wait response 3 seconds. default - 1.
    echo "4: ";
    var_dump($result);
    $result = $client->query(json_encode(['@type' => 'checkAuthenticationCode', 'code' => '44765', 'first_name' => 'Benjamin', 'last_name' => 'Piltz']), 10);
    echo "5: ";
    var_dump($result);    
    $result = $client->query(json_encode(['@type' => 'acceptTermsOfService', 'ID' => '2130576356']), 10);
    echo "6: ";
    var_dump($result);    
   	$result = $client->query(json_encode(['@type' => 'searchPublicChat', 'username' => 'telegram']), 10);
    echo "7: ";
    var_dump($result);    
    $allNotifications = $client->getReceivedResponses();
    echo "8:";
    var_dump($allNotifications);
    //$allChats = $client->query(json_encode(['@type' => 'getChats']));
    //echo "8:";
    //var_dump($allNotifications);

} catch (\Exception $exception) {
    echo sprintf('something goes wrong: %s', $exception->getMessage());
}