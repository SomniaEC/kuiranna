<?php

namespace AppBundle\Utils\Extensions;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TooltipTypeExtension extends AbstractTypeExtension {
	
	public function getExtendedType() {
		return FormType::class;
	}
	
	public function buildView(FormView $view, FormInterface $form, array $options) {
		if (array_key_exists('tooltip', $options)) {
			$view->vars['tooltip'] = $options['tooltip'];
		}
	}
	
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefined(array('tooltip'));
	}
} 