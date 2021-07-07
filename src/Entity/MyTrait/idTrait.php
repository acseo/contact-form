<?php


namespace App\Entity\MyTrait;


use Doctrine\ORM\Mapping as ORM;

trait idTrait
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }




}