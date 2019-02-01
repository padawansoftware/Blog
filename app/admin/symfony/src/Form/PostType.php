<?php
namespace Admin\Form;

use Core\Entity\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'post.fields.title'
            ])
            ->add('slug', TextType::class, [
                'attr' => [
                    'pattern' => "^[a-z][a-z\-]*[a-z]$"
                ]
            ])
            ->add('image', ImageAssetType::class, [
                'label' => 'post.fields.image',
                'required' => false
            ])
            ->add('collections', EntityType::class, [
                'label' => 'post.fields.collections',
                'class' => Collection::class,
                'choice_label' => 'name',
                'multiple' => 'true',
                'by_reference' => false,
                'required' => false,
                'attr' => [
                    'data-placeholder' => "Select a collection"
                ]
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'post.fields.enabled',
                'required' => false,
            ])
            ->add('chapters', CollectionType::class, [
                'label' => 'post.fields.chapters',
                'entry_type' => ChapterType::class,
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
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
            'data_class' => 'Core\Entity\Post',
        ));
    }
}
