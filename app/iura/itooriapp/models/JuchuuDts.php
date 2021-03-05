<?php

class JuchuuDts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $cd;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $nendo;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $tekiyou;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $juchuubi;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $zeiritu_tekiyoubi;

    /**
     *
     * @var string
     * @Column(type="string", length=14, nullable=true)
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $torihiki_kbn_cd;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $zei_tenka_kbn_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $shimekiri_flg;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $nounyuu_kijitu;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $mitumori_dt_id;

    /**
     *
     * @var string
     * @Column(type="string", length=12, nullable=true)
     */
    public $saki_hacchuu_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=4, nullable=true)
     */
    public $nounyuusaki_mr_cd;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=true)
     */
    public $nounyuusaki;

    /**
     *
     * @var string
     * @Column(type="string", length=2, nullable=true)
     */
    public $chokusousaki_kbn_cd;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $id_moto;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $hikae_dltflg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $hikae_user_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $hikae_nichiji;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $sakusei_user_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $kousin_user_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("itooridb");
        $this->setSource("juchuu_dts");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return JuchuuDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return JuchuuDts
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
        return 'juchuu_dts';
    }

}
