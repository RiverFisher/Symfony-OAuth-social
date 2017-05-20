<?php

namespace Management\AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @UniqueEntity("email")
 *
 * @ORM\Table(name="system_user")
 * @ORM\Entity(repositoryClass="Management\AdminBundle\Repository\UserRepository")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="username",
 *          column=@ORM\Column(
 *              name     = "username",
 *              type     = "string",
 *              length   = 128,
 *              nullable = true
 *          )
 *      ),
 *      @ORM\AttributeOverride(name="usernameCanonical",
 *          column=@ORM\Column(
 *              name     = "username_canonical",
 *              type     = "string",
 *              length   = 128,
 *              nullable = true,
 *              unique   = false
 *          )
 *      )
 * })
 */
class User extends BaseUser {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="vkontakte_id", type="integer", nullable=true, options={"unsigned":true})
     */
    protected $vkontakte_id;

    /**
     * @var int
     *
     * @ORM\Column(name="odnoklassniki_id", type="bigint", nullable=true, options={"unsigned":true})
     */
    protected $odnoklassniki_id;

    /**
     * @var int
     *
     * @ORM\Column(name="vkontakte_access_token", type="string", length=255, nullable=true)
     */
    protected $vkontakte_access_token;

    /**
     * @var int
     *
     * @ORM\Column(name="odnoklassniki_access_token", type="string", length=255, nullable=true)
     */
    protected $odnoklassniki_access_token;

    /**
     * User constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @var string
     * 
     * @ORM\Column(type="string", name="username", length=128, nullable=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="username_canonical", length=128, nullable=true, unique=false)
     */
    protected $usernameCanonical;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=64, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=64, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=8, nullable=true)
     */
    private $sex;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfBirth", type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=16, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="aWeekdaysFrom", type="smallint", nullable=true, options={"unsigned":true})
     */
    private $aWeekdaysFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="aWeekdaysTo", type="smallint", nullable=true, options={"unsigned":true})
     */
    private $aWeekdaysTo;

    /**
     * @var int
     *
     * @ORM\Column(name="aWeekendFrom", type="smallint", nullable=true, options={"unsigned":true})
     */
    private $aWeekendFrom;

    /**
     * @var int
     *
     * @ORM\Column(name="aWeekendTo", type="smallint", nullable=true, options={"unsigned":true})
     */
    private $aWeekendTo;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="smallint", nullable=true, options={"unsigned":true})
     */
    private $points;

    /**
     * @var string
     *
     * @ORM\Column(name="percentageRatio", type="string", length=11, nullable=true)
     */
    private $percentageRatio;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfGames", type="smallint", nullable=true, options={"unsigned":true})
     */
    private $numberOfGames;

    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="smallint", nullable=true, options={"unsigned":true})
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="tennisClub", type="string", length=128, nullable=true)
     */
    private $tennisClub;

    /**
     * @var string
     *
     * @ORM\Column(name="briefInfo", type="string", length=512, nullable=true)
     */
    private $briefInfo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfCreation", type="datetime", nullable=true)
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfChange", type="datetime", nullable=true)
     */
    private $dateOfChange;

    /**
     * Many Users live in One City
     *
     * @ORM\ManyToOne(targetEntity="Geo\LocationBundle\Entity\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * Many Users have only One SkillLevel
     *
     * @ORM\ManyToOne(targetEntity="SocialNetwork\TournamentsBundle\Entity\SkillLevel")
     * @ORM\JoinColumn(name="skill_level_id", referencedColumnName="id")
     */
    private $skillLevel;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return User
     */
    public function setSex($sex) {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex() {
        return $this->sex;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return User
     */
    public function setPoints($points) {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     * Set percentageRatio
     *
     * @param string $percentageRatio
     *
     * @return User
     */
    public function setPercentageRatio($percentageRatio) {
        $this->percentageRatio = $percentageRatio;

        return $this;
    }

    /**
     * Get percentageRatio
     *
     * @return string
     */
    public function getPercentageRatio() {
        return $this->percentageRatio;
    }

    /**
     * Set numberOfGames
     *
     * @param integer $numberOfGames
     *
     * @return User
     */
    public function setNumberOfGames($numberOfGames) {
        $this->numberOfGames = $numberOfGames;

        return $this;
    }

    /**
     * Get numberOfGames
     *
     * @return int
     */
    public function getNumberOfGames() {
        return $this->numberOfGames;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     *
     * @return User
     */
    public function setExperience($experience) {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return int
     */
    public function getExperience() {
        return $this->experience;
    }

    /**
     * Set tennisClub
     *
     * @param string $tennisClub
     *
     * @return User
     */
    public function setTennisClub($tennisClub) {
        $this->tennisClub = $tennisClub;

        return $this;
    }

    /**
     * Get tennisClub
     *
     * @return string
     */
    public function getTennisClub() {
        return $this->tennisClub;
    }

    /**
     * Set briefInfo
     *
     * @param string $briefInfo
     *
     * @return User
     */
    public function setBriefInfo($briefInfo) {
        $this->briefInfo = $briefInfo;

        return $this;
    }

    /**
     * Get briefInfo
     *
     * @return string
     */
    public function getBriefInfo() {
        return $this->briefInfo;
    }

    /**
     * Set dateOfCreation
     *
     * @param \DateTime $dateOfCreation
     *
     * @return User
     */
    public function setDateOfCreation($dateOfCreation) {
        $this->dateOfCreation = $dateOfCreation;

        return $this;
    }

    /**
     * Get dateOfCreation
     *
     * @return \DateTime
     */
    public function getDateOfCreation() {
        return $this->dateOfCreation;
    }

    /**
     * Set dateOfChange
     *
     * @param \DateTime $dateOfChange
     *
     * @return User
     */
    public function setDateOfChange($dateOfChange) {
        $this->dateOfChange = $dateOfChange;

        return $this;
    }

    /**
     * Get dateOfChange
     *
     * @return \DateTime
     */
    public function getDateOfChange() {
        return $this->dateOfChange;
    }

    /**
     * Set vkontakteId
     *
     * @param integer $vkontakteId
     *
     * @return User
     */
    public function setVkontakteId($vkontakteId) {
        $this->vkontakte_id = $vkontakteId;

        return $this;
    }

    /**
     * Get vkontakteId
     *
     * @return integer
     */
    public function getVkontakteId() {
        return $this->vkontakte_id;
    }

    /**
     * Set vkontakteAccessToken
     *
     * @param string $vkontakteAccessToken
     *
     * @return User
     */
    public function setVkontakteAccessToken($vkontakteAccessToken) {
        $this->vkontakte_access_token = $vkontakteAccessToken;

        return $this;
    }

    /**
     * Get vkontakteAccessToken
     *
     * @return string
     */
    public function getVkontakteAccessToken() {
        return $this->vkontakte_access_token;
    }

    /**
     * Set odnoklassnikiId
     *
     * @param integer $odnoklassnikiId
     *
     * @return User
     */
    public function setOdnoklassnikiId($odnoklassnikiId) {
        $this->odnoklassniki_id = $odnoklassnikiId;

        return $this;
    }

    /**
     * Get odnoklassnikiId
     *
     * @return int
     */
    public function getOdnoklassnikiId() {
        return $this->odnoklassniki_id;
    }

    /**
     * Set odnoklassnikiAccessToken
     *
     * @param string $odnoklassnikiAccessToken
     *
     * @return User
     */
    public function setOdnoklassnikiAccessToken($odnoklassnikiAccessToken) {
        $this->odnoklassniki_access_token = $odnoklassnikiAccessToken;

        return $this;
    }

    /**
     * Get odnoklassnikiAccessToken
     *
     * @return string
     */
    public function getOdnoklassnikiAccessToken() {
        return $this->odnoklassniki_access_token;
    }

    /**
     * Set aWeekdaysFrom
     *
     * @param integer $aWeekdaysFrom
     *
     * @return User
     */
    public function setAWeekdaysFrom($aWeekdaysFrom) {
        $this->aWeekdaysFrom = $aWeekdaysFrom;

        return $this;
    }

    /**
     * Get aWeekdaysFrom
     *
     * @return integer
     */
    public function getAWeekdaysFrom() {
        return $this->aWeekdaysFrom;
    }

    /**
     * Set aWeekdaysTo
     *
     * @param integer $aWeekdaysTo
     *
     * @return User
     */
    public function setAWeekdaysTo($aWeekdaysTo) {
        $this->aWeekdaysTo = $aWeekdaysTo;

        return $this;
    }

    /**
     * Get aWeekdaysTo
     *
     * @return integer
     */
    public function getAWeekdaysTo() {
        return $this->aWeekdaysTo;
    }

    /**
     * Set aWeekendFrom
     *
     * @param integer $aWeekendFrom
     *
     * @return User
     */
    public function setAWeekendFrom($aWeekendFrom) {
        $this->aWeekendFrom = $aWeekendFrom;

        return $this;
    }

    /**
     * Get aWeekendFrom
     *
     * @return integer
     */
    public function getAWeekendFrom() {
        return $this->aWeekendFrom;
    }

    /**
     * Set aWeekendTo
     *
     * @param integer $aWeekendTo
     *
     * @return User
     */
    public function setAWeekendTo($aWeekendTo) {
        $this->aWeekendTo = $aWeekendTo;

        return $this;
    }

    /**
     * Get aWeekendTo
     *
     * @return integer
     */
    public function getAWeekendTo() {
        return $this->aWeekendTo;
    }

    /**
     * Set city
     *
     * @param \Geo\LocationBundle\Entity\City $city
     *
     * @return User
     */
    public function setCity(\Geo\LocationBundle\Entity\City $city = null) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Geo\LocationBundle\Entity\City
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set skillLevel
     *
     * @param \SocialNetwork\TournamentsBundle\Entity\SkillLevel $skillLevel
     *
     * @return User
     */
    public function setSkillLevel(\SocialNetwork\TournamentsBundle\Entity\SkillLevel $skillLevel = null) {
        $this->skillLevel = $skillLevel;

        return $this;
    }

    /**
     * Get skillLevel
     *
     * @return \SocialNetwork\TournamentsBundle\Entity\SkillLevel
     */
    public function getSkillLevel() {
        return $this->skillLevel;
    }
}
