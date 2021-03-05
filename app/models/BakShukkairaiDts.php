<?php

class BakShukkairaiDts extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $cd;

    /**
     *
     * @var string
     */
    public $tekiyou;

    /**
     *
     * @var integer
     */
    public $nendo;

    /**
     *
     * @var string
     */
    public $iraibi;

    /**
     *
     * @var integer
     */
    public $irai_kbn_cd;

    /**
     *
     * @var integer
     */
    public $juchuu_dt_id;

    /**
     *
     * @var integer
     */
    public $hacchuu_dt_id;

    /**
     *
     * @var string
     */
    public $souko_mr_cd;

    /**
     *
     * @var string
     */
    public $gotantou;

    /**
     *
     * @var string
     */
    public $hassousaki_kbn_cd;

    /**
     *
     * @var string
     */
    public $hassousaki_mr_cd;

    /**
     *
     * @var string
     */
    public $hassousaki;

    /**
     *
     * @var string
     */
    public $kidukesaki_mr_cd;

    /**
     *
     * @var string
     */
    public $kiduke;

    /**
     *
     * @var string
     */
    public $shukkabi;

    /**
     *
     * @var string
     */
    public $nouki_memo;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $assistant;

    /**
     *
     * @var integer
     */
    public $shounin_joutai_flg;

    /**
     *
     * @var string
     */
    public $shounin_sha_mr_cd;

    /**
     *
     * @var integer
     */
    public $id_moto;

    /**
     *
     * @var integer
     */
    public $hikae_dltflg;

    /**
     *
     * @var integer
     */
    public $hikae_user_id;

    /**
     *
     * @var string
     */
    public $hikae_nichiji;

    /**
     *
     * @var integer
     */
    public $sakusei_user_id;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var integer
     */
    public $kousin_user_id;

    /**
     *
     * @var string
     */
    public $updated;

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakShukkairaiDts[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakShukkairaiDts
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
        return 'bak_shukkairai_dts';
    }

}
