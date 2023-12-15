<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DefinitionRepository;

/**
 * @ORM\Entity(repositoryClass=DefinitionRepository::class)
 * @ORM\Table(name="`definition`")
 */
class Definition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $hash;


    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $platform;


    /**
     * @ORM\Column(type="integer")
     */
    private $majorVersion;
    /**
     * @ORM\Column(type="integer")
     */
    private $minorVersion;
    /**
     * @ORM\Column(type="integer")
     */
    private $patchVersion;

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }
    /**
     * @return mixed
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param mixed $platform
     */
    public function setPlatform($platform): void
    {
        $this->platform = $platform;
    }

    /**
     * @return mixed
     */
    public function getMajorVersion()
    {
        return $this->majorVersion;
    }

    /**
     * @param mixed $majorVersion
     */
    public function setMajorVersion($majorVersion)
    {
        $this->majorVersion = $majorVersion;
    }

    /**
     * @return mixed
     */
    public function getMinorVersion()
    {
        return $this->minorVersion;
    }

    /**
     * @param mixed $minorVersion
     */
    public function setMinorVersion($minorVersion)
    {
        $this->minorVersion = $minorVersion;
    }

    /**
     * @return mixed
     */
    public function getPatchVersion()
    {
        return $this->patchVersion;
    }

    /**
     * @param mixed $patchVersion
     */
    public function setPatchVersion($patchVersion)
    {
        $this->patchVersion = $patchVersion;
    }


}