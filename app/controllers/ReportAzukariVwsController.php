<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Model\Criteria;

class ReportAzukariVwsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        ControllerBase::indexCd("ReportAzukariVws", "預り残", "shouhin_mr_cd"); //簡易検索付き一覧表示
    }

    /**
     * Searches for report_azukari_vws
     */
    public function searchAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Displays the creation form
     */
    public function newAction($id = null, $dataname = "ReportAzukariVws")
    {
        $this->view->imax = 0;

        if ($id) {
            $nameDts = $dataname;
            $report_azukari_vw = $nameDts::findFirstByid($id);
            if (!$report_azukari_vw) {
                $this->flash->error("VIEWが見つからなくなりました。");

                $this->dispatcher->forward(array(
                    'controller' => "report_azukari_vws",
                    'action' => 'index'
                ));

                return;
            }
            $this->_setDefault($report_azukari_vw, "new", $dataname);
            $this->tag->setDefault("shouhin_mr_cd", null);
            $this->tag->setDefault("cd", null);
        }

    }

    /**
     * 修正画面から「次へ」ボタンを押したら次のコードの修正画面になる。
     */
    public function nextAction($id)
    {
        ControllerBase::nextCd($id, "report_azukari_vws", "ReportAzukariVws", "VIEW");
    }

    /**
     * 修正画面から「前へ」ボタンを押したら前のコードの修正画面になる。
     */
    public function prevAction($id)
    {
        ControllerBase::prevCd($id, "report_azukari_vws", "ReportAzukariVws", "VIEW");
    }

    /**
     * Edits a report_azukari_vw
     *
     * @param string $shouhin_mr_cd
     */
    public function editAction($shouhin_mr_cd)
    {
//        if (!$this->request->isPost()) {

        $report_azukari_vw = ReportAzukariVws::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$report_azukari_vw) {
            $this->flash->error("VIEWが見つからなくなりました。");

            $this->dispatcher->forward(array(
                'controller' => "report_azukari_vws",
                'action' => 'index'
            ));

            return;
        }

        $this->view->shouhin_mr_cd = $report_azukari_vw->shouhin_mr_cd;

        $this->_setDefault($report_azukari_vw, "edit");
//        }
    }

    /**
     * 画面に表示するデータをセットする
     */
    public function _setDefault($report_azukari_vw, $action = "edit", $meisai = "ReportAzukariVws")
    {
        $setdts = ["shouhin_mr_cd",
            "tantou_mr_cd",
            "tanni_mr_cd",
            "lot",
            "kobetucd",
            "zaiko_ryous",
            "nyuuko_ryous",
            "shukko_ryous",
            "nyuukobis",
            "shukkobis",
            "nyuushukkobi",
            "nyuushukkoym",
            "denpyou_mr_cd",
            "oya_id",
            "oya_cd",
            "gyou_cd",
            "utiwake_kbn_cd",
            "torihikisaki_cd",
            "bikou",
        ];

        foreach ($setdts as $setdt) {
            if (property_exists($report_azukari_vw, $setdt)) {
                $this->tag->setDefault($setdt, $report_azukari_vw->$setdt);
            }
        }
    }

    /**
     * 集計 action
     */
    public function summaryAction()
    {
        $TableId = 'ReportAzukariVws';
        $table_name = '預り残';
        $orgkey = "shouhin_mr_cd";
        $numberPage = 1;
        $sort = $orgkey;
        $order = "ASC";
        $wherecd = "";
        $addlimit = ""; // postからの場合TableSortの機能ではlimitを付加してくれないため、自前で付加する。→view\common\indexsort.phtml
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, $TableId, $_POST);
            $this->persistent->parameters = $query->getParams();
            $pagelimit = $this->request->getPost("pagelimit");
            if ($pagelimit !== 10) {
                $addlimit = "&limit=" . $pagelimit;
            }
        } else {
            $sort = $this->request->getQuery("sort") ?? $sort;
            $sort .= ' ' . $this->request->getQuery("order") ?? $order;
            $numberPage = $this->request->getQuery("page", "int");
            $wherecd = $this->request->getQuery($orgkey);
            $pagelimit = $this->request->getQuery("limit", "int");
        }
        if (!$pagelimit) {
            $pagelimit = 10;
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = $sort;

        if ($wherecd) { /* 現在のコードのページを開く */
            $criteria1 = $TableId::query();
            $criteria1->columns([
                "shouhin_mr_cd",
                "torihikisaki_cd",
            ]);
            $criteria1->where("shouhin_mr_cd < ?0", [0 => $wherecd]);
            $criteria1->groupBy("shouhin_mr_cd,torihikisaki_cd");
            $tblrows1 = $criteria1->execute();
            $numberPage = count($tblrows1) / $pagelimit + 1;
        }
        $criteria = $TableId::query();
        $criteria->columns([
            "shouhin_mr_cd",
            "j1.name AS shouhin_name",
            "torihikisaki_cd",
            "SUM(zaiko_ryous) AS zaiko_ryou",
            "SUM(nyuuko_ryous) AS nyuuko_ryou",
            "SUM(shukko_ryous) AS shukko_ryou",
            "MAX(nyuukobis) AS nyuukobi",
            "MAX(shukkobis) AS shukkobi",
            "MAX(nyuushukkobi) AS nyuushukkobi",
        ]);
        $criteria->where($parameters["conditions"], $parameters["bind"]);
        $criteria->groupBy("shouhin_mr_cd,torihikisaki_cd");
        $criteria->orderBy($sort);
        $criteria->innerJoin("ShouhinMrs", "j1.cd = shouhin_mr_cd", "j1");
        $tblrows = $criteria->execute();
        if (count($tblrows) == 0) {
            $this->flash->notice("検索の結果、" . $table_name . "は０件でした。");
        }

        $this->view->parasort = $this->request->getQuery("sort") ? '&sort=' . $this->request->getQuery("sort") : '';
        $this->view->parasort .= $this->request->getQuery("order") ? '&order=' . $this->request->getQuery("order") : '';
        $this->view->parasort .= $pagelimit !== 10 ? '&limit=' . $pagelimit : '';
        $this->view->addlimit = $addlimit;

        $paginator = new Paginator(array(
            'data' => $tblrows,
            'limit' => $pagelimit,
            'page' => $numberPage
        ));
        $this->view->page = $paginator->getPaginate();
        $this->tag->setDefault("pagelimit", $pagelimit);
    }

    /**
     * 集計 action
     */
    public function azukariAction()
    {
        $numberPage = 1;
        $sort = "torihikisaki1_cd, shouhin_mr_cd ";
        /*
                $order = "ASC";
                $wherecd = "";
                $addlimit = ""; // postからの場合TableSortの機能ではlimitを付加してくれないため、自前で付加する。→view\common\indexsort.phtml
                if ($this->request->isPost()) {
                    $query = Criteria::fromInput($this->di, $TableId, $_POST);
                    $this->persistent->parameters = $query->getParams();
                    $pagelimit = $this->request->getPost("pagelimit");
                    $simebi = $this->request->getPost("simebi");

                    if ($pagelimit !== 10) {$addlimit = "&limit=".$pagelimit;}

                } else {
                    $sort = $this->request->getQuery("sort") ?? $sort;
                    $sort .= ' ' . $this->request->getQuery("order") ?? $order;
                    $numberPage = $this->request->getQuery("page", "int");
                    $wherecd = $this->request->getQuery($orgkey);
                    $pagelimit = $this->request->getQuery("limit", "int");
                    $simebi = $this->request->getQuery("date");
                }
                if (!$pagelimit) {$pagelimit = 10;}
                if (!$simebi) {$simebi = date("Y-m-d");}
                $parameters = $this->persistent->parameters;
                if ($this->request->getPost("torihikisaki_name")) {
                    $parameters["bind"]["torihikisaki_name"]="%".$this->request->getPost("torihikisaki_name")."%";
                }
                if ($this->request->getPost("shouhin_name")) {
                    $parameters["bind"]["shouhin_name"]="%".$this->request->getPost("shouhin_name")."%";
                }
                if ($this->request->getPost("simebi")) {
                    $parameters["bind"]["simebi"]=" <= ".$simebi;
                }
                if (!is_array($parameters)) {
                    $parameters = array();
                }
                $parameters["order"] = $sort;
                $parameters["conditions"] = $conditions;
        */
        /* * デバッグ
         echo "<pre>";
         var_dump($parameters);
         echo "</pre>";
         return;
        */
        /*
                if ($parameters["bind"]) {
                    foreach ($parameters["bind"] as $whkey=>$whval) {
                        $whkey1 = $whkey=='torihikisaki_name'?'p1b.name':$whkey;
                        $whkey1 = $whkey1=='shouhin_name'?'p1a.name':$whkey1;
                        $whkey1 = $whkey1=='simebi'?'nyuushukkobi':$whkey1;
                        $criteria->andWhere($whkey1.($whkey=='simebi'?" <= :":" LIKE :").$whkey.":");
                    }
                    $criteria->bind($parameters["bind"]);
                }
                $criteria->orderBy($sort);
                $criteria->groupBy($group);
                $criteria->leftJoin('ShouhinMrs', 'p1a.cd = shouhin_mr_cd', 'p1a');
                $criteria->leftJoin('TokuisakiMrs', 'p1b.cd = torihikisaki_cd', 'p1b');
                $criteria->leftJoin('TanniMrs', 'p1c.cd = if(p1a.tanka_kbn=1,p1a.tanni_mr1_cd,p1a.tanni_mr2_cd)', 'p1c');
                $criteria->columns($columns);
                $tblrows = $criteria->execute();

                if (count($tblrows) == 0) {
                    $this->flash->notice("検索の結果、".$table_name."は0件でした。");
                }
        */
        $di = \Phalcon\DI::getDefault();
        $mgr = $di->get('modelsManager');
        $phql = "
			SELECT
				if(a.denpyou_mr_cd='shiire',c.tokuisaki_mr_cd,a.torihikisaki_cd) as torihikisaki1_cd,
				if(a.denpyou_mr_cd='shiire',c.name,b.name) as torihikisaki_name,
				a.shouhin_mr_cd,
				d.name as shouhin_name,
				SUM(if(d.tanka_kbn=1,a.azukari_zan1s,a.azukari_zan2s)) as azukari_zan,
				if(d.tanka_kbn=1,e.name,f.name) as tanni_name
			FROM ZaikoKakuninAzukariVws AS a
			LEFT JOIN TokuisakiMrs AS b ON b.cd = a.torihikisaki_cd
			LEFT JOIN ShiiresakiMrs AS c ON c.cd = a.torihikisaki_cd
			LEFT JOIN ShouhinMrs AS d ON d.cd = a.shouhin_mr_cd
			LEFT JOIN TanniMrs AS e ON e.cd = d.tanni_mr1_cd
			LEFT JOIN TanniMrs AS f ON f.cd = d.tanni_mr2_cd
			WHERE (a.azukari_zan1s<>0 or a.azukari_zan2s<>0)
			GROUP BY torihikisaki1_cd, a.shouhin_mr_cd
			ORDER BY torihikisaki1_cd, shouhin_mr_cd
		";
        $rows = $mgr->executeQuery($phql, []);
        $this->view->rows = $rows;

        /*
                $this->view->parasort = $this->request->getQuery("sort") ?'&sort='.$this->request->getQuery("sort"): '';
                $this->view->parasort .= $this->request->getQuery("order") ?'&order='.$this->request->getQuery("order"): '';
                $this->view->parasort .= $pagelimit !== 10 ?'&limit='.$pagelimit: '';
                $this->view->parasort .= '&date='.$simebi;
                $this->view->addlimit = $addlimit;

                $paginator = new Paginator(array(
                    'data' => $tblrows,
                    'limit'=> $pagelimit,
                    'page' => $numberPage
                ));
                $this->view->page = $paginator->getPaginate();
                $this->tag->setDefault("pagelimit", $pagelimit);
                $this->tag->setDefault("simebi", $simebi);
        */
    }

}
