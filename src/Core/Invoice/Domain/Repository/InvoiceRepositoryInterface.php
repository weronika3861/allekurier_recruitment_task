<?php

namespace App\Core\Invoice\Domain\Repository;

use App\Core\Invoice\Domain\Invoice;
use App\Core\Invoice\Domain\Status\InvoiceStatus;

interface InvoiceRepositoryInterface
{
    /**
     * @return Invoice[]
     */
    public function getInvoicesWithGreaterAmountAndStatus(InvoiceStatus $invoiceStatus, int $amount): array;

    public function save(Invoice $invoice): void;

    public function flush(): void;
}
