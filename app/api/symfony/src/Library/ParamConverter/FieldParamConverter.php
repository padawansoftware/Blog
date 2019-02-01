<?php
namespace Api\Library\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FieldParamConverter implements ParamConverterInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }


    /**
     * Checks if the object is supported.
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration)
    {
        return null !== $configuration->getClass() && isset($configuration->getOptions()['fields']);
    }


    /**
     * Stores the object in the request.
     *
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $name = $configuration->getName();
        $class = $configuration->getClass();
        $options = $configuration->getOptions($configuration);

        $criteria = $options['fields'];
        $repository = $this->registry->getRepository($class);

        $value = $request->attributes->get($name);
        foreach ($criteria as $criterium) {
            if ($object = $repository->findOneBy([$criterium => $value])) {
                $request->attributes->set($name, $object);

                return true;
            }
        }

        throw new NotFoundHttpException();
    }
}
