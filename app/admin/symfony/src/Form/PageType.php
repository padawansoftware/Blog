<?php
namespace Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('slug', TextType::class, [
                'attr' => [
                    'pattern' => "^[a-z0-9][a-z0-9\-]*[a-z0-9]$"
                ]
            ])
            ->add('content', TextareaType::class, [
                "attr" => [
                    "class" => "wysiwyg"
                ]
            ])
            ->add('enabled', CheckboxType::class, [
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                "attr" => [
                    "class" => "ps"
                ]
            ])
            ->add('save&exit', SubmitType::class, [
                'attr' => [
                    'class' => 'ps',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\Entity\Page',
        ));
    }
}
