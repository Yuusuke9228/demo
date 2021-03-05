<?php
 


class ChouhyouTextZokuseiMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ChouhyouTextZokuseiMrs", "帳票テキスト属性"); //簡易検索付き一覧表示
    }

    /**
     * モーダルでテーブルを触らず親画面のデータだけを変更する。
     */
    public function modal1Action($trgyou)
    {
        $this->view->trgyou = $trgyou;
    }

    /**
     * Searches for chouhyou_text_zokusei_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="ChouhyouTextZokuseiMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $chouhyou_text_zokusei_mr = $nameDts::findFirstByid($id);
            if (!$chouhyou_text_zokusei_mr) {
                $this->flash->error("帳票テキスト属性が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_text_zokusei_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($chouhyou_text_zokusei_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "chouhyou_text_zokusei_mrs", "ChouhyouTextZokuseiMrs", "帳票テキスト属性");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "chouhyou_text_zokusei_mrs", "ChouhyouTextZokuseiMrs", "帳票テキスト属性");
    }

    /**
     * Edits a chouhyou_text_zokusei_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $chouhyou_text_zokusei_mr = ChouhyouTextZokuseiMrs::findFirstByid($id);
            if (!$chouhyou_text_zokusei_mr) {
                $this->flash->error("帳票テキスト属性が見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "chouhyou_text_zokusei_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $chouhyou_text_zokusei_mr->id;

            $this->_setDefault($chouhyou_text_zokusei_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($chouhyou_text_zokusei_mr, $action="edit", $meisai="ChouhyouTextZokuseiMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "chouhyou_mr_id",
            "shurui_kbn",
            "kmk_table",
            "sanshou",
            "kmk_cd",
            "yoko_zahyou",
            "tate_zahyou",
            "waku_haba",
            "waku_taka",
            "align",
            "valign",
            "stretch",
            "calign",
            "font_kbn_id",
            "font_style",
            "font_size",
            "inji_houkou",
            "moji_iro",
            "nuri_iro",
            "waku_iro",
            "waku_huto",
            "waku",
            "kmk_shuushoku",
            "suu_minus",
            "suu_comma",
            "suu_zero",
            "suu_shousuuten",
            "suu_percent",
            "suu_yen",
            "suu_seisuuketa",
            "suu_shousuuketa",
            "id_moto",
            "hikae_dltflg",
            "hikae_user_id",
            "hikae_nichiji",
            "sakusei_user_id",
            "created",
            "kousin_user_id",
            "updated",
            ];
            
        foreach ($setdts as $setdt) {
            if (property_exists($chouhyou_text_zokusei_mr, $setdt)) {
                $this->tag->setDefault($setdt, $chouhyou_text_zokusei_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new chouhyou_text_zokusei_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'index'
            ));

            return;
        }

        $chouhyou_text_zokusei_mr = new ChouhyouTextZokuseiMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "chouhyou_mr_id",
            "shurui_kbn",
            "kmk_table",
            "sanshou",
            "kmk_cd",
            "yoko_zahyou",
            "tate_zahyou",
            "waku_haba",
            "waku_taka",
            "align",
            "valign",
            "stretch",
            "calign",
            "font_kbn_id",
            "font_style",
            "font_size",
            "inji_houkou",
            "moji_iro",
            "nuri_iro",
            "waku_iro",
            "waku_huto",
            "waku",
            "kmk_shuushoku",
            "suu_minus",
            "suu_comma",
            "suu_zero",
            "suu_shousuuten",
            "suu_percent",
            "suu_yen",
            "suu_seisuuketa",
            "suu_shousuuketa",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $chouhyou_text_zokusei_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chouhyou_text_zokusei_mr->save()) {
            foreach ($chouhyou_text_zokusei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("帳票テキスト属性の作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_text_zokusei_mrs",
            'action' => 'edit',
            'params' => array($chouhyou_text_zokusei_mr->id)
        ));
    }

    /**
     * Saves a chouhyou_text_zokusei_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $chouhyou_text_zokusei_mr = ChouhyouTextZokuseiMrs::findFirstByid($id);

        if (!$chouhyou_text_zokusei_mr) {
            $this->flash->error("帳票テキスト属性が見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($chouhyou_text_zokusei_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから帳票テキスト属性が変更されたため更新を中止しました。"
                . $id . ",uid=" . $chouhyou_text_zokusei_mr->kousin_user_id . " tb=" . $chouhyou_text_zokusei_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "chouhyou_mr_id",
            "shurui_kbn",
            "kmk_table",
            "sanshou",
            "kmk_cd",
            "yoko_zahyou",
            "tate_zahyou",
            "waku_haba",
            "waku_taka",
            "align",
            "valign",
            "stretch",
            "calign",
            "font_kbn_id",
            "font_style",
            "font_size",
            "inji_houkou",
            "moji_iro",
            "nuri_iro",
            "waku_iro",
            "waku_huto",
            "waku",
            "kmk_shuushoku",
            "suu_minus",
            "suu_comma",
            "suu_zero",
            "suu_shousuuten",
            "suu_percent",
            "suu_yen",
            "suu_seisuuketa",
            "suu_shousuuketa",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $chouhyou_text_zokusei_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "chouhyou_text_zokusei_mrs",
                "action" => "edit",
                "params" => array($chouhyou_text_zokusei_mr->id)
            ));

            return;
        }

        $this->_bakOut($chouhyou_text_zokusei_mr);

        foreach ($post_flds as $post_fld) {
            $chouhyou_text_zokusei_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$chouhyou_text_zokusei_mr->save()) {

            foreach ($chouhyou_text_zokusei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("帳票テキスト属性の情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_text_zokusei_mrs",
            'action' => 'edit',
            'params' => array($chouhyou_text_zokusei_mr->id)
        ));
    }

    /**
     * Deletes a chouhyou_text_zokusei_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $chouhyou_text_zokusei_mr = ChouhyouTextZokuseiMrs::findFirstByid($id);
        if (!$chouhyou_text_zokusei_mr) {
            $this->flash->error("帳票テキスト属性が見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($chouhyou_text_zokusei_mr, 1);

        if (!$chouhyou_text_zokusei_mr->delete()) {

            foreach ($chouhyou_text_zokusei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "chouhyou_text_zokusei_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("帳票テキスト属性の削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "chouhyou_text_zokusei_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a chouhyou_text_zokusei_mr
     *
     * @param string $chouhyou_text_zokusei_mr, $dlt_flg
     */
    public function _bakOut($chouhyou_text_zokusei_mr, $dlt_flg = 0)
    {

        $bak_chouhyou_text_zokusei_mr = new BakChouhyouTextZokuseiMrs();
        foreach ($chouhyou_text_zokusei_mr as $fld => $value) {
            $bak_chouhyou_text_zokusei_mr->$fld = $chouhyou_text_zokusei_mr->$fld;
        }
        $bak_chouhyou_text_zokusei_mr->id = NULL;
        $bak_chouhyou_text_zokusei_mr->id_moto = $chouhyou_text_zokusei_mr->id;
        $bak_chouhyou_text_zokusei_mr->hikae_dltflg = $dlt_flg;
        $bak_chouhyou_text_zokusei_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_chouhyou_text_zokusei_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_chouhyou_text_zokusei_mr->save()) {
            foreach ($bak_chouhyou_text_zokusei_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

}
