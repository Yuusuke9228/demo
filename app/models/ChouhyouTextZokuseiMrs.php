<?php

class ChouhyouTextZokuseiMrs extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     *
     * @var integer
     */
    public $chouhyou_mr_id;

    /**
     *
     * @var integer
     */
    public $shurui_kbn;

    /**
     *
     * @var string
     */
    public $kmk_table;

    /**
     *
     * @var string
     */
    public $sanshou;

    /**
     *
     * @var string
     */
    public $kmk_cd;

    /**
     *
     * @var string
     */
    public $yoko_zahyou;

    /**
     *
     * @var string
     */
    public $tate_zahyou;

    /**
     *
     * @var string
     */
    public $waku_haba;

    /**
     *
     * @var string
     */
    public $waku_taka;

    /**
     *
     * @var string
     */
    public $align;

    /**
     *
     * @var string
     */
    public $valign;

    /**
     *
     * @var integer
     */
    public $stretch;

    /**
     *
     * @var string
     */
    public $calign;

    /**
     *
     * @var integer
     */
    public $font_kbn_id;

    /**
     *
     * @var string
     */
    public $font_style;

    /**
     *
     * @var string
     */
    public $font_size;

    /**
     *
     * @var integer
     */
    public $inji_houkou;

    /**
     *
     * @var string
     */
    public $moji_iro;

    /**
     *
     * @var string
     */
    public $nuri_iro;

    /**
     *
     * @var string
     */
    public $waku_iro;

    /**
     *
     * @var string
     */
    public $waku_huto;

    /**
     *
     * @var string
     */
    public $waku;

    /**
     *
     * @var string
     */
    public $kmk_shuushoku;

    /**
     *
     * @var integer
     */
    public $suu_minus;

    /**
     *
     * @var integer
     */
    public $suu_comma;

    /**
     *
     * @var integer
     */
    public $suu_zero;

    /**
     *
     * @var integer
     */
    public $suu_shousuuten;

    /**
     *
     * @var integer
     */
    public $suu_percent;

    /**
     *
     * @var integer
     */
    public $suu_yen;

    /**
     *
     * @var integer
     */
    public $suu_seisuuketa;

    /**
     *
     * @var integer
     */
    public $suu_shousuuketa;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('chouhyou_mr_id', 'ChouhyouMrs', 'id', array('alias' => 'ChouhyouMrs'));
        $this->belongsTo('font_kbn_id', 'FontKbns', 'id', array('alias' => 'FontKbns'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ChouhyouTextZokuseiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ChouhyouTextZokuseiMrs
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public function beforeCreate()
    {
        $this->created = date("Y-m-d H:i:s");
        $this->sakusei_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $this->updated = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }


    public function beforeUpdate()
    {
        $this->updated = date("Y-m-d H:i:s");
        $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'chouhyou_text_zokusei_mrs';
    }

}
