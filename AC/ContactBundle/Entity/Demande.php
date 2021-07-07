<?php

namespace AC\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="AC\ContactBundle\Repository\DemandeRepository")
 */
class Demande {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AC\ContactBundle\Entity\Internaute")
     * @ORM\JoinColumn(nullable=false)
     */
    private $internaute;

    /**
     * @var string
     *
     * @ORM\Column(name="demande", type="text")
     */
    private $demande;

    /**
     * @var bool
     *
     * @ORM\Column(name="traite", type="boolean")
     */
    private $traite = false;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set internaute
     *
     * @param string $internaute
     *
     * @return Demande
     */
    public function setInternaute(Internaute $internaute) {
        $this->internaute = $internaute;
        return $this;
    }

    /**
     * Get internaute
     *
     * @return string
     */
    public function getInternaute() {
        return $this->internaute;
    }

    /**
     * Set demande
     *
     * @param string $demande
     *
     * @return Demande
     */
    public function setDemande($demande) {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande
     *
     * @return string
     */
    public function getDemande() {
        return $this->demande;
    }

    /**
     * Set traite
     *
     * @param boolean $traite
     *
     * @return Demande
     */
    public function setTraite($traite) {
        $this->traite = $traite;

        return $this;
    }

    /**
     * Get traite
     *
     * @return bool
     */
    public function getTraite() {
        return $this->traite;
    }

}
