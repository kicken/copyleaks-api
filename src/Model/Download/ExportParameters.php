<?php


namespace Kicken\Copyleaks\Model\Download;


class ExportParameters extends Common implements \JsonSerializable {
    /** @var string */
    public $exportId;
    /** @var string */
    public $completionHook;
    /** @var array */
    public $extraProperties;

    public function __construct(string $scanId, string $exportId, string $completionHook, array $extraProperties = []){
        parent::__construct($scanId);
        $this->exportId = $exportId;
        $this->completionHook = $completionHook;
        $this->extraProperties = array_merge([
            'results' => null
            , 'pdfReport' => null
            , 'crawledVersion' => null
        ], $extraProperties);
    }

    public function result(string $id, string $endpoint, string $verb = 'POST', array $extraProperties = []){
        $this->extraProperties['results'][] = array_merge([
            'id' => $id
            , 'endpoint' => $endpoint
            , 'verb' => $verb
        ], $extraProperties);
    }

    public function pdfReport(string $endpoint, string $verb = 'POST', array $extraProperties = []){
        $this->extraProperties['pdfReport'] = array_merge([
            'endpoint' => $endpoint
            , 'verb' => $verb
        ], $extraProperties);
    }

    public function crawledVersion(string $endpoint, string $verb = 'POST', array $extraProperties = []){
        $this->extraProperties['crawledVersion'] = array_merge([
            'endpoint' => $endpoint
            , 'verb' => $verb
        ], $extraProperties);
    }

    public function jsonSerialize(){
        $properties = array_merge([
            'completionWebhook' => $this->completionHook
        ], $this->extraProperties);

        return array_filter($properties, function($v){
            return $v !== null;
        });
    }
}
