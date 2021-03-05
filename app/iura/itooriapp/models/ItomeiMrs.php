<?php

class ItomeiMrs extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $糸種;

    /**
     *
     * @var string
     * @Column(type="string", length=5, nullable=true)
     */
    public $糸コード;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    public $糸名１;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    public $糸名２;

    /**
     *
     * @var string
     * @Column(type="string", length=36, nullable=true)
     */
    public $糸名３;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    public $更新区分;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $更新日付;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("itomei_mrs");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ItomeiMrs[]|ItomeiMrs|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ItomeiMrs|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'itomei_mrs';
    }

}
