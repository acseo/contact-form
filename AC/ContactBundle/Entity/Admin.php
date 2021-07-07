<?php

namespace AC\ContactBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;


class Admin
{
    private $demande;
    
    public function __construct() {
        $this->demande = new ArrayCollection();
    }
    
    public function getDemande()
    {
        return $this->demande;
    }
}

