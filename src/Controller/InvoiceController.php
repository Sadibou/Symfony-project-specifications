<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Entity\InvoiceLines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InvoiceController extends AbstractController
{
    #[Route('/invoice', name: 'app_invoice')]


    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invoice = new Invoice();
        $invoice->setInvoiceDate(new \DateTime());

        $invoiceLines = new InvoiceLines();

        $invoice->setInvoiceLines($invoiceLines);

        $form = $this->createForm(InvoiceType::class, $invoice);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $total_with_vat = $invoiceLines->getAmount() + $invoiceLines->getVatAmount();
            $invoiceLines->setTotalWithAmount($total_with_vat);


            $entityManager->persist($invoice);
            $entityManager->flush();

            return $this->redirectToRoute('app_invoice');
        }

        return $this->renderForm('invoice/save.html.twig', [
            'form' => $form,
        ]);
    }
}
