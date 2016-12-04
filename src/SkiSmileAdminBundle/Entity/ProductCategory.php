<?php

namespace SkiSmileAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SkiSmileAdminBundle\Entity\Traits\TimestampableTrait;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use SkiSmileAdminBundle\Entity\Translation\ProductCategoryTranslation;

/**
 * ProductCategory
 *
 * @ORM\Table(name="product_category")
 * @ORM\Entity(repositoryClass="SkiSmileAdminBundle\Repository\ProductCategoryRepository")
 * @Gedmo\TranslationEntity(class="SkiSmileAdminBundle\Entity\Translation\ProductCategoryTranslation")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductCategory
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    private $products;

    /**
     * @ORM\OneToMany(
     * targetEntity="SkiSmileAdminBundle\Entity\Translation\ProductCategoryTranslation",
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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return ProductCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add product
     *
     * @param \SkiSmileAdminBundle\Entity\Product $product
     *
     * @return ProductCategory
     */
    public function addProduct(\SkiSmileAdminBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \SkiSmileAdminBundle\Entity\Product $product
     */
    public function removeProduct(\SkiSmileAdminBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

//    public function getLocale()
//    {
//        return $this->locale;
//    }
//
//    public function setLocale($locale)
//    {
//        $this->locale = $locale;
//    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function addTranslation(ProductCategoryTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
//        $this->translations->add($t);
//        $t->setObject($this);
    }

    public function removeTranslation(ProductCategoryTranslation $t)
    {
        $this->translations->removeElement($t);
    }

//    public function setTranslations($translations)
//    {
//        $this->translations = $translations;
//    }


    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
