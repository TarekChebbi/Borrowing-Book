<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\BookSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BookSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'title',
                'label' => 'Book',
            ])
            ->add('month', ChoiceType::class, [
                'label' => 'Month',
                'choices' => [
                    'January' => 'January',
                    'February' => 'February',
                    'march' => 'march',
                    'april' => 'april',
                    'june' => 'june',
                    'july' => 'july',
                    'August' => 'August',
                    'september' => 'september',
                    'october' => 'october',
                    'november' => 'november',
                    'december' => 'december',
                   
                    // Add other months as needed
                ],
                'required' => false,
                'placeholder' => 'Select a month',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSearch::class,
        ]);
    }
}
