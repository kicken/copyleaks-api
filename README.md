# Copyleaks API v3 Implementation

This is a simple [Copyleaks API version 3](https://api.copyleaks.com/documentation/v3) implementation. 

## Install

The easiest way to install this is to use composer.

    composer require kicken/copyleaks-api

## Usage

First create a new instance of the **CopyleaksAPI** class.  Then you can use the *account()*, *education()*, *business()*, and *download()* methods to access the api endpoints.  To authenticate with the API either pass a pre-existing authorization token to the constructor or call the `account()->login()` method to grab a new token.

Here are quick examples to help you get going.  Read the library source for more details about features and how to use the library.

**Submit a document for scanning using a URL.**

    const API_EMAIL = 'test@example.com';
    const API_KEY = 'secret_api_key';

    $client = new CopyleaksAPI();

    //Get authorization token (login)
    $response = $client->account()->login(new LoginParameters(API_EMAIL, API_KEY));
    $client->setAuthorization($response->accessToken);

    //Setup callback URLs
    $scanId = mt_rand();
    $documentUrl = 'https://example.com/webhook.php?scan=' . $scanId . '&action=download';
    $statusUrl = 'https://example.com/webhook.php?scan=' . $scanId . '&action=status&status={STATUS}';

    //Submit scan request
    $parameters = new SubmitUrlParameters($documentUrl, $scanId, $statusUrl);
    $client->education()->submitURL($parameters);

**Export results when complete**

    const API_EMAIL = 'test@example.com';
    const API_KEY = 'secret_api_key';

    $json = json_decode(file_get_contents('php://input'));
    $data = Completed::createFromJsonObject($json);

    $matchMap = [
        'internet' => $data->results->internet,
        'database' => $data->results->database
    ];

    $exportId = date('Ymd\tHis');
    $completeHook = 'https://example.com/webhook.php?' . http_build_query([
            'scan' => $scanId,
            'action' => 'export',
            'what' => 'complete'
        ]);
    $exportParameters = new ExportParameters($scanId, $exportId, $completeHook);
    foreach ($matchMap as $type => $matchList){
        /** @var ResultItem $resultItem */
        foreach ($matchList as $resultItem){
            $resultHook = 'https://example.com/webhook.php?' . http_build_query([
                    'scan' => $scanId,
                    'action' => 'export',
                    'what' => 'result',
                    'id' => $resultItem->id
                ]);
            $exportParameters->result($resultItem->id, $resultHook);
        }
    }

    $client = new CopyleaksAPI();
    $response = $client->account()->login(new LoginParameters(API_EMAIL, API_KEY));
    $client->setAuthorization($response->accessToken);
    $client->download()->export($exportParameters);

## Known issues
I've only implemented the API endpoints that are necessary for my use case so far.

There is currently no automated testing for this library.
