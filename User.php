<?php

namespace Management\AdminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 * @UniqueEntity("email")
 */
class User /*extends BaseUser*/ implements AdvancedUserInterface, EquatableInterface {
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\Email(
     *     message = "Введённый адрес '{{ value }}' не действителен",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    protected $plainPassword;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $salt;

    /**
     * @var boolean
     */
    private $isActive;

    /**
     * @var string
     */
    private $vkId;

    /**
     * @var string
     */
    private $okId;

    /**
     * @var string
     */
    private $sex;

    /**
     * @var \DateTime
     */
    private $dateOfBirth;

    /**
     * @var string
     */
    private $phoneNumber1;

    /**
     * @var string
     */
    private $phoneNumber2;

    /**
     * @var string
     */
    private $availability;
//
//    /**
//     * @var string
//     */
//    private $skillLevel;

    /**
     * @var integer
     */
    private $points;

    /**
     * @var string
     */
    private $percentageRatio;

    /**
     * @var integer
     */
    private $numberOfGames;

    /**
     * @var string
     */
    private $briefInfo;

    /**
     * @var \DateTime
     */
    private $dateOfCreation;

    /**
     * @var \DateTime
     */
    private $dateOfChange;

    /**
     * @var \Geo\LocationBundle\Entity\City
     */
    private $city;

    /**
     * @var \SocialNetwork\TournamentsBundle\Entity\SkillLevel
     */
    private $skillLevel;

    /**
     * @var integer
     */
    private $experience;

    /**
     * @var string
     */
    private $tennisClub;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->email = $username;

        return $this;
    }

    /**
     * <!!!> UserInterface method <!!!>
     *
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword() {
        return $this->plainPassword;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * <!!!> UserInterface method <!!!>
     *
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * <!!!> UserInterface method <!!!>
     *
     * Get salt
     *
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Set vkId
     *
     * @param string $vkId
     *
     * @return User
     */
    public function setVkId($vkId) {
        $this->vkId = $vkId;

        return $this;
    }

    /**
     * Get vkId
     *
     * @return string
     */
    public function getVkId() {
        return $this->vkId;
    }

    /**
     * Set okId
     *
     * @param string $okId
     *
     * @return User
     */
    public function setOkId($okId) {
        $this->okId = $okId;

        return $this;
    }

    /**
     * Get okId
     *
     * @return string
     */
    public function getOkId() {
        return $this->okId;
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
     * Set phoneNumber1
     *
     * @param string $phoneNumber1
     *
     * @return User
     */
    public function setPhoneNumber1($phoneNumber1) {
        $this->phoneNumber1 = $phoneNumber1;

        return $this;
    }

    /**
     * Get phoneNumber1
     *
     * @return string
     */
    public function getPhoneNumber1() {
        return $this->phoneNumber1;
    }

    /**
     * Set phoneNumber2
     *
     * @param string $phoneNumber2
     *
     * @return User
     */
    public function setPhoneNumber2($phoneNumber2) {
        $this->phoneNumber2 = $phoneNumber2;

        return $this;
    }

    /**
     * Get phoneNumber2
     *
     * @return string
     */
    public function getPhoneNumber2() {
        return $this->phoneNumber2;
    }

    /**
     * Set availability
     *
     * @param string $availability
     *
     * @return User
     */
    public function setAvailability($availability) {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return string
     */
    public function getAvailability() {
        return $this->availability;
    }

//    /**
//     * Set skillLevel
//     *
//     * @param string $skillLevel
//     *
//     * @return User
//     */
//    public function setSkillLevel($skillLevel) {
//        $this->skillLevel = $skillLevel;
//
//        return $this;
//    }
//
//    /**
//     * Get skillLevel
//     *
//     * @return string
//     */
//    public function getSkillLevel() {
//        return $this->skillLevel;
//    }

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
     * @return integer
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
     * @return integer
     */
    public function getNumberOfGames() {
        return $this->numberOfGames;
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
     *
     */
    public function getRoles() {
//        $this->roles[] = 'ROLE_USER';
//
//        return $this;
//
//        $roles = $this->roles;
//        $roles[] = 'ROLE_USER';
//
//        return array_unique($roles, SORT_REGULAR);
//
//        return $this->roles;

        $roles = array('IS_AUTHENTICATED_ANONYMOUSLY');
        return $roles;
    }

    /**
     * Сброс прав пользователя
     */
    public function eraseCredentials() {
        $this->plainPassword = null;
    }

    /**
     * Check if account is not expired
     *
     * @return bool
     */
    public function isAccountNonExpired() {
        return true;
    }

    /**
     * Check if account is not locked
     *
     * @return bool
     */
    public function isAccountNonLocked() {
        return true;
    }

    /**
     * Check if credentials is not expired
     *
     * @return bool
     */
    public function isCredentialsNonExpired() {
        return true;
    }

    /**
     * Check if account is enabled
     *
     * @return bool
     */
    public function isEnabled() {
        return $this->isActive;
    }

    /**
     * Сравнивает пользователя с другим пользователем и определяет, один и тот же ли это человек
     *
     * Поскольку используется авторизация через E-Mail адрес, то сравнивать пользователей между
     * собой нужно также по их E-Mail адресам
     *
     * @param ExtendedUserInterface $user
     * @return bool
     */
//    public function equals(AdvancedUserInterface $user) {
    public function equals(ExtendedUserInterface $user) {
//        return $user->getUsername() === $this->getUsername();
//        return md5($this->getUsername()) === md5($user->getUsername());
        return md5($this->getEmail()) === md5($user->getEmail());
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName) {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName() {
        return $this->fullName;
    }

    /**
     * Set skillLevel
     *
     * @param \SocialNetwork\TournamentsBundle\Entity\SkillLevel $skillLevel
     *
     * @return User
     */
    public function setSkillLevel(
        \SocialNetwork\TournamentsBundle\Entity\SkillLevel $skillLevel = null) {
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
     * @return integer
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

    public function isEqualTo(UserInterface $user) {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->email !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}