<?php
declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Criteria;

interface CriteriaInterFace
{
    public function __invoke($query);
}
