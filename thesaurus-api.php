<?php

use GuzzleHttp\Exception\GuzzleException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\InactiveKeyException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\MissingWordsException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\NotFoundException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\NotWhitelistedException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\UsageExceededException;
use PhantomWatson\Bombasticator\API;

require_once('./vendor/autoload.php');
require_once('./src/API.php');

/**
 * @param \Exception $exception
 * @return void
 */
function handleException($exception)
{
    header(sprintf(
        'HTTP/1.1 %s %s',
        $exception->getCode(),
        $exception->getMessage()
    ));
    echo $exception->getMessage();
    exit;
}

$word = $_GET['word'] ?? false;
try {
    $options = $word ? API::fetch($word) : [];
    echo json_encode($options);
} catch (NotFoundException $exception) {
    handleException($exception);
} catch (UsageExceededException $exception) {
    handleException($exception);
} catch (InactiveKeyException $exception) {
    handleException($exception);
} catch (MissingWordsException $exception) {
    handleException($exception);
} catch (NotWhitelistedException $exception) {
    handleException($exception);
} catch (GuzzleException $exception) {
    handleException($exception);
}
