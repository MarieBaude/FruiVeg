<?php

namespace App\Entity;

use App\Repository\PurchaseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
class Purchase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    #[ORM\ManyToOne(targetEntity: 'App\Entity\User')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;


    #[ORM\ManyToOne(targetEntity: 'App\Entity\Product')]
    #[ORM\JoinColumn(nullable: false)]
    private $product;


    #[ORM\Column(type: 'datetime')]
    private $purchaseDate;

    
    #[ORM\ManyToOne(targetEntity: 'App\Entity\User')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Product')]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    
    #[ORM\Column(type: 'datetime')]
    private $purchaseDate;


}
