<?php

namespace TypoScriptBackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="TypoScriptBackendBundle\Repository\TypeRepository")
 * @ORM\Table(uniqueConstraints={
 *  @ORM\UniqueConstraint(name="type_unique", columns={"name", "typo3_group"}),
 *  @ORM\UniqueConstraint(name="url_name_unique", columns={"url_name", "typo3_group"})
 * })
 * 
 */
class Type
{
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * Constant used in $typo3Group field.
	 */
	const NORMAL_GROUP = 1;

	/**
	 * Constant used in $typo3Group field.
	 */
	const PAGE_GROUP = 2;

	/**
	* Constant used in $typo3Group field.
	*/
	const USER_GROUP = 3;

	/**
	 * Default value of property $minVersion. Default value also needs to be specified in property annotations.
	 */
	const MIN_VERSION_DEFAULT = "4.5";

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=255)
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="url_name", type="string", length=255)
	 */
	private $urlName;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="text", nullable=true)
	 */
	private $description;

	/**
	 * @var string The TYPO3 version in which the type was introduced
	 * Example: "4.5" "6.1" "6.2"), NULL is interpreted as most early version.
	 *
	 * @Assert\Range(
	 *      min = 4.5,
	 *      minMessage = "Lowest supported version is {{ limit }}.",
	 * )
	 * @ORM\Column(name="min_version", type="decimal", precision=4, scale=1, options={"default" = "4.5"}, nullable=false)
	 */
	private $minVersion = Type::MIN_VERSION_DEFAULT;

   /**
	* @var string Last TYPO3 version in which the type existed.
	* A version after which the type was deprecated.
	* Example: "4.5" "6.1" "6.2"), NULL is default and is interpreted as latest version.
	*
	* @Assert\Range(
	*      min = 4.5,
	*      minMessage = "Lowest supported version is {{ limit }}.",
	* )
	* @ORM\Column(name="max_version", type="decimal", precision=4, scale=1, nullable=true)
	*/
	private $maxVersion = NULL;

   /**
	* @var integer 3 = USER_GROUP, 2 = PAGE_GROUP, 1 = NORMAL_GROUP
	*
	* @ORM\Column(name="typo3_group", type="smallint", options={"default" = 1})
	*/
	private $typo3Group = Type::NORMAL_GROUP;

  /**
   * Reference to the Type this Type extends.
   *
   * @var Type
   *
   * @ORM\ManyToOne(targetEntity="Type")
   * @ORM\JoinColumn(name="extends_id", referencedColumnName="id", onDelete="CASCADE")
   */
  private $extends;

   /**
	* @var Category
	*
	* @ORM\ManyToOne(targetEntity="Category")
	* @ORM\JoinColumn(name="category", referencedColumnName="id")
	*/
	private $category;

	/**
	 * Properties of the Type
	 *
	 * @var ArrayCollection
	 *
	 * @ORM\OneToMany(targetEntity="Property", mappedBy="parentType")
	 */
	private $children;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="deleted", type="boolean")
	 */
	private $deleted = FALSE;



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
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Type
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
     * Set urlName
     *
     * @param string $urlName
     *
     * @return Type
     */
    public function setUrlName($urlName)
    {
        $this->urlName = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Type
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set minVersion
     *
     * @param string $minVersion
     *
     * @return Type
     */
    public function setMinVersion($minVersion)
    {
        $this->minVersion = $minVersion;

        return $this;
    }

    /**
     * Get minVersion
     *
     * @return string
     */
    public function getMinVersion()
    {
        return $this->minVersion;
    }

    /**
     * Set maxVersion
     *
     * @param string $maxVersion
     *
     * @return Type
     */
    public function setMaxVersion($maxVersion)
    {
        $this->maxVersion = $maxVersion;

        return $this;
    }

    /**
     * Get maxVersion
     *
     * @return string
     */
    public function getMaxVersion()
    {
        return $this->maxVersion;
    }

    /**
     * Set typo3Group
     *
     * @param integer $typo3Group
     *
     * @return Type
     */
    public function setTypo3Group($typo3Group)
    {
        $this->typo3Group = $typo3Group;

        return $this;
    }

    /**
     * Get typo3Group
     *
     * @return integer
     */
    public function getTypo3Group()
    {
        return $this->typo3Group;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Type
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set extends
     *
     * @param \TypoScriptBackendBundle\Entity\Type $extends
     *
     * @return Type
     */
    public function setExtends(\TypoScriptBackendBundle\Entity\Type $extends = null)
    {
        $this->extends = $extends;

        return $this;
    }

    /**
     * Get extends
     *
     * @return \TypoScriptBackendBundle\Entity\Type
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Set category
     *
     * @param \TypoScriptBackendBundle\Entity\Category $category
     *
     * @return Type
     */
    public function setCategory(\TypoScriptBackendBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \TypoScriptBackendBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add child
     *
     * @param \TypoScriptBackendBundle\Entity\Property $child
     *
     * @return Type
     */
    public function addChild(\TypoScriptBackendBundle\Entity\Property $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \TypoScriptBackendBundle\Entity\Property $child
     */
    public function removeChild(\TypoScriptBackendBundle\Entity\Property $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }
}
