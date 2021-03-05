<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;


class ShiiresakiMrs extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $kana;

    /**
     *
     * @var string
     */
    public $ryakushou;

    /**
     *
     * @var string
     */
    public $yuubin_bangou;

    /**
     *
     * @var string
     */
    public $juusho1;

    /**
     *
     * @var string
     */
    public $juusho2;

    /**
     *
     * @var string
     */
    public $bushomei;

    /**
     *
     * @var string
     */
    public $yakushoku;

    /**
     *
     * @var string
     */
    public $gotantousha;

    /**
     *
     * @var string
     */
    public $keishou;

    /**
     *
     * @var string
     */
    public $tel;

    /**
     *
     * @var string
     */
    public $fax;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $homepage;

    /**
     *
     * @var string
     */
    public $tantou_mr_cd;

    /**
     *
     * @var string
     */
    public $torihiki_kbn_cd;

    /**
     *
     * @var string
     */
    public $tanka_shurui_kbn_cd;

    /**
     *
     * @var integer
     */
    public $kakeritu;

    /**
     *
     * @var string
     */
    public $tokuisaki_mr_cd;

    /**
     *
     * @var string
     */
    public $shimegrp_kbn_cd;

    /**
     *
     * @var string
     */
    public $gaku_hasuu_shori_kbn_cd;

    /**
     *
     * @var string
     */
    public $zei_hasuu_shori_kbn_cd;

    /**
     *
     * @var string
     */
    public $zei_tenka_kbn_cd;

    /**
     *
     * @var string
     */
    public $kake_zandaka;

    /**
     *
     * @var string
     */
    public $harai_houhou_kbn_cd;

    /**
     *
     * @var string
     */
    public $harai2_houhou_kbn_cd;

    /**
     *
     * @var string
     */
    public $yoshin_gendogaku;

    /**
     *
     * @var integer
     */
    public $wakekata;

    /**
     *
     * @var string
     */
    public $harai_saikuru_kbn_cd;

    /**
     *
     * @var integer
     */
    public $haraibi;

    /**
     *
     * @var integer
     */
    public $tegata_sight;

    /**
     *
     * @var string
     */
    public $ginkou_bangou;

    /**
     *
     * @var string
     */
    public $ginkou_mei;

    /**
     *
     * @var string
     */
    public $ginkoumei_kana;

    /**
     *
     * @var string
     */
    public $shiten_bangou;

    /**
     *
     * @var string
     */
    public $honshiten_mei;

    /**
     *
     * @var string
     */
    public $shitenmei_kana;

    /**
     *
     * @var string
     */
    public $kouza_kankei_kbn_cd;

    /**
     *
     * @var string
     */
    public $yokin_shurui_kbn_cd;

    /**
     *
     * @var string
     */
    public $kouza_bangou;

    /**
     *
     * @var string
     */
    public $kouza_meigi;

    /**
     *
     * @var string
     */
    public $kouza_meigi_kana;

    /**
     *
     * @var string
     */
    public $kokyaku_code1;

    /**
     *
     * @var string
     */
    public $kokyaku_code2;

    /**
     *
     * @var string
     */
    public $tesuuryou_hutan_kbn_cd;

    /**
     *
     * @var integer
     */
    public $hurikomi_houhou_flg;

    /**
     *
     * @var string
     */
    public $shiiresaki_bunrui1_kbn_cd;

    /**
     *
     * @var string
     */
    public $shiiresaki_bunrui2_kbn_cd;

    /**
     *
     * @var string
     */
    public $shiiresaki_bunrui3_kbn_cd;

    /**
     *
     * @var string
     */
    public $shiiresaki_bunrui4_kbn_cd;

    /**
     *
     * @var string
     */
    public $shiiresaki_bunrui5_kbn_cd;

    /**
     *
     * @var integer
     */
    public $sanshou_hyouji;

    /**
     *
     * @var string
     */
    public $memo;

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
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();
        $validator->add(
            'cd',
            new UniquenessValidator([
                'model' => $this,
                'message' => 'コードが既に登録されています。',
            ])
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('cd', 'ShouhinMrs', 'shu_shiiresaki_mr_cd', array('alias' => 'ShouhinMrs'));
        $this->belongsTo('tanka_shurui_kbn_cd', 'TankaShuruiKbns', 'cd', array('alias' => 'TankaShuruiKbns'));
        $this->belongsTo('shiiresaki_bunrui2_kbn_cd', 'ShiiresakiBunrui2Kbns', 'cd', array('alias' => 'ShiiresakiBunrui2Kbns'));
        $this->belongsTo('shiiresaki_bunrui3_kbn_cd', 'ShiiresakiBunrui3Kbns', 'cd', array('alias' => 'ShiiresakiBunrui3Kbns'));
        $this->belongsTo('shiiresaki_bunrui4_kbn_cd', 'ShiiresakiBunrui4Kbns', 'cd', array('alias' => 'ShiiresakiBunrui4Kbns'));
        $this->belongsTo('shiiresaki_bunrui5_kbn_cd', 'ShiiresakiBunrui5Kbns', 'cd', array('alias' => 'ShiiresakiBunrui5Kbns'));
        $this->belongsTo('shimegrp_kbn_cd', 'ShimegrpKbns', 'cd', array('alias' => 'ShimegrpKbns'));
        $this->belongsTo('gaku_hasuu_shori_kbn_cd', 'HasuushoriKbns', 'cd', array('alias' => 'HasuushoriKbns'));
        $this->belongsTo('zei_hasuu_shori_kbn_cd', 'HasuushoriKbns', 'cd', array('alias' => 'HasuushoriKbns'));
        $this->belongsTo('zei_tenka_kbn_cd', 'ZeitenkaKbns', 'cd', array('alias' => 'ZeitenkaKbns'));
        $this->belongsTo('harai_houhou_kbn_cd', 'ShiharaiKbns', 'cd', array('alias' => 'ShiharaiKbns'));
        $this->belongsTo('harai2_houhou_kbn_cd', 'ShiharaiKbns', 'cd', array('alias' => 'Shiharai2Kbns'));
        $this->belongsTo('harai_saikuru_kbn_cd', 'KaishuuSaikuruKbns', 'cd', array('alias' => 'KaishuuSaikuruKbns'));
        $this->belongsTo('shiiresaki_bunrui1_kbn_cd', 'ShiiresakiBunrui1Kbns', 'cd', array('alias' => 'ShiiresakiBunrui1Kbns'));
        $this->belongsTo('kouza_kankei_kbn_cd', 'KouzaKankeiKbns', 'cd', array('alias' => 'KouzaKankeiKbns'));
        $this->belongsTo('yokin_shurui_kbn_cd', 'YokinShuruiKbns', 'cd', array('alias' => 'YokinShuruiKbns'));
        $this->belongsTo('tesuuryou_hutan_kbn_cd', 'TesuuryouHutanKbns', 'cd', array('alias' => 'TesuuryouHutanKbns'));
        $this->belongsTo('tokuisaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'TokuisakiMrs')); // 追加2019/3/27井浦
        $this->hasMany('cd', 'ShiiresakiSimeDts', 'shiiresaki_mr_cd', array('alias' => 'ShiiresakiSimeDts', 'params'=>array('order' => 'sime_hiduke DESC')));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'shiiresaki_mrs';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiresakiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ShiiresakiMrs
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


}
