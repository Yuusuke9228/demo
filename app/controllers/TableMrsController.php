<?php
 


class TableMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("TableMrs", "テーブルマスタ"); //簡易検索付き一覧表示
    }

    /**
     * Searches for table_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="TableMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $table_mr = $nameDts::findFirstByid($id);
            if (!$table_mr) {
                $this->flash->error("テーブルマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "table_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($table_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "table_mrs", "TableMrs", "テーブルマスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "table_mrs", "TableMrs", "テーブルマスタ");
    }

    /**
     * Edits a table_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $table_mr = TableMrs::findFirstByid($id);
            if (!$table_mr) {
                $this->flash->error("テーブルマスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "table_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $table_mr->id;

            $this->_setDefault($table_mr, "edit");

            $this->view->koumoku_mrs = $table_mr->KoumokuMrs;
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($table_mr, $action="edit", $meisai="TableMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "database_cd",
            "jun",
            "menu_group_mr_cd",
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
            if (property_exists($table_mr, $setdt)) {
                $this->tag->setDefault($setdt, $table_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new table_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'index'
            ));

            return;
        }

        $table_mr = new TableMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "database_cd",
            "jun",
            "menu_group_mr_cd",
            "updated",
            ];
        

        $thisPost=[];
        foreach ($post_flds as $post_fld) {
            $table_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$table_mr->save()) {
            foreach ($table_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("テーブルマスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "table_mrs",
            'action' => 'edit',
            'params' => array($table_mr->id)
        ));
    }

    /**
     * Saves a table_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $table_mr = TableMrs::findFirstByid($id);

        if (!$table_mr) {
            $this->flash->error("テーブルマスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($table_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスからテーブルマスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $table_mr->kousin_user_id . " tb=" . $table_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "database_cd",
            "jun",
            "menu_group_mr_cd",
            "updated",
            ];
        

        $thisPost=[];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $table_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "table_mrs",
                "action" => "edit",
                "params" => array($table_mr->id)
            ));

            return;
        }

        $this->_bakOut($table_mr);

        foreach ($post_flds as $post_fld) {
            $table_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$table_mr->save()) {

            foreach ($table_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("テーブルマスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "table_mrs",
            'action' => 'edit',
            'params' => array($table_mr->id)
        ));
    }

    /**
     * Deletes a table_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $table_mr = TableMrs::findFirstByid($id);
        if (!$table_mr) {
            $this->flash->error("テーブルマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$table_mr->delete()) {

            foreach ($table_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "table_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($table_mr, 1);

        $this->flash->success("テーブルマスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "table_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a table_mr
     *
     * @param string $table_mr, $dlt_flg
     */
    public function _bakOut($table_mr, $dlt_flg = 0)
    {

        $bak_table_mr = new BakTableMrs();
        foreach ($table_mr as $fld => $value) {
            $bak_table_mr->$fld = $table_mr->$fld;
        }
        $bak_table_mr->id = NULL;
        $bak_table_mr->id_moto = $table_mr->id;
        $bak_table_mr->hikae_dltflg = $dlt_flg;
        $bak_table_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_table_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_table_mr->save()) {
            foreach ($bak_table_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * Autogens a table_mr
     *
     */
    public function autogenAction()
    {
      //  $config = $this->getConfig();
/*
 echo "<pre>";
 var_dump($config);
 echo "</pre>";
 return;
*/
        $results = $this->db->listTables();
        $table_mrs = TableMrs::find(array('order' => 'cd'));
        $table_exists = array();

        foreach ($table_mrs as $table_mr) {
            if (in_array ( $table_mr->cd , $results )) {
                $table_exists[$table_mr->cd] = $table_mr->id;
            } else {
                $table_mr_del = TableMrs::findFirstByid($table_mr->id);
                if ($table_mr_del) {
                    $table_mr_del->delete();
                }
            }
        }
/*
 echo "<pre>";
 var_dump($table_exists);
 echo "</pre>";
 return;
*/
		$config = $this->db->getDescriptor();
        foreach ($results as $tablecd) {
            $comments = array();// by iura 2016/06/23 ここから
            $link = mysqli_connect($config["host"], $config["username"], $config["password"]);//($config->database->host, $config->database->username, $config->database->password);
            if (!$link) {
               echo('接続失敗です。'.mysql_error().'<br />');
               $db_selected = false;
            }else{
               $db_selected = mysqli_select_db($link, $config["dbname"]); //($config->database->dbname, $link);
               if (!$db_selected){
                  echo('データベース選択失敗です。'.mysql_error().'<br />');
               }
            }
            $nplural = $tablecd;
            if ($db_selected){
                mysqli_set_charset($link, $config["charset"]); //($config->database->charset);
                $result = mysqli_query($link, "show table status like '" . $tablecd . "'" );//by iura 2016/6/21
                if (!$result) {
                    echo('クエリーが失敗しました。'.mysql_error().'<br />');
                }else{
                    $row = mysqli_fetch_assoc($result);
                    if($row['Comment']!=''){
                        $nplural = $row['Comment'];
                    }
                }
            }
            if (array_key_exists ( $tablecd , $table_exists )) {
                $table_mr = TableMrs::findFirstByid($table_exists[$tablecd]);
            } else {
                $table_mr = new TableMrs();
                $table_mr->cd = $tablecd;
            }
            $table_mr->name = $nplural;
            $table_mr->database_cd = $config["dbname"];
            $table_mr->save();
        }


        $this->flash->success("テーブルマスタの自動登録を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "table_mrs",
            'action' => "index"
        ));
    }

}
