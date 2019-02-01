<?php
namespace Admin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ImageAssetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', VichImageType::class, [
                'label' => false
            ]);

        //Populate the asset with the entity it is associated to
        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) use ($options) {
            $form = $event->getForm();

            if ($imageAsset = $form->getNormData()) {
                if (! empty($options['entity'])) {
                    $imageAsset->setEntity($options['entity']);
                } elseif ($parentForm = $form->getParent()) {
                    $entity = $parentForm->getNormData();
                    $imageAsset->setEntity($entity);
                }
            }
        });
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();

            if ($imageAsset = $form->getNormData()) {
                if ($parentForm = $form->getParent()) {
                    $entity = $parentForm->getNormData();
                    $imageAsset->setEntity($entity);
                }
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\Entity\Asset',
            'entity' => null
        ));
    }
}
