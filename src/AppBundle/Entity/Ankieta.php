<?php


namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "AnkietaPrzystanki")
 */

class Ankieta
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type = "string", length = 50)
     */

    private $temat;

    /**
     * @ORM\Column(type = "text")
     */

    private $tresc;
    /**
     * @ORM\Column(type = "integer")
     */
    private $rcp;

    /**
     * @Assert\File(maxSize="1M", mimeTypes={ "application/pdf", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.text", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword", "text/rtf", "application/vnd.oasis.opendocument.spreadsheet" })
     */
    private $plik1;
    /**
     * @Assert\File(maxSize="1M", mimeTypes={ "application/pdf", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.text", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword", "text/rtf", "application/vnd.oasis.opendocument.spreadsheet" })
     */
    private $plik2;
    /**
     * @Assert\File(maxSize="1M", mimeTypes={ "application/pdf", "application/vnd.ms-excel", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.oasis.opendocument.text", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/msword", "text/rtf", "application/vnd.oasis.opendocument.spreadsheet" })
     */
    private $plik3;

    /**
     * @ORM\Column(type = "string", length = 100)
     */

    private $link1;
    /**
     * @ORM\Column(type = "string", length = 100)
     */

    private $link2;
    /**
     * @ORM\Column(type = "string", length = 100)
     */

    private $link3;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set temat
     *
     * @param string $temat
     *
     * @return Ankieta
     */
    public function setTemat($temat)
    {
        $this->temat = $temat;

        return $this;
    }

    /**
     * Get temat
     *
     * @return string
     */
    public function getTemat()
    {
        return $this->temat;
    }

    /**
     * Set tresc
     *
     * @param string $tresc
     *
     * @return Ankieta
     */
    public function setTresc($tresc)
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * Get tresc
     *
     * @return string
     */
    public function getTresc()
    {
        return $this->tresc;
    }

    /**
     * Set rcp
     *
     * @param integer $rcp
     *
     * @return Ankieta
     */
    public function setRcp($rcp)
    {
        $this->rcp = $rcp;

        return $this;
    }

    /**
     * Get rcp
     *
     * @return integer
     */
    public function getRcp()
    {
        return $this->rcp;
    }

    /**
     * Set link1
     *
     * @param string $link1
     *
     * @return Ankieta
     */
    public function setLink1($link1)
    {
        $this->link1 = $link1;

        return $this;
    }

    /**
     * Get link1
     *
     * @return string
     */
    public function getLink1()
    {
        return $this->link1;
    }

    /**
     * Set link2
     *
     * @param string $link2
     *
     * @return Ankieta
     */
    public function setLink2($link2)
    {
        $this->link2 = $link2;

        return $this;
    }

    /**
     * Get link2
     *
     * @return string
     */
    public function getLink2()
    {
        return $this->link2;
    }

    /**
     * Set link3
     *
     * @param string $link3
     *
     * @return Ankieta
     */
    public function setLink3($link3)
    {
        $this->link3 = $link3;

        return $this;
    }

    /**
     * Get link3
     *
     * @return string
     */
    public function getLink3()
    {
        return $this->link3;
    }

    public function getPlik1() {
        return $this->plik1;
    }
    public function setPlik1($plik1) {
        $this->plik1 = $plik1;
        return $this;
    }
    public function getPlik2() {
        return $this->plik2;
    }
    public function setPlik2($plik2) {
        $this->plik2 = $plik2;
        return $this;
    }
    public function getPlik3() {
        return $this->plik3;
    }
    public function setPlik3($plik3) {
        $this->plik3 = $plik3;
        return $this;
    }
}
