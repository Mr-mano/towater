<?php

namespace App\Form;

use App\Entity\Produit;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;



class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('libelle')
            ->add('description')
            ->add('photoFile', VichImageType::class, [
                'label' => 'Photo',
                'required' => false,])
            ->add('prix')
            ->add('categorie')
            ->add('miseEnAvant',CheckboxType::class, [
                "required" => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
