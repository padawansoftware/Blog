<?php
namespace Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'collection.fields.name'
            ])
            ->add('slug', TextType::class, [
                'attr' => [
                    'pattern' => "^[a-z][a-z\-]*[a-z]$"
                ]
            ])
            ->add('image', ImageAssetType::class, [
                'label' => 'collection.fields.image',
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => 'form.save',
                "attr" => [
                    "class" => "ps"
                ]
            ])
            ->add('save&exit', SubmitType::class, [
                'label' => 'form.save_exit',
                'attr' => [
                    'class' => 'ps',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\Entity\Collection',
        ));
    }
}
