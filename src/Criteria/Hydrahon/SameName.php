<?php declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Criteria\Hydrahon;

use ClanCats\Hydrahon\Query\Sql\SelectBase;
use Yahiru\CriteriaExperiment\Criteria\CriteriaInterFace;

final class SameName implements CriteriaInterFace
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __invoke($query): SelectBase
    {
        /** @var SelectBase $query */
        return $query->where('name', '=', $this->name);
    }
}
