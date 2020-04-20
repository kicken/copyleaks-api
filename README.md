# Copyleaks API v3 Implementation

This is a simple [Copyleaks API version 3](https://api.copyleaks.com/documentation/v3) implementation. 

## Install

The easiest way to install this is to use composer.

    composer require kicken/copyleaks-api

## Usage

First create a new instance of the **CopyleaksAPI** class.  Then you can use the *account()*, *education()*, *business()*, and *download()* methods to access the api endpoints.  To authenticate with the API either pass a pre-existing authorization token to the constructor or call the `account()->login()` method to grab a new token.

Here are quick examples to help you get going.  Read the library source for more details about features and how to use the library.

**Submit a document for scanning using a URL.**

    $client = new CopyleaksAPI();
    //Enable logging using PSR1 logger if desired
    //$client->setLogger($client)

    //Get authorizatioon token (login)
    $response = $client->account()->login($accountEmail, $apikey);
    $client->setAuthorization($response->accessToken);

    //Setup callback URLs
    $scanId = mt_rand();
    $documentUrl = 'https://example.com/webhook/download?scan='.$scanId;
    $statusUrl = 'https://example.com/webhook/status?scan='.$scanId.'&status={STATUS}';

    //Submit scan request
    $parameters = new SubmitUrlParameters($paperUrl, $scanId, $completeUrl);
    $education->submitURL($parameters);

**Export results when complete**

    //Complete webhook receives json post data.
    $scanId = $_GET['scan'];
    $scanData = json_decode(file_get_input('php://input'));
    $scanData = \Kicken\Copyleaks\Model\Webhook\Completed::createFromJsonObject($scanData);

    $exportId = date('YmdHis');
    $exportCompleteUrl = 'https://example.com/webhook/export?scan='.$scanId.'&export='.$exportId;

    $exportParameters = new \Kicken\Copyleaks\Model\Download\ExportParameters($scanId, $exportId, $exportCompleteUrl);
    //Request a copy of the document's text as seen by Copyleaks
    $callbackUrl = 'https://example.com/webhook/export/crawled?scan='.$scanId;
    $exportParameters->crawledVersion($callbackUrl);

    //Request details for each match.
    foreach ($scanData->results->internet as $item){
        $callbackUrl = 'https://example.com/webhook/export/result?scan='.$scanId.'&result='.$item->id;
        $exportParameters->result($item->id, $callbackUrl);
    }

    $authorization = loadSavedAuthorizationToken();
    $client = new CopyleaksAPI($authorization);
    $client->download()->export($exportParameters);


## Known issues
I've only implemented the API endpoints that are necessary for my use case so far.

There is currently no automated testing for this library.
