<?php

namespace SkiSmileAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SkiSmileAdminBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use SkiSmileAdminBundle\Entity\Translation\SkiServiceTranslation;

/**
 * SkiService
 *
 * @ORM\Table(name="ski_service")
 * @ORM\Entity(repositoryClass="SkiSmileAdminBundle\Repository\SkiServiceRepository")
 * @Gedmo\TranslationEntity(class="SkiSmileAdminBundle\Entity\Translation\SkiServiceTranslation")
 * @ORM\HasLifecycleCallbacks()
 */
class SkiService
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
     * @Gedmo\Translatable
     * @ORM\Column(name="service", type="string", length=255, nullable=true)
     */
    private $service;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="string", nullable=true)
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="retail", type="boolean", nullable=true)
     */
    private $retail;

    /**
     * @ORM\OneToMany(
     * targetEntity="SkiSmileAdminBundle\Entity\Translation\SkiServiceTranslation",
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
     * Set service
     *
     * @param string $service
     *
     * @return SkiService
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
     * Set price
     *
     * @param string $price
     *
     * @return SkiService
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set retail
     *
     * @param boolean $retail
     */
    public function setRetail($retail)
    {
        $this->retail = $retail;
    }

    /**
     * Get retail
     *
     * @return boolean
     */
    public function getRetail()
    {
        return $this->retail;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function addTranslation(SkiServiceTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
    }

    public function removeTranslation(SkiServiceTranslation $t)
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

