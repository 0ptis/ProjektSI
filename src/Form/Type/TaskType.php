<?php

/**
 * Task type.
 */

namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Lista;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TaskType.
 */
class TaskType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting from the
     * top most type. Type extensions can further modify the form.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array<string, mixed> $options Form options
     *
     * @see FormTypeExtensionInterface::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'label.title',
                'required' => true,
                'attr' => ['max_length' => 255],
            ]
        );
        $builder->add(
            'comment',
            TextType::class,
            [
                'label' => 'label.comment',
                'required' => false,
                'attr' => ['maxlength' => 255],
            ]
        );
        $builder->add(
            'category',
            EntityType::class,
            [
                'class' => Category::class,
                'choice_label' => fn (Category $category): ?string => $category->getTitle(),
                'label' => 'label.category',
                'placeholder' => 'Kategoria',
                'required' => true,
            ]
        );
        $builder->add(
            'lista',
            EntityType::class,
            [
                'class' => Lista::class,
                'choice_label' => fn (Lista $lista): ?string => $lista->getTitle(),
                'label' => 'label.lista',
                'placeholder' => 'Lista',
                'required' => true,
            ]
        );
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Task::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     *
     * @psalm-return 'task'
     */
    public function getBlockPrefix(): string
    {
        return 'task';
    }
}
