<?php
namespace Api\V8\Param;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ModuleParams extends BaseParam
{
    private static $allowedPageKeys = ['size', 'number'];

    /**
     * @return string
     */
    public function getModuleName()
    {
        return $this->parameters['moduleName'];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->parameters['id'];
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->parameters['fields'];
    }

    /**
     * @return array
     */
    public function getPage()
    {
        return $this->parameters['page'];
    }
    
    /**
     * @inheritdoc
     */
    protected function configureParameters(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('moduleName')
            ->setAllowedTypes('moduleName', ['string']);

        $resolver
            ->setDefined('id')
            ->setAllowedTypes('id', ['string'])
            ->setAllowedValues('id', $this->validatorFactory->createClosure([
                new Assert\NotBlank(),
                new Assert\Uuid(['strict' => false]),
            ]));

        $resolver
            ->setDefined('fields')
            ->setAllowedTypes('fields', ['array'])
            ->setAllowedValues('fields', $this->validatorFactory->createClosureForIterator([
                new Assert\NotBlank(),
                new Assert\Regex([
                    'pattern' => self::REGEX_FIELDS_PATTERN,
                    'match' => false,
                ]),
            ], true));

        $resolver
            ->setDefined('page')
	    ->setDefault('page', null)
            ->setAllowedTypes('page', ['array', null])
            ->setAllowedValues('page', $this->validatorFactory->createClosureForIterator([
                new Assert\NotBlank(),
                new Assert\Regex([
                    'pattern' => self::REGEX_PAGE_PATTERN,
                ]),
            ], true))
            ->setNormalizer('page', function (Options $options, $pageKeys) {
                $invalidKeys = array_diff_key($pageKeys, array_flip(self::$allowedPageKeys));
                if ($invalidKeys) {
                    throw new \InvalidArgumentException(
                        'Invalid key(s) for page parameter: ' . implode(', ', array_keys($invalidKeys))
                    );
                }

                return $pageKeys;
            });
    }
}
