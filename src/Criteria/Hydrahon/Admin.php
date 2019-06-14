<?php declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Criteria\Hydrahon;

use ClanCats\Hydrahon\Query\Sql\SelectBase;
use Yahiru\CriteriaExperiment\Criteria\CriteriaInterFace;
use Yahiru\CriteriaExperiment\Model\Authority;

final class Admin implements CriteriaInterFace
{
    public function __invoke($query): \Closure
    {
        return function (SelectBase $query) {
            $query->where('auth', '=', Authority::ADMIN);
        };
    }
}
