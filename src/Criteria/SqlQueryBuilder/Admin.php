<?php declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Criteria\SqlQueryBuilder;

use NilPortugues\Sql\QueryBuilder\Syntax\Where;
use Yahiru\CriteriaExperiment\Criteria\CriteriaInterFace;
use Yahiru\CriteriaExperiment\Model\Authority;

final class Admin implements CriteriaInterFace
{
    public function __invoke($query): Where
    {
        /** @var Where $query */
        return $query->equals('auth', Authority::ADMIN);
    }
}
