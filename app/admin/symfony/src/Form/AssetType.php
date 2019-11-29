<?php
namespace Admin\Form;

use PSUploaderBundle\Form\AssetType as BaseAssetType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends BaseAssetType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        //Populate the asset with the entity it is associated to
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($options) {
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
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\Entity\Asset',
            'entity' => null
        ));
    }
}
