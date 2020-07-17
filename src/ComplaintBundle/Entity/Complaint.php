<?php

namespace ComplaintBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity
 *
 */

class Complaint
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="date", type="string")
     */
    private $date;

    /**
     *@JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     *@JMS\Serializer\Annotation\Type("string")
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="iduser",referencedColumnName="id")
     */
    private  $Iduser;

    /**
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="idType",referencedColumnName="id")
     */
    private  $Idtype;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set date
     *
     * @param mixed $date
     *
     * @return mixed
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Complaint
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
     * Set image
     *
     * @param string $image
     *
     * @return Complaint
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->Iduser;
    }

    /**
     * @param mixed $Iduser
     */
    public function setIduser($Iduser)
    {
        $this->Iduser = $Iduser;
    }

    /**
     * @return mixed
     */
    public function getIdtype()
    {
        return $this->Idtype;
    }

    /**
     * @param mixed $Idtype
     */
    public function setIdtype($Idtype)
    {
        $this->Idtype = $Idtype;
    }


}

