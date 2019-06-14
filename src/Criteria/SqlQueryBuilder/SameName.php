<?php declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Criteria\SqlQueryBuilder;

use NilPortugues\Sql\QueryBuilder\Syntax\Where;
use Yahiru\CriteriaExperiment\Criteria\CriteriaInterFace;
use Yahiru\CriteriaExperiment\Model\Authority;

final class SameName implements CriteriaInterFace
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __invoke($query): Where
    {
        /** @var Where $query */
        return $query->equals('name', $this->name);
    }
}
