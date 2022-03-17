<?php

namespace App\Form;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('invoice_date', DateType::class, ['required' => false])
            ->add('invoice_number', IntegerType::class, ['required' => false])
            ->add('customer_id', IntegerType::class, ['required' => false])
            ->add('invoiceLines', InvoiceLinesType::class, ['label' => 'Lines of Invoice'])
            ->add('save', SubmitType::class, ['label' => 'Create Invoice']);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
