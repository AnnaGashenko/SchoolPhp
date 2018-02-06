<?php

/** @Entity */
class Book
{
    /** @Id @GeneratedValue @Column(type="integer") */
    public $id;

    /**
     * Unidirectional - Many users have marked many comments as read
     *
     * @ManyToMany(targetEntity="Author",inversedBy="bookAuthor",cascade={"persist", "remove"})
     * @JoinTable(name="book2author")
     */
    public $authorRead;

    /** @Column(type="datetime", name="date",options={"default": 0}) */
    public $date;

    /** @Column(type="string", name="name") */
    public $name = ''; // По умолчанию пусто

    public function __construct()
    {
        $this->date = new DateTime('now');
        $this->authorRead = new \Doctrine\Common\Collections\ArrayCollection;
    }

}

/** @Entity */
class Author
{
    /** @Id @GeneratedValue @Column(type="integer") */
    public $id;

    /** @Column(type="string", name="name") */
    public $name = 'default value';

    /**
     * Bidirectional - Many comments are favorited by many users (INVERSE SIDE)
     *
     * @ManyToMany(targetEntity="Book", mappedBy="authorRead")
     */
    public $bookAuthor;

    public function __construct()
    {
        $this->bookAuthor = new \Doctrine\Common\Collections\ArrayCollection;
    }
}