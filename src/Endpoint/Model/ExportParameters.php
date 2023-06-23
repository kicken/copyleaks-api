<?php


namespace Kicken\Copyleaks\Endpoint\Model;


use Kicken\Copyleaks\Endpoint\Model\Internal\CrawledVersion;
use Kicken\Copyleaks\Endpoint\Model\Internal\PdfReport;

class ExportParameters {
    public string $scanId;
    public string $exportId;
    public string $completionWebhook;
    /** @var string[] */
    public ?array $completionWebhookHeaders = null;
    public ?int $maxRetries = null;
    public ?string $developerPayload = null;
    public ?array $results = null;
    public ?PdfReport $pdfReport;
    public ?CrawledVersion $crawledVersion;

    public function __construct(string $scanId, string $exportId, string $completionHook, array $extraProperties = []){
        $this->scanId = $scanId;
        $this->exportId = $exportId;
        $this->completionWebhook = $completionHook;
        $this->pdfReport = new PdfReport();
        $this->crawledVersion = new CrawledVersion();
    }

    public function addResult(ResultParameters $result){
        $this->results[] = $result;
    }
}
