<?php


namespace Kicken\Copyleaks\Model\Businesses;


abstract class SubmitParameters implements \JsonSerializable {
    public string $scanId;
    public array $properties;

    protected function __construct(string $scanId, string $statusHook, array $extraProperties){
        if ($statusHook && strpos($statusHook, '{STATUS}') === false){
            throw new \InvalidArgumentException('Status webhook url should contain `{STATUS}` placeholder');
        }

        $this->scanId = $scanId;
        $this->properties = array_merge_recursive([
            'webhooks' => [
                'status' => $statusHook
            ]
        ], $extraProperties);
    }
}
