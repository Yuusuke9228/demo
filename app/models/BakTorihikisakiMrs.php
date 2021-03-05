<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class BakTorihikisakiMrs extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $uri_flg;

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
     * @var integer
     */
    public $tesuuryou_hutan_flg;

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
    public $torihikisaki_bunrui_kbn_cd;

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
     * @var string
     */
    public $harai2_houhou_kbn_cd;

    /**
     *
     * @var integer
     */
    public $wakekata;

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
     * @var integer
     */
    public $kouza_kankei;

    /**
     *
     * @var integer
     */
    public $yokin_shu;

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
        $this->validate(
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

        return true;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakTorihikisakiMrs[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return BakTorihikisakiMrs
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
        return 'bak_torihikisaki_mrs';
    }

}
