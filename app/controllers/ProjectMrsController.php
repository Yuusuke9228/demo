<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ProjectMrsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $main_rows = ProjectMrs::find();
        $main_rows = $main_rows->toArray();
        $sub_rows = ProjectSubMrs::find();
        $sub_rows = $sub_rows->toArray();
        //サブプロジェクトテーブルを組み込む
        $rows = [];
        $i = 0;
        $yosan_kei = 0;
        for ($main_row = 0; $main_row < count($main_rows); $main_row++) {
            if (count($sub_rows) !== 0) {
                for ($sub_row = 0; $sub_row < count($sub_rows); $sub_row++) {
                    if ($main_rows[$main_row]['id'] === $sub_rows[$sub_row]['project_id']) {
                        $rows[$i]['id'] = '';
                        $rows[$i]['sub_id'] = $sub_rows[$sub_row]['id'];
                        $rows[$i]['sub_cd'] = $sub_rows[$sub_row]['cd'];
                        $rows[$i]['cd'] = '';
                        $rows[$i]['name'] = $sub_rows[$sub_row]['name'];
                        $rows[$i]['uriage_yosan_kei'] = '';
                        $rows[$i]['uriage_yosan'] = number_format($sub_rows[$sub_row]['uriage_yosan']);
                        $rows[$i]['kaishibi'] = $sub_rows[$sub_row]['kaishibi'];
                        $rows[$i]['shuuryoubi'] = $sub_rows[$sub_row]['shuuryoubi'];
                        $rows[$i]['status'] = $sub_rows[$sub_row]['status'] === '0' ? '継続中' : '終了';
                        $rows[$i]['memo'] = $sub_rows[$sub_row]['memo'];
                        $i++;
                    }
                    $rows[$i]['id'] = $main_rows[$main_row]['id'];
                    $rows[$i]['sub_id'] = '';
                    $rows[$i]['sub_cd'] = '';
                    $rows[$i]['cd'] = $main_rows[$main_row]['cd'];
                    $rows[$i]['name'] = $main_rows[$main_row]['name'];
                    $rows[$i]['uriage_yosan_kei'] = '';
                    $rows[$i]['uriage_yosan'] = number_format($main_rows[$main_row]['uriage_yosan']);
                    $rows[$i]['kaishibi'] = $main_rows[$main_row]['kaishibi'];
                    $rows[$i]['shuuryoubi'] = $main_rows[$main_row]['shuuryoubi'];
                    $rows[$i]['status'] = $main_rows[$main_row]['status'] === '0' ? '継続中' : '終了';
                    $rows[$i]['memo'] = $main_rows[$main_row]['memo'];
                    $i++;
                }
            } else {
                $rows[$i]['id'] = $main_rows[$main_row]['id'];
                $rows[$i]['sub_id'] = '';
                $rows[$i]['sub_cd'] = '';
                $rows[$i]['cd'] = $main_rows[$main_row]['cd'];
                $rows[$i]['name'] = $main_rows[$main_row]['name'];
                $rows[$i]['uriage_yosan_kei'] = '';
                $rows[$i]['uriage_yosan'] = number_format($main_rows[$main_row]['uriage_yosan']);
                $rows[$i]['kaishibi'] = $main_rows[$main_row]['kaishibi'];
                $rows[$i]['shuuryoubi'] = $main_rows[$main_row]['shuuryoubi'];
                $rows[$i]['status'] = $main_rows[$main_row]['status'] === '0' ? '継続中' : '終了';
                $rows[$i]['memo'] = $main_rows[$main_row]['memo'];
                $i++;
            }

        }
        $this->view->rows = $rows;
    }

    /**
     * Searches for project_mrs
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * モーダル
     */
    public function modalAction()
    {
        ControllerBase::indexCd("ProjectMrs", "プロジェクト台帳");
    }

    /**
     * Edits a project_mr
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $project_mr = ProjectMrs::findFirstByid($id);
            if (!$project_mr) {
                $this->flash->error("プロジェクトが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "project_mrs",
                    'action' => 'index'
                ));

                return;
            }

            $this->view->id = $project_mr->id;

            $this->tag->setDefault("id", $project_mr->id);
            $this->tag->setDefault("cd", $project_mr->cd);
            $this->tag->setDefault("name", $project_mr->name);
            $this->tag->setDefault("uriage_yosan", $project_mr->uriage_yosan);
            $this->tag->setDefault("kaishibi", $project_mr->kaishibi);
            $this->tag->setDefault("shuuryoubi", $project_mr->shuuryoubi);
            $this->tag->setDefault("status", $project_mr->status);
            $this->tag->setDefault("memo", $project_mr->memo);
            $this->tag->setDefault("id_moto", $project_mr->id_moto);
            $this->tag->setDefault("hikae_dltflg", $project_mr->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $project_mr->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $project_mr->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $project_mr->sakusei_user_id);
            $this->tag->setDefault("created", $project_mr->created);
            $this->tag->setDefault("kousin_user_id", $project_mr->kousin_user_id);
            $this->tag->setDefault("updated", $project_mr->updated);
            
        }
    }

    /**
     * Creates a new project_mr
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "project_mrs",
                'action' => 'index'
            ));

            return;
        }

        $project_mr = new ProjectMrs();
        $post_flds = [
            "cd",
            "name",
            "uriage_yosan",
            "kaishibi",
            "shuuryoubi",
            "status",
            "memo",
            "updated",
        ];
        foreach ($post_flds as $post_fld) {
            $project_mr->$post_fld = $this->request->getPost($post_fld);
        }
        $post_flds['uriage_yosan'] = str_replace(',', '', $post_flds['uriage_yosan']);//カンマ除去
        if (!$project_mr->save()) {
            foreach ($project_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "project_mrs",
                'action' => 'new'
            ));

            return;
        }

        $this->flash->success("プロジェクトの作成が完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "project_mrs",
            'action' => 'edit',
            'params' => array($project_mr->id)
        ));
    }

    /**
     * Saves a project_mr edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array(
                'controller' => "project_mrs",
                'action' => 'index'
            ));

            return;
        }

        $id = $this->request->getPost("id");
        $project_mr = ProjectMrs::findFirstByid($id);

        if (!$project_mr) {
            $this->flash->error("プロジェクトが見つからなくなりました。" . $id);

            $this->dispatcher->forward(array(
                'controller' => "project_mrs",
                'action' => 'index'
            ));
            return;
        }

        $post_flds = [
            "cd",
            "name",
            "uriage_yosan",
            "kaishibi",
            "shuuryoubi",
            "status",
            "memo",
            "updated",
        ];
        $chg_flg = 0;
        foreach ($post_flds as $post_fld) {
            if ($project_mr->$post_fld != $this->request->getPost($post_fld)) {$chg_flg = 1; break;}
        }

        if ($chg_flg === 0) {
            $this->flash->error("変更がありません。" . $id);

            $this->dispatcher->forward(array(
                "controller" => "project_mrs",
                "action" => "edit",
                "params" => array($project_mr->id)
            ));

            return;
        }

        $this->_bakOut($project_mr);

        foreach ($post_flds as $post_fld) {
            $project_mr->$post_fld = $this->request->getPost($post_fld);
        }

        //$post_flds['uriage_yosan'] = str_replace(',', '', $post_flds['uriage_yosan']);//カンマ除去
        if (!$project_mr->save()) {

            foreach ($project_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "project_mrs",
                'action' => 'edit',
                'params' => array($id)
            ));

            return;
        }

        $this->flash->success("プロジェクトマスタの情報を更新しました。");

        $this->dispatcher->forward(array(
            'controller' => "project_mrs",
            'action' => 'edit',
            'params' => array($project_mr->id)
        ));
    }

    /**
     * Deletes a project_mr
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $project_mr = ProjectMrs::findFirstByid($id);
        if (!$project_mr) {
            $this->flash->error("プロジェクトマスタが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "project_mrs",
                'action' => 'index'
            ));

            return;
        }

        if (!$project_mr->delete()) {

            foreach ($project_mr->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array(
                'controller' => "project_mrs",
                'action' => 'search'
            ));

            return;
        }

        $this->_bakOut($project_mr, 1);

        $this->flash->success("プロジェクトマスタの削除を完了しました。");

        $this->dispatcher->forward(array(
            'controller' => "project_mrs",
            'action' => "index"
        ));
    }

    /**
     * Back Out a project_mr
     *
     * @param string $project_mr, $dlt_flg
     */
    public function _bakOut($project_mr, $dlt_flg = 0)
    {
        $bak_project_mr = new BakProjectMrs();
        foreach ($project_mr as $fld => $value) {
            $bak_project_mr->$fld = $project_mr->$fld;
        }
        $bak_project_mr->id = NULL;
        $bak_project_mr->id_moto = $project_mr->id;
        $bak_project_mr->hikae_dltflg = $dlt_flg;
        $bak_project_mr->hikae_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $bak_project_mr->hikae_nichiji = date("Y-m-d H:i:s");
        if (!$bak_project_mr->save()) {
            foreach ($bak_project_mr->getMessages() as $message) {
                $this->flash->error($message);
            }
        }
    }

    /*
     * プロジェクト実績一覧
     * 使用するかも分からないので、取り敢えず適当に作成 2019-11-29
     */
    public function summaryAction()
    {
        ini_set('display_errors', 'on');
        error_reporting(E_ALL|E_NOTICE);
        if (!$this->request->isPost()) {
            $kikan_from = date('Y-m-01');
            $kikan_to = date('Y-m-t');
        } else {
            $kikan_from = $this->request->getPost('kikan_from');
            $kikan_to = $this->request->getPost('kikan_to');
        }
        $db = \Phalcon\DI::getDefault()->get('db');
        $phql = "
            SELECT
                a.cd AS cd,
                a.name AS name,
                a.kaishibi AS kaishibi,
                a.shuuryoubi AS shuuryoubi,
                a.uriage_yosan AS yosan,
                SUM(b.zeinukigaku) AS junuriage,
                a.uriage_yosan - SUM(b.zeinukigaku)  AS sai,
                SUM(b.zeinukigaku) / a.uriage_yosan * 100 AS tasseiritsu,
                SUM(c.zeinukigaku) AS junshiire,
                SUM(b.zeinukigaku) - SUM(c.zeinukigaku) AS sagaku,
                (SUM(b.zeinukigaku) - SUM(c.zeinukigaku)) / SUM(b.zeinukigaku) * 100 AS riekiritsu
            FROM project_mrs AS a
            LEFT JOIN uriage_meisai_dts AS b ON b.project_mr_cd = a.cd
            LEFT JOIN uriage_dts AS d ON d.id = b.uriage_dt_id
            LEFT JOIN shiire_meisai_dts AS c ON c.project_mr_cd = a.cd
            LEFT JOIN shiire_dts AS e ON e.id = c.shiire_dt_id
            WHERE (d.uriagebi BETWEEN '{$kikan_from}' AND '{$kikan_to}') 
              OR (e.shiirebi BETWEEN '{$kikan_from}' AND '{$kikan_to}')
            GROUP BY a.cd,a.name,a.kaishibi,a.shuuryoubi,a.uriage_yosan
            ORDER BY a.cd
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        echo '<pre>', $phql, '</pre>';
        $this->view->rows = $rows;
    }
}
