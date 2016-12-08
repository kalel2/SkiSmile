<?php

namespace SkiSmileAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SkiSmileAdminBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use SkiSmileAdminBundle\Entity\Translation\AboutTranslation;

/**
 * About
 *
 * @ORM\Table(name="about")
 * @ORM\Entity(repositoryClass="SkiSmileAdminBundle\Repository\AboutRepository")
 * @Gedmo\TranslationEntity(class="SkiSmileAdminBundle\Entity\Translation\AboutTranslation")
 * @ORM\HasLifecycleCallbacks()
 */
class About
{
    use TimestampableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="rent", type="text", nullable=true)
     */
    private $rent;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="text", nullable=true)
     */
    private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="selling", type="text", nullable=true)
     */
    private $selling;

    /**
     * @ORM\OneToMany(
     * targetEntity="SkiSmileAdminBundle\Entity\Translation\AboutTranslation",
     * mappedBy="object",
     * cascade={"persist", "remove"}
     * )
     */
    private $translations;

    /**
     * Required for Translatable behaviour
     * @Gedmo\Locale
     */
    protected $locale;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        $this->translations = new ArrayCollection;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setUpdateValue()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rent
     *
     * @param string $rent
     *
     * @return About
     */
    public function setRent($rent)
    {
        $this->rent = $rent;

        return $this;
    }

    /**
     * Get rent
     *
     * @return string
     */
    public function getRent()
    {
        return $this->rent;
    }

    /**
     * Set service
     *
     * @param string $service
     *
     * @return About
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set selling
     *
     * @param string $selling
     *
     * @return About
     */
    public function setSelling($selling)
    {
        $this->selling = $selling;

        return $this;
    }

    /**
     * Get selling
     *
     * @return string
     */
    public function getSelling()
    {
        return $this->selling;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function addTranslation(AboutTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
    }

    public function removeTranslation(AboutTranslation $t)
    {
        $this->translations->removeElement($t);
    }



    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}

