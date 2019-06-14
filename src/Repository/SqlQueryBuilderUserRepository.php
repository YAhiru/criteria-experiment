<?php
declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Repository;

use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use NilPortugues\Sql\QueryBuilder\Manipulation\QueryInterface;
use NilPortugues\Sql\QueryBuilder\Manipulation\Select;
use PDO;
use Yahiru\CriteriaExperiment\Criteria\CriteriaInterFace;
use Yahiru\CriteriaExperiment\Model\Authority;
use Yahiru\CriteriaExperiment\Model\User;

final class SqlQueryBuilderUserRepository
{
    private $table = 'users';
    /** @var GenericBuilder */
    private $builder;
    /** @var PDO */
    private $pdo;

    public function __construct(GenericBuilder $builder, PDO $pdo)
    {
        $this->builder = $builder;

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo = $pdo;
    }

    /**
     * @param CriteriaInterFace $criteria
     *
     * @return User[]
     */
    public function findAllBy(CriteriaInterFace $criteria): array
    {
        $query = $criteria($this->select()->where())->end();

        $stmt = $this->pdo->prepare($this->toSql($query));
        $stmt->execute($this->builder->getValues());

        foreach ($stmt as $record) {

            $users[] = new User(
                (int) $record['id'],
                $record['name'],
                new Authority((int) $record['auth'])
            );
        }

        return $users ?? [];
    }

    private function toSql(QueryInterface $query): string
    {
        return $this->builder->writeFormatted($query);
    }

    private function select(): Select
    {
        return $this->builder->select($this->table);
    }

    private function insert(User $user)
    {
        $values = [
            'name' => $user->getName(),
            'auth' => $user->getAuth(),
        ];
        return $this->builder->insert($this->table, $values);
    }
}
