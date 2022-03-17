<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Assert\notBlank()]

    private $invoice_date;

    #[ORM\Column(type: 'integer')]
    #[Assert\notBlank()]

    private $invoice_number;

    #[ORM\Column(type: 'integer')]
    #[Assert\notBlank()]

    private $customer_id;

    #[ORM\OneToOne(mappedBy: 'invoice_id', targetEntity: InvoiceLines::class, cascade: ['persist', 'remove'])]
    #[Assert\notBlank()]

    private $invoiceLines;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoice_date;
    }

    public function setInvoiceDate(\DateTimeInterface $invoice_date): self
    {
        $this->invoice_date = $invoice_date;

        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoice_number;
    }

    public function setInvoiceNumber(?int $invoice_number): self
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(?int $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    public function getInvoiceLines(): ?InvoiceLines
    {
        return $this->invoiceLines;
    }

    public function setInvoiceLines(InvoiceLines $invoiceLines): self
    {
        // set the owning side of the relation if necessary
        if ($invoiceLines->getInvoiceId() !== $this) {
            $invoiceLines->setInvoiceId($this);
        }

        $this->invoiceLines = $invoiceLines;

        return $this;
    }
}
