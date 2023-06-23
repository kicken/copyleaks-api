<?php


namespace Kicken\Copyleaks\Endpoint\Model\Internal;


use Kicken\Copyleaks\Model\SerializerExclusions;

abstract class SubmitParameters implements SerializerExclusions {
    public string $scanId;
    public Properties $properties;

    protected function __construct(string $scanId, string $statusHook, ?Properties $extraProperties = null){
        if ($statusHook && strpos($statusHook, '{STATUS}') === false){
            throw new \InvalidArgumentException('Status webhook url should contain `{STATUS}` placeholder');
        }

        $this->scanId = $scanId;
        $this->properties = $extraProperties ?? new Properties();
        $this->properties->webhooks->status = $statusHook;
    }

    public function getExcludedPropertyNames() : array{
        return ['scanId'];
    }
}
