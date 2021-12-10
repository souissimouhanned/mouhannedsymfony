<?php

namespace App\Form;

use App\Entity\Accident;
use App\Entity\Detailaccident;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class AccidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('date_accident')
            ->add('cin_assureur1')
            ->add('cin_assureur2')
            ->add('emplacement')
            ->add('imageFile',FileType::class)
           ->add('Detailaccident',EntityType::class,['class' => Detailaccident::class,
                'choice_label' => 'matricule',
                'label' => 'Detailaccident']) ;

        //>add('CaptchaCode',CaptchaType::class,[
        //'captchaConfig'=>'ExampleCaptchaUserRegistration',
        //'constraints'=>[
          //  new ValidCaptcha([
            //    'message'=>'You should agree to our terms',
            //]),
        //],
    //]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Accident::class,
        ]);
    }

            // ... ///


}
