<?php

namespace SkiSmileAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SkiSmileAdminBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use SkiSmileAdminBundle\Entity\Translation\SkiRentTranslation;

/**
 * SkiRent
 *
 * @ORM\Table(name="ski_rent")
 * @ORM\Entity(repositoryClass="SkiSmileAdminBundle\Repository\SkiRentRepository")
 * @Gedmo\TranslationEntity(class="SkiSmileAdminBundle\Entity\Translation\SkiRentTranslation")
 * @ORM\HasLifecycleCallbacks()
 */
class SkiRent
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
     * @ORM\Column(name="category", type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="inventory", type="string", length=255, nullable=true)
     */
    private $inventory;

    /**
     * @var float
     *
     * @ORM\Column(name="price_one", type="float", nullable=true)
     */
    private $priceOne;

    /**
     * @var float
     *
     * @ORM\Column(name="price_two", type="float", nullable=true)
     */
    private $priceTwo;

    /**
     * @var float
     *
     * @ORM\Column(name="price_three", type="float", nullable=true)
     */
    private $priceThree;

    /**
     * @var float
     *
     * @ORM\Column(name="price_four", type="float", nullable=true)
     */
    private $priceFour;

    /**
     * @var float
     *
     * @ORM\Column(name="price_five", type="float", nullable=true)
     */
    private $priceFive;

    /**
     * @var float
     *
     * @ORM\Column(name="price_six", type="float", nullable=true)
     */
    private $priceSix;

    /**
     * @var float
     *
     * @ORM\Column(name="guarantee", type="float", nullable=true)
     */
    private $guarantee;

    /**
     * @ORM\OneToMany(
     * targetEntity="SkiSmileAdminBundle\Entity\Translation\SkiRentTranslation",
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
     * Set category
     *
     * @param string $category
     *
     * @return SkiRent
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set inventory
     *
     * @param string $inventory
     *
     * @return SkiRent
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;

        return $this;
    }

    /**
     * Get inventory
     *
     * @return string
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * Set priceOne
     *
     * @param float $priceOne
     *
     * @return SkiRent
     */
    public function setPriceOne($priceOne)
    {
        $this->priceOne = $priceOne;

        return $this;
    }

    /**
     * Get priceOne
     *
     * @return float
     */
    public function getPriceOne()
    {
        return $this->priceOne;
    }

    /**
     * Set priceTwo
     *
     * @param float $priceTwo
     *
     * @return SkiRent
     */
    public function setPriceTwo($priceTwo)
    {
        $this->priceTwo = $priceTwo;

        return $this;
    }

    /**
     * Get priceTwo
     *
     * @return float
     */
    public function getPriceTwo()
    {
        return $this->priceTwo;
    }

    /**
     * Set priceThree
     *
     * @param float $priceThree
     *
     * @return SkiRent
     */
    public function setPriceThree($priceThree)
    {
        $this->priceThree = $priceThree;

        return $this;
    }

    /**
     * Get priceThree
     *
     * @return float
     */
    public function getPriceThree()
    {
        return $this->priceThree;
    }

    /**
     * Set priceFour
     *
     * @param float $priceFour
     *
     * @return SkiRent
     */
    public function setPriceFour($priceFour)
    {
        $this->priceFour = $priceFour;

        return $this;
    }

    /**
     * Get priceFour
     *
     * @return float
     */
    public function getPriceFour()
    {
        return $this->priceFour;
    }

    /**
     * Set priceFive
     *
     * @param float $priceFive
     *
     * @return SkiRent
     */
    public function setPriceFive($priceFive)
    {
        $this->priceFive = $priceFive;

        return $this;
    }

    /**
     * Get priceFive
     *
     * @return float
     */
    public function getPriceFive()
    {
        return $this->priceFive;
    }

    /**
     * Set priceSix
     *
     * @param float $priceSix
     *
     * @return SkiRent
     */
    public function setPriceSix($priceSix)
    {
        $this->priceSix = $priceSix;

        return $this;
    }

    /**
     * Get priceSix
     *
     * @return float
     */
    public function getPriceSix()
    {
        return $this->priceSix;
    }

    /**
     * Set guarantee
     *
     * @param float $guarantee
     *
     * @return SkiRent
     */
    public function setGuarantee($guarantee)
    {
        $this->guarantee = $guarantee;

        return $this;
    }

    /**
     * Get guarantee
     *
     * @return float
     */
    public function getGuarantee()
    {
        return $this->guarantee;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function addTranslation(SkiRentTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
    }

    public function removeTranslation(SkiRentTranslation $t)
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

