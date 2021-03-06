<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\InvoiceLinesRepository;

#[ORM\Entity(repositoryClass: InvoiceLinesRepository::class)]
class InvoiceLines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'invoiceLines', targetEntity: Invoice::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $invoice_id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\notBlank()]

    private $description;

    #[ORM\Column(type: 'integer')]
    #[Assert\notBlank()]

    private $quantity;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 1)]
    #[Assert\notBlank()]

    private $amount;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 1)]
    #[Assert\notBlank()]
    #[Assert\Length(max: 4)]

    private $vat_amount;

    #[ORM\Column(type: 'decimal', precision: 3, scale: 1)]
    #[Assert\notBlank()]
    #[Assert\Length(max: 4)]
    private $total_with_amount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceId(): ?Invoice
    {
        return $this->invoice_id;
    }

    public function setInvoiceId(Invoice $invoice_id): self
    {
        $this->invoice_id = $invoice_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getVatAmount(): ?string
    {
        return $this->vat_amount;
    }

    public function setVatAmount(?string $vat_amount): self
    {
        $this->vat_amount = $vat_amount;

        return $this;
    }

    public function getTotalWithAmount(): ?string
    {
        return $this->total_with_amount;
    }

    public function setTotalWithAmount(?string $total_with_amount): self
    {
        $this->total_with_amount = $total_with_amount;

        return $this;
    }
}
