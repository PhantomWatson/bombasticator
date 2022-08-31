<?php

namespace PhantomWatson\Bombasticator;

use Mettleworks\BigHugeThesaurusClient\BigHugeThesaurusClient;
use Mettleworks\BigHugeThesaurusClient\Exceptions\InactiveKeyException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\MissingWordsException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\NotFoundException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\NotWhitelistedException;
use Mettleworks\BigHugeThesaurusClient\Exceptions\UsageExceededException;

/**
 * Class for interacting with the words.bighugelabs.com API
 */
class API
{
    /**
     * @param string $word
     * @return array
     * @throws BigHugeThesaurusClient
     * @throws InactiveKeyException
     * @throws MissingWordsException
     * @throws NotFoundException
     * @throws NotWhitelistedException
     * @throws UsageExceededException
     */
    public static function fetch($word)
    {
        if (trim($word) == '') {
            return [];
        }

        $apiKeyPath = dirname(__FILE__, 2) . '/config/api-key.php';
        $apiKey = require $apiKeyPath;
        $client = new BigHugeThesaurusClient($apiKey);
        $response = $client->lookup($word);
        $options = array_merge(
            $response->getSynonyms(),
            $response->getSimilarTerms(),
            $response->getRelatedTerms()
        );

        return array_unique($options);
    }
}
