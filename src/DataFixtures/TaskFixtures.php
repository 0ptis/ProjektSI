<?php

/**
 * Task fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Lista;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

/**
 * Class TaskFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class TaskFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        if (!$this->manager instanceof ObjectManager || !$this->faker instanceof Generator) {
            return;
        }

        $this->createMany(100, 'task', function (int $i) {
            $task = new Task();
            $task->setTitle($this->faker->sentence);
            $task->setComment($this->faker->text);
            $task->setCreatedAt(
                \DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );
            $task->setUpdatedAt(
                \DateTimeImmutable::createFromMutable(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
                )
            );
            $category = $this->getRandomReference('category', Category::class);
            $task->setCategory($category);

            $lista = $this->getRandomReference('lista', Lista::class);
            $task->setLista($lista);

            $author = $this->getRandomReference('admin', User::class);
            $task->setAuthor($author);

            return $task;
        });
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[] of dependencies
     *
     * @psalm-return array{0: CategoryFixtures::class}
     */
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            ListaFixtures::class,
            UserFixtures::class,
        ];
    }
}
