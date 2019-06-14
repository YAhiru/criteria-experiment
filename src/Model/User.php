<?php
declare(strict_types=1);
namespace Yahiru\CriteriaExperiment\Model;

final class User
{
    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var Authority */
    private $auth;

    public function __construct(int $id, string $name, Authority $auth)
    {
        $this->id = $id;
        $this->name = $name;
        $this->auth = $auth;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAuth(): Authority
    {
        return $this->auth;
    }
}
