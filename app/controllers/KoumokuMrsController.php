<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Db\Adapter\Pdo\Mysql;

class KoumokuMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("KoumokuMrs", "項目マスタ"); //簡易検索付き一覧表示
    }

    /**
     * モーダル マルチセレクト
     */
    public function multiselAction()
    {
		$table_mr_cd = 'kihon_mrs';
		if (!$this->request->isPost()) {
			$table_mr_cd = $this->request->getQuery("table_mr_cd") ?? $table_mr_cd;
		}
		$koumoku_mrs = KoumokuMrs::find([
			'conditions'=>'table_mr_cd = ?1',
			'bind'=>[1=>$table_mr_cd],
			'order'=>'jun',
		]);
		if (count($koumoku_mrs) == 0) {
			$this->flash->notice("検索の結果、項目件数は０件でした。");
		}
		$this->view->imax=count($koumoku_mrs);
		$this->view->koumoku_mrs=$koumoku_mrs;
//echo('<br><br><br>'.count($koumoku_mrs).'<br>'); print_r($table_mr_cd);
    }

    /**
     * Searches for koumoku_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id=null, $dataname="KoumokuMrs")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $koumoku_mr = $nameDts::findFirstByid($id);
            if (!$koumoku_mr) {
                $this->flash->error("項目マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "koumoku_mrs",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($koumoku_mr, "new", $dataname);
            $this->tag->setDefault("id", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "koumoku_mrs", "KoumokuMrs", "項目マスタ");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "koumoku_mrs", "KoumokuMrs", "項目マスタ");
    }

    /**
     * Edits a koumoku_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
//        if (!$this->request->isPost()) {

            $koumoku_mr = KoumokuMrs::findFirstByid($id);
            if (!$koumoku_mr) {
                $this->flash->error("項目マスタが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "koumoku_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $koumoku_mr->id;

            $this->_setDefault($koumoku_mr, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($koumoku_mr, $action="edit", $meisai="KoumokuMrs")
    {
        $setdts = ["id",
            "cd",
            "name",
            "table_mr_cd",
            "jun",
            "data_kata",
            "nagasa",
            "shougoujunjo",
            "zokusei",
            "nullka",
            "default_ti",
            "sonota",
            "indekkusu",
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
            if (property_exists($koumoku_mr, $setdt)) {
                $this->tag->setDefault($setdt, $koumoku_mr->$setdt);
            }
        }
    }

    /**
     * Creates a new koumoku_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        $koumoku_mr = new KoumokuMrs();

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "table_mr_cd",
            "jun",
            "data_kata",
            "nagasa",
            "shougoujunjo",
            "zokusei",
            "nullka",
            "default_ti",
            "sonota",
            "indekkusu",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        foreach ($post_flds as $post_fld) {
            $koumoku_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$koumoku_mr->save()) {
            foreach ($koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("項目マスタの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "koumoku_mrs",
            'action' => 'edit',
            'params' => array($koumoku_mr->id)
        ));
    }

    /**
     * Saves a koumoku_mr edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $koumoku_mr = KoumokuMrs::findFirstByid($id);

        if (!$koumoku_mr) {
            $this->flash->error("項目マスタが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        if ($koumoku_mr->updated !== $this->request->getPost("updated")) {
            $this->flash->error("他のプロセスから項目マスタが変更されたため更新を中止しました。"
                . $id . ",uid=" . $koumoku_mr->kousin_user_id . " tb=" . $koumoku_mr->updated ." pt=" . $this->request->getPost("updated"));

            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $post_flds = [];
        $post_flds = ["cd",
            "name",
            "table_mr_cd",
            "jun",
            "data_kata",
            "nagasa",
            "shougoujunjo",
            "zokusei",
            "nullka",
            "default_ti",
            "sonota",
            "indekkusu",
            "updated",
            ];
        

        $thisPost=[]; // カンマ編集を消すとか日付編集0000-00-00を入れるとか$thisPost[]で行う
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ((array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld)) !== $koumoku_mr->$post_fld) {
                $chg_flg = 1;
                break;
            }
        }
        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "koumoku_mrs",
                "action" => "edit",
                "params" => array($koumoku_mr->id)
            ));

            return;
        }

        $this->_bakOut($koumoku_mr);

        foreach ($post_flds as $post_fld) {
            $koumoku_mr->$post_fld = array_key_exists($post_fld, $thisPost)?$thisPost[$post_fld]:$this->request->getPost($post_fld);
        }

        if (!$koumoku_mr->save()) {

            foreach ($koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("項目マスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "koumoku_mrs",
            'action' => 'edit',
            'params' => array($koumoku_mr->id)
        ));
    }

    /**
     * Deletes a koumoku_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $koumoku_mr = KoumokuMrs::findFirstByid($id);
        if (!$koumoku_mr) {
            $this->flash->error("項目マスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'index'
            ));

            return;
        }

        $this->_bakOut($koumoku_mr, 1);

        if (!$koumoku_mr->delete()) {

            foreach ($koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "koumoku_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->flash->success("項目マスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "koumoku_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a koumoku_mr
     *
     * @param string $koumoku_mr, $dlt_flg
     */
    public function _bakOut($koumoku_mr, $dlt_flg = 0)
    {

        $bak_koumoku_mr = new BakKoumokuMrs();
        foreach ($koumoku_mr as $fld => $value) {
            $bak_koumoku_mr->$fld = $koumoku_mr->$fld;
        }
        $bak_koumoku_mr->id = NULL;
        $bak_koumoku_mr->id_moto = $koumoku_mr->id;
        $bak_koumoku_mr->hikae_dltflg = $dlt_flg;
        $bak_koumoku_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_koumoku_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_koumoku_mr->save()) {
            foreach ($bak_koumoku_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /**
     * Autogens a koumoku_mr
     *
     */
    public function autogenAction($id)
    {
        $table_mr = TableMrs::findFirstByid($id);
        $cd = $table_mr->cd;
		$config = $this->db->getDescriptor();
        $link = mysqli_connect($config["host"], $config["username"], $config["password"]); //($config->database->host, $config->database->username, $config->database->password);
        if (!$link) {
           echo('接続失敗です。'.mysql_error().'<br />');
           $db_selected = false;
        }else{
           $db_selected = mysqli_select_db($link, $config["dbname"]); //($config->database->dbname, $link);
           if (!$db_selected){
              echo('データベース選択失敗です。'.mysql_error().'<br />');
           }
        }
        if ($db_selected){
            mysqli_set_charset($link, $config["charset"]); //($config->database->charset);
            $result = mysqli_query($link, "SHOW FULL COLUMNS FROM " . $cd);//by iura 2016/6/21
            if (!$result) {
                echo('クエリーが失敗しました。'.mysql_error().'<br />');
            }else{
                while ($results[] = mysqli_fetch_assoc($result)) {}
                mysqli_free_result($result);
            }
        }

        for ($i=0; $i < count($results)-1; $i++) {
            $koumoku_mr = KoumokuMrs::findfirst(array("table_mr_cd = '".$cd."' AND jun = '".$i."'",));
            if (!$koumoku_mr) {
                $koumoku_mr = new KoumokuMrs();//echo ("new,");
                $koumoku_mr->jun = $i;
                $koumoku_mr->table_mr_cd = $cd;
            }									//echo ($koumoku_mr->id);
            $koumoku_mr->cd = $results[$i]["Field"];//echo ($results[$i]["Field"].",");
            $koumoku_mr->data_kata = $results[$i]["Type"];
            $koumoku_mr->shougoujunjo = $results[$i]["Collation"];
            $koumoku_mr->default_ti = $results[$i]["Default"];
            preg_match('/\((\d+)\)/', $results[$i]["Type"], $nagasa);//echo(count($nagasa)."=".$nagasa[1].",");
            $koumoku_mr->nagasa = (count($nagasa)>0)?$nagasa[1]:0;
            $koumoku_mr->default_ti = $results[$i]["Default"];
            $koumoku_mr->sonota = $results[$i]["Extra"];
            $koumoku_mr->nullka = ($results[$i]["Null"]=='YES')?1:0;// echo ($results[$i]["Null"].",");
            $koumoku_mr->indekkusu = $results[$i]["Key"];
            $koumoku_mr->name = ($results[$i]["Comment"])??$results[$i]["Field"];
            $koumoku_mr->save();
        }
        do {
            $koumoku_mr = KoumokuMrs::findfirst(array("table_mr_cd = '".$cd."' AND jun = '".$i."'", ));
            if ($koumoku_mr) {
                $koumoku_mr->delete();
            }
            $i++;
        } while ($koumoku_mr);
/*
 echo "<pre>";
 var_dump($results);
 echo "</pre>";
 return;
*/

        $this->flash->success("項目マスタの自動登録を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "table_mrs",
            'action' => "edit",
            'params' => array($id)
        ));
    }


}
