<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        return $this->response->redirect('session/index');
    }

    public function sentakuAction()
    {
    }

    /*
     * 台帳Excelエクスポート
     */
    public function export_excelAction()
    {
        if ($this->request->isPost()) {
            $table = $this->request->getPost('table');
            $rows = $table::find();
            $rows = $rows->toArray();
            //Tableに合わせて見出しを作る
            $data_title = [];
            switch ($table) {
                case 'ShouhinMrs':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "商品コード",
                        "name" => "名称",
                        "kana" => "フリガナ",
                        "tanni_mr_cd" => "単位コード",
                        "suu_tanni_mr_cd" => "数単位コード",
                        "tanni_mr1_cd" => "単位1",
                        "tanni_mr2_cd" => "単位2",
                        "tanka_kbn" => "単価区分",
                        "zaiko_kbn" => "在庫区分",
                        "irisuu" => "入数",
                        "kikaku" => "企画",
                        "iro" => "色番",
                        "iromei" => "色名",
                        "size" => "サイズ",
                        "lot" => "ロット",
                        "hinsitu_kbn_cd" => "品質",
                        "suu_shousuu" => "数小数",
                        "suu1_shousuu" => "数1小数",
                        "suu2_shousuu" => "数2小数",
                        "tanka_shousuu" => "単価小数",
                        "kazei_kbn_cd" => "課税区分",
                        "zaikokanri" => "在庫管理",
                        "hacchuu_lot" => "発注ロット",
                        "lead_time" => "リードタイム",
                        "zaiko_tekisei" => "適正在庫",
                        "zaiko_hyouka_kbn_cd" => "在庫評価区分",
                        "shu_shiiresaki_mr_cd" => "主仕入先",
                        "shu_souko_mr_cd" => "主倉庫",
                        "hacchuu_rendou" => "発注連動",
                        "gen_zaiko" => "現在庫",
                        "last_shukko_date" => "最終出庫日",
                        "last_nyuuko_date" => "最終入庫日",
                        "joudai" => "上代",
                        "uri_tanka1" => "売単価1",
                        "uri_tanka2" => "売単価2",
                        "uri_tanka3" => "売単価3",
                        "uri_tanka4" => "売単価4",
                        "uri_genka" => "売り原価",
                        "shiire_tanka" => "仕入単価",
                        "hyoujun_genka" => "標準原価",
                        "hyoukasage_genka" => "評価下げ時原価",
                        "shouhin_bunrui1_kbn_cd" => "分類1",
                        "shouhin_bunrui2_kbn_cd" => "分類2",
                        "shouhin_bunrui3_kbn_cd" => "分類3",
                        "shouhin_bunrui4_kbn_cd" => "分類4",
                        "shouhin_bunrui5_kbn_cd" => "分類5",
                        "sanshou_hyouji" => "参照表示",
                        "memo" => "メモ",
                        "id_moto" => "元Id",
                        "hikae_dltflg" => "控えフラグ",
                        "hikae_user_id" => "控えユーザーId",
                        "hikae_nichiji" => "控え日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
                case 'TokuisakiMrs':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "得意先コード",
                        "name" => "名称",
                        "kana" => "カナ",
                        "ryakushou" => "略称",
                        "siiresaki_mr_cd" => "仕入先コード",
                        "yuubin_bangou" => "郵便番号",
                        "juusho1" => "住所1",
                        "juusho2" => "住所2",
                        "bushomei" => "部署名",
                        "yakushoku" => "役職",
                        "gotantousha" => "ご担当者",
                        "keishou" => "敬称",
                        "tel" => "電話",
                        "fax" => "ファックス",
                        "email" => "メール",
                        "homepage" => "ホームページ",
                        "tantou_mr_cd" => "営業担当",
                        "torihiki_kbn_cd" => "取引区分",
                        "tanka_shurui_kbn_cd" => "単価種類",
                        "kakeritu" => "掛け率",
                        "seikyuusaki_mr_cd" => "請求先",
                        "shimegrp_kbn_cd" => "締めグループ",
                        "gaku_hasuu_shori_kbn_cd" => "額端数",
                        "zei_hasuu_shori_kbn_cd" => "税端数処理区分",
                        "zei_tenka_kbn_cd" => "税転嫁区分",
                        "yoshin_gendogaku" => "与信限度額",
                        "kake_zandaka" => "掛け算高",
                        "harai_houhou_kbn_cd" => "支払い方法区分",
                        "harai_saikuru_kbn_cd" => "支払いサイクル",
                        "haraibi" => "支払日",
                        "tesuuryou_hutan_kbn_cd" => "手数料負担区分",
                        "tegata_sight" => "手形サイト",
                        "shitei_uriden_kbn_cd" => "指定売伝区分",
                        "shitei_seikyuusho_kbn_cd " => "指定請求書区分",
                        "atena_lavel" => "宛名ラベル",
                        "kigyou_code" => "企業コード",
                        "seikyuusho_gassan_mr_cd" => "請求書合算",
                        "tokuisaki_bunrui1_kbn_cd" => "得意先分類1",
                        "tokuisaki_bunrui2_kbn_cd" => "得意先分類2",
                        "tokuisaki_bunrui3_kbn_cd" => "得意先分類3",
                        "tokuisaki_bunrui4_kbn_cd" => "得意先分類4",
                        "tokuisaki_bunrui5_kbn_cd" => "得意先分類5",
                        "sanshou_hyouji " => "参照表示",
                        "memo" => "メモ",
                        "id_moto" => "元Id",
                        "hikae_dltflg" => "控えフラグ",
                        "hikae_user_id" => "控えユーザーId",
                        "hikae_nichiji" => "控え日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
                case 'NounyuusakiMrs':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "納入先コード",
                        "name" => "名称",
                        "kana" => "カナ",
                        "ryakushou" => "略称",
                        "yuubin_bangou" => "郵便番号",
                        "juusho1" => "住所1",
                        "juusho2" => "住所2",
                        "bushomei" => "部署名",
                        "yakushoku" => "役職",
                        "gotantousha" => "ご担当者",
                        "keishou" => "敬称",
                        "tel" => "電話",
                        "fax" => "ファックス",
                        "tokuisaki_mr_cd" => "得意先コード",
                        "id_moto" => "元Id",
                        "hikae_dltflg" => "控えフラグ",
                        "hikae_user_id" => "控えユーザーId",
                        "hikae_nichiji" => "控え日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
                case 'ShiiresakiMrs':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "仕入先コード",
                        "name" => "名称",
                        "kana" => "カナ",
                        "ryakushou" => "略称",
                        "yuubin_bangou" => "郵便番号",
                        "juusho1" => "住所1",
                        "juusho2" => "住所2",
                        "bushomei" => "部署名",
                        "yakushoku" => "役職",
                        "gotantousha" => "ご担当者",
                        "keishou" => "敬称",
                        "tel" => "電話",
                        "fax" => "ファックス",
                        "email" => "メール",
                        "homepage" => "ホームページ",
                        "tantou_mr_cd" => "営業担当",
                        "torihiki_kbn_cd" => "取引区分",
                        "tanka_shurui_kbn_cd" => "単価種類",
                        "kakeritu" => "掛け率",
                        "tokuisaki_mr_cd" => "得意先コード",
                        "shimegrp_kbn_cd" => "締めグループ",
                        "gaku_hasuu_shori_kbn_cd" => "額端数処理",
                        "zei_hasuu_shori_kbn_cd" => "税端数処理",
                        "zei_tenka_kbn_cd" => "税転嫁",
                        "kake_zandaka" => "掛け残高",
                        "harai_houhou_kbn_cd" => "支払い方法",
                        "harai2_houhou_kbn_cd" => "支払い2方法",
                        "yoshin_gendogaku" => "与信限度額",
                        "wakekata" => "分け方",
                        "harai_saikuru_kbn_cd" => "支払いサイクル",
                        "haraibi" => "支払日",
                        "tegata_sight" => "手形サイト",
                        "ginkou_bangou" => "銀行番号",
                        "ginkou_mei" => "銀行名",
                        "ginkoumei_kana" => "銀行名カナ",
                        "shiten_bangou" => "支店番号",
                        "honshiten_mei" => "本支店名",
                        "shitenmei_kana" => "支店名カナ",
                        "kouza_kankei_kbn_cd" => "口座関係",
                        "yokin_shurui_kbn_cd" => "預金種類",
                        "kouza_bangou" => "口座番号",
                        "kouza_meigi" => "口座名義",
                        "kouza_meigi_kana" => "口座名義カナ",
                        "kokyaku_code1" => "顧客コード1",
                        "kokyaku_code2" => "顧客コード2",
                        "tesuuryou_hutan_kbn_cd" => "手数料負担",
                        "hurikomi_houhou_flg" => "振込方法",
                        "shiiresaki_bunrui1_kbn_cd" => "仕入先分類1",
                        "shiiresaki_bunrui2_kbn_cd" => "仕入先分類2",
                        "shiiresaki_bunrui3_kbn_cd" => "仕入先分類3",
                        "shiiresaki_bunrui4_kbn_cd" => "仕入先分類4",
                        "shiiresaki_bunrui5_kbn_cd" => "仕入先分類5",
                        "sanshou_hyouji" => "参照表示",
                        "memo" => "メモ",
                        "id_moto" => "元Id",
                        "hikae_dltflg" => "控えフラグ",
                        "hikae_user_id" => "控えユーザーId",
                        "hikae_nichiji" => "控え日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
                case 'SoukoMrs':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "倉庫コード",
                        "name" => "名称",
                        "yuubin_bangou" => "郵便番号",
                        "juusho1" => "住所1",
                        "juusho2" => "住所2",
                        "tantou_mr_cd " => "営業担当",
                        "tel" => "電話",
                        "fax" => "ファックス",
                        "memo" => "メモ",
                        "id_moto" => "元Id",
                        "hikae_dltflg" => "控えフラグ",
                        "hikae_user_id" => "控えユーザーId",
                        "hikae_nichiji" => "控え日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
                case 'TantouMrs':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "担当コード",
                        "name" => "名称",
                        "kana_mei" => "カナ",
                        "bumon_mr_cd" => "部門コード",
                        "user_cd" => "ユーザーコード",
                        "id_moto" => "元Id",
                        "hikae_dltflg" => "控えフラグ",
                        "hikae_user_id" => "控えユーザーId",
                        "hikae_nichiji" => "控え日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
                case 'Users':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "ユーザーコード",
                        "password" => "パスワード",
                        "name" => "名称",
                        "user_group_mr_cd" => "ユーザーグループ",
                        "kaisi_bi" => "適用日",
                        "id_moto" => "元Id",
                        "kinsi_flg" => "禁止フラグ",
                        "shuuryou_nitiji" => "終了日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
                case 'KouseiBuhinMrs':
                    $data_title[0] = [
                        "id" => "Id",
                        "cd" => "部品行番",
                        "shouhin_mr_cd" => "製品コード",
                        "gen_shouhin_mr_cd" => "原料コード",
                        "tanni_mr_cd" => "単位コード",
                        "suuryou" => "構成数量",
                        "id_moto" => "元Id",
                        "hikae_dltflg" => "控えフラグ",
                        "hikae_user_id" => "控えユーザーId",
                        "hikae_nichiji" => "控え日時",
                        "sakusei_user_id" => "作成ユーザーId",
                        "created" => "作成日",
                        "kousin_user_id" => "更新ユーザーId",
                        "updated" => "更新日時"
                    ];
                    break;
            }
            $data_sets = array_merge($data_title, $rows); //見出しとデータのマージ

            $PHPExcel = \Phalcon\DI::getDefault()->get('PHPExcel');
            $sheet = $PHPExcel->getActiveSheet();
            $sheet->fromArray($data_sets, null, 'A1');
            $filename = uniqid($table, true) . '';
            $upload = __DIR__ . '/temp/';
            $path = $upload . $filename;
            $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
            $objWriter->save($path);

            $response = new \Phalcon\Http\Response();
            $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
            $response->setHeader('Cache-Control', 'max-age=0');
            $response->setHeader('Cache-Control', 'max-age=1');
            $response->setContent(file_get_contents($path));
            unlink($path);
            return $response;
        }
    }
}

