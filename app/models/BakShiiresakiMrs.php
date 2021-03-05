<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class BakShiiresakiMrs extends \Phalcon\Mvc\Model
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
    public $tantou_mr_id;

    /**
     *
     * @var string
     */
    public $torihiki_kbn_id;

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
    /*    $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }
     */
        return true;
       
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakShiiresakiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakShiiresakiMrs
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
        return 'bak_shiiresaki_mrs';
    }

}
