<?php
namespace Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ChapterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'chapter.fields.title'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'chapter.fields.content',
                "attr" => [
                    "class" => "wysiwyg"
                ]
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'chapter.fields.enabled',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\Entity\Chapter',
        ));
    }
}
