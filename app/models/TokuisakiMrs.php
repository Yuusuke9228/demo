<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class TokuisakiMrs extends \Phalcon\Mvc\Model
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
    public $siiresaki_mr_cd;

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
    public $seikyuusaki_mr_cd;

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
    public $yoshin_gendogaku;

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
    public $harai_saikuru_kbn_cd;

    /**
     *
     * @var integer
     */
    public $haraibi;

    /**
     *
     * @var string
     */
    public $tesuuryou_hutan_kbn_cd;

    /**
     *
     * @var integer
     */
    public $tegata_sight;

    /**
     *
     * @var string
     */
    public $shitei_uriden_kbn_cd;

    /**
     *
     * @var string
     */
    public $shitei_seikyuusho_kbn_cd;

    /**
     *
     * @var integer
     */
    public $atena_lavel;

    /**
     *
     * @var string
     */
    public $kigyou_code;

    /**
     *
     * @var string
     */
    public $seikyuusho_gassan_mr_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_bunrui1_kbn_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_bunrui2_kbn_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_bunrui3_kbn_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_bunrui4_kbn_cd;

    /**
     *
     * @var string
     */
    public $tokuisaki_bunrui5_kbn_cd;

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
    /*    $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => false,
                )
            )
        );  */
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
        $this->hasMany('cd', 'TokuisakiMrs', 'seikyuusho_gassan_mr_cd', array('alias' => 'SeikyuushoGassanMrs'));
        $this->belongsTo('tanka_shurui_kbn_cd', 'TankaShuruiKbns', 'cd', array('alias' => 'TankaShuruiKbns'));
        $this->belongsTo('gaku_hasuu_shori_kbn_cd', 'HasuushoriKbns', 'cd', array('alias' => 'HasuushoriKbns'));
        $this->belongsTo('tokuisaki_bunrui2_kbn_cd', 'TokuisakiBunrui2Kbns', 'cd', array('alias' => 'TokuisakiBunrui2Kbns'));
        $this->belongsTo('tokuisaki_bunrui3_kbn_cd', 'TokuisakiBunrui3Kbns', 'cd', array('alias' => 'TokuisakiBunrui3Kbns'));
        $this->belongsTo('tokuisaki_bunrui4_kbn_cd', 'TokuisakiBunrui4Kbns', 'cd', array('alias' => 'TokuisakiBunrui4Kbns'));
        $this->belongsTo('tokuisaki_bunrui5_kbn_cd', 'TokuisakiBunrui5Kbns', 'cd', array('alias' => 'TokuisakiBunrui5Kbns'));
        $this->belongsTo('zei_hasuu_shori_kbn_cd', 'HasuushoriKbns', 'cd', array('alias' => 'HasuushoriKbns'));
        $this->belongsTo('zei_tenka_kbn_cd', 'ZeitenkaKbns', 'cd', array('alias' => 'ZeitenkaKbns'));
        $this->belongsTo('harai_houhou_kbn_cd', 'NyuukinKbns', 'cd', array('alias' => 'NyuukinKbns'));
        $this->belongsTo('harai_saikuru_kbn_cd', 'KaishuuSaikuruKbns', 'cd', array('alias' => 'KaishuuSaikuruKbns'));
        $this->belongsTo('tesuuryou_hutan_kbn_cd', 'TesuuryouHutanKbns', 'cd', array('alias' => 'TesuuryouHutanKbns'));
        $this->belongsTo('shitei_uriden_kbn_cd', 'ChouhyouMrs', 'id', array('alias' => 'ShiteiUridenKbns'));
        $this->belongsTo('shitei_seikyuusho_kbn_cd', 'ChouhyouMrs', 'id', array('alias' => 'ShiteiSeikyuushoKbns'));
        $this->belongsTo('seikyuusaki_mr_cd', 'TokuisakiMrs', 'cd', array('alias' => 'SeikyuusakiMrs'));
        $this->belongsTo('tokuisaki_bunrui1_kbn_cd', 'TokuisakiBunrui1Kbns', 'cd', array('alias' => 'TokuisakiBunrui1Kbns'));
        $this->belongsTo('tantou_mr_cd', 'TantouMrs', 'cd', array('alias' => 'TantouMrs'));
        // $this->hasMany('cd', 'ShiiresakiMrs', 'tokuisaki_mr_cd', array('alias' => 'ShiiresakiMrs')); // 削除2019/3/27井浦
        $this->hasMany('cd', 'TokuisakiSimeDts', 'tokuisaki_mr_cd', array('alias' => 'TokuisakiSimeDts', 'params'=>array('order' => 'sime_hiduke DESC')));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TokuisakiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TokuisakiMrs
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
        return 'tokuisaki_mrs';
    }

	/**
	 *
	 */
    public static function findSimebi($cd = null)
    {
    	$row=TokuisakiMrs::findFirst(['conditions'=>'cd=?1','bind'=>[1=>$cd]]);
    	if ($row) {
    		if ($row->shimegrp_kbn_cd <= '28') {
    			if ($row->shimegrp_kbn_cd <= date('d')) {
    				return date('Y-m-'.$row->shimegrp_kbn_cd);
    			} else {
    				return date('Y-m-'.$row->shimegrp_kbn_cd, strtotime(date('Y-m-1').' -1 month'));
    			}
    		} elseif ($row->shimegrp_kbn_cd = '31') {
    			if ($row->shimegrp_kbn_cd <= '31') {
    				return date('Y-m-t');
    			} else {
    				return date('Y-m-t', strtotime(date('Y-m-1').' -1 month'));
    			}
    		}
    	}
    }

}
