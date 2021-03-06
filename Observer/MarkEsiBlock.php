<?php

namespace Fastly\Cdn\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\ResponseInterface as Response;
use Fastly\Cdn\Model\Config as FastlyConfig;

class MarkEsiBlock implements ObserverInterface
{
    /**
     * @var FastlyConfig
     */
    private $fastlyConfig;

    /**
     * @var Response
     */
    private $response;

    /**
     * MarkEsiPage constructor.
     * @param Response $response
     * @param FastlyConfig $fastlyConfig
     */
    public function __construct(
        Response $response,
        FastlyConfig $fastlyConfig
    ) {
        $this->fastlyConfig = $fastlyConfig;
        $this->response = $response;
    }

    /**
     * Set x-esi header on ESI response request
     * If omitted, causes issues with embedded esi tags
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(Observer $observer) // @codingStandardsIgnoreLine - required, but not needed
    {
        if ($this->fastlyConfig->isFastlyEnabled() != true) {
            return;
        }

        // If not set, causes issues with embedded ESI
        $this->response->setHeader("x-esi", "1");
    }
}
