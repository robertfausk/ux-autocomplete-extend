<?php
declare(strict_types=1);

namespace App\Autocompleter;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Security\Core\Security;
use Symfony\UX\Autocomplete\EntityAutocompleterInterface;

#[AutoconfigureTag('ux.entity_autocompleter', ['alias' => 'post'])]
class PostAutocompleter implements EntityAutocompleterInterface
{
    public function __construct(
        private readonly PostRepository $postRepository
    )
    {
    }

    public function getEntityClass(): string
    {
        return Post::class;
    }

    public function createFilteredQueryBuilder(EntityRepository $repository, string $query): QueryBuilder
    {
        return $this->postRepository->getPostBySearchQueryBuilder($query);
    }

    public function getLabel(object $entity): string
    {
        \assert($entity instanceof Post);

        return $entity->getTitle();
    }

    public function getValue(object $entity): string
    {
        \assert($entity instanceof Post);

        return (string) $entity->getId();
    }

    public function isGranted(Security $security): bool
    {
        // TODO: Implement isGranted() method.
    }
}
