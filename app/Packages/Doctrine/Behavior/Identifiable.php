<?php

namespace App\Packages\Doctrine\Behavior;

use Doctrine\ORM\Mapping as ORM;

trait Identifiable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected string $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
