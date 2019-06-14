<?php
declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Repository;

use ClanCats\Hydrahon\Builder;
use ClanCats\Hydrahon\Query\Sql;
use ClanCats\Hydrahon\Query\Sql\Select;
use PDO;
use Yahiru\CriteriaExperiment\Criteria\CriteriaInterFace;
use Yahiru\CriteriaExperiment\Model\Authority;
use Yahiru\CriteriaExperiment\Model\User;

final class HydrahonUserRepository
{
    private $table = 'users';
    /** @var Builder */
    private $builder;
    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo = $pdo;

        $this->builder = new Builder('mysql', function($query, $queryString, $queryParameters) {
            $statement = $this->pdo->prepare($queryString);
            $statement->execute($queryParameters);

            return $statement;
        });
    }

    /**
     * @param CriteriaInterFace $criteria
     *
     * @return User[]
     */
    public function findAllBy(CriteriaInterFace $criteria): array
    {
        $stmt = $this->select()->where($criteria)->execute();

        foreach ($stmt as $record) {

            $users[] = new User(
                (int) $record['id'],
                $record['name'],
                new Authority((int) $record['auth'])
            );
        }

        return $users ?? [];
    }

    private function select(array $columns = ['*']): Select
    {
        return $this->newQuery()->select($columns);
    }

    private function insert(User $user)
    {
        $values = [
            'name' => $user->getName(),
            'auth' => $user->getAuth(),
        ];
        return $this->newQuery()->insert($values);
    }

    private function newQuery(): Sql\Table
    {
        return $this->builder->queryBuilder->table($this->table);
    }
}
