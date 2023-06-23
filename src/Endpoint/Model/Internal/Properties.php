<?php

namespace Kicken\Copyleaks\Endpoint\Model\Internal;

class Properties {
    public ?int $action = null;
    public ?bool $includeHtml = null;
    public ?string $developerPayload = null;
    public ?bool $sandbox = null;
    public ?int $expiration = null;
    public ?int $scanMethodAlgorithm = null;
    public ?array $customMetadata = null;
    public Author $author;
    public WebHooks $webhooks;
    public Filters $filters;
    public Scanning $scanning;
    public Indexing $indexing;
    public Exclude $exclude;
    public Pdf $pdf;
    public ?int $sensitivityLevel = null;
    public ?bool $cheatDetection = null;
    public AIGeneratedText $aiGeneratedText;
    public SensitiveDataProtection $sensitiveDataProtection;

    public function __construct(){
        $this->author = new Author();
        $this->pdf = new Pdf();
        $this->webhooks = new WebHooks();
        $this->filters = new Filters();
        $this->scanning = new Scanning();
        $this->indexing = new Indexing();
        $this->aiGeneratedText = new AIGeneratedText();
        $this->sensitiveDataProtection = new SensitiveDataProtection();
    }
}
