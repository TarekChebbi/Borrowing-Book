<?php

namespace App\Form;

use App\Entity\Student;
use App\Entity\StudentSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class StudentSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('student', EntityType::class, [
            'class' => Student::class,
            'choice_label' => 'Name',
            'label' => 'Student',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudentSearch::class,
        ]);
    }
}
