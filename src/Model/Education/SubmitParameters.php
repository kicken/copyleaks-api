<?php


namespace Kicken\Copyleaks\Model\Education;


abstract class SubmitParameters implements \JsonSerializable {
    /** @var string */
    public $scanId;
    /** @var array */
    public $properties;

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
