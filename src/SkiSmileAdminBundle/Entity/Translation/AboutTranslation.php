<?php

namespace SkiSmileAdminBundle\Entity\Translation;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;
/**
 * @ORM\Entity
 * @ORM\Table(name="AboutTranslation",
 *    uniqueConstraints={@ORM\UniqueConstraint(name="career_translation_index", columns={
 *        "locale", "about", "field"
 *     })}
 * )
 */
class AboutTranslation extends AbstractPersonalTranslation {

    /**
     * @ORM\ManyToOne(targetEntity="SkiSmileAdminBundle\Entity\About", inversedBy="translations")
     * @ORM\JoinColumn(name="about", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $object;

    /**
     * CategoryTranslation constructor.
     *
     * @param null $locale
     * @param null $field
     * @param null $content
     */
    public function __construct($locale = null, $field = null, $content = null) {
        $this->setLocale($locale);
        $this->setField($field);
        $this->setContent($content);
    }

    public function __toString() {
        return (string) $this->getId();
    }

}
