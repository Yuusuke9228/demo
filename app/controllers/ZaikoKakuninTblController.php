<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ZaikoKakuninTblController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for zaiko_kakunin_tbl
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'ZaikoKakuninTbl', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "shouhin_mr_cd";

        $zaiko_kakunin_tbl = ZaikoKakuninTbl::find($parameters);
        if (count($zaiko_kakunin_tbl) == 0) {
            $this->flash->notice("The search did not find any zaiko_kakunin_tbl");

            $this->dispatcher->forward([
                "controller" => "zaiko_kakunin_tbl",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $zaiko_kakunin_tbl,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a zaiko_kakunin_tbl
     *
     * @param string $shouhin_mr_cd
     */
    public function editAction($shouhin_mr_cd)
    {
        if (!$this->request->isPost()) {

            $zaiko_kakunin_tbl = ZaikoKakuninTbl::findFirstByshouhin_mr_cd($shouhin_mr_cd);
            if (!$zaiko_kakunin_tbl) {
                $this->flash->error("zaiko_kakunin_tbl was not found");

                $this->dispatcher->forward([
                    'controller' => "zaiko_kakunin_tbl",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->shouhin_mr_cd = $zaiko_kakunin_tbl->shouhin_mr_cd;

            $this->tag->setDefault("shouhin_mr_cd", $zaiko_kakunin_tbl->shouhin_mr_cd);
            $this->tag->setDefault("tantou_mr_cd", $zaiko_kakunin_tbl->tantou_mr_cd);
            $this->tag->setDefault("tanni_mr1_cd", $zaiko_kakunin_tbl->tanni_mr1_cd);
            $this->tag->setDefault("tanni_mr2_cd", $zaiko_kakunin_tbl->tanni_mr2_cd);
            $this->tag->setDefault("iro", $zaiko_kakunin_tbl->iro);
            $this->tag->setDefault("iromei", $zaiko_kakunin_tbl->iromei);
            $this->tag->setDefault("lot", $zaiko_kakunin_tbl->lot);
            $this->tag->setDefault("kobetucd", $zaiko_kakunin_tbl->kobetucd);
            $this->tag->setDefault("hinsitu_kbn_cd", $zaiko_kakunin_tbl->hinsitu_kbn_cd);
            $this->tag->setDefault("hinsitu_hyouka_kbn_cd", $zaiko_kakunin_tbl->hinsitu_hyouka_kbn_cd);
            $this->tag->setDefault("souko_mr_cd", $zaiko_kakunin_tbl->souko_mr_cd);
            $this->tag->setDefault("nyuukobis", $zaiko_kakunin_tbl->nyuukobis);
            $this->tag->setDefault("shukkobis", $zaiko_kakunin_tbl->shukkobis);
            $this->tag->setDefault("nyuushukkobi", $zaiko_kakunin_tbl->nyuushukkobi);
            $this->tag->setDefault("nyuushukkoym", $zaiko_kakunin_tbl->nyuushukkoym);
            $this->tag->setDefault("denpyou_mr_cd", $zaiko_kakunin_tbl->denpyou_mr_cd);
            $this->tag->setDefault("id", $zaiko_kakunin_tbl->id);
            $this->tag->setDefault("cd", $zaiko_kakunin_tbl->cd);
            $this->tag->setDefault("meisai_id", $zaiko_kakunin_tbl->meisai_id);
            $this->tag->setDefault("meisai_cd", $zaiko_kakunin_tbl->meisai_cd);
            $this->tag->setDefault("utiwake_kbn_cd", $zaiko_kakunin_tbl->utiwake_kbn_cd);
            $this->tag->setDefault("torihikisaki_cd", $zaiko_kakunin_tbl->torihikisaki_cd);
            $this->tag->setDefault("bikou", $zaiko_kakunin_tbl->bikou);
            $this->tag->setDefault("zaiko_ryou1s", $zaiko_kakunin_tbl->zaiko_ryou1s);
            $this->tag->setDefault("zaiko_ryou2s", $zaiko_kakunin_tbl->zaiko_ryou2s);
            $this->tag->setDefault("tanka_tanni_mr_cd", $zaiko_kakunin_tbl->tanka_tanni_mr_cd);
            $this->tag->setDefault("shiirebi_tankas", $zaiko_kakunin_tbl->shiirebi_tankas);
            $this->tag->setDefault("shiire_gakus", $zaiko_kakunin_tbl->shiire_gakus);
            $this->tag->setDefault("shiire_ryou1s", $zaiko_kakunin_tbl->shiire_ryou1s);
            $this->tag->setDefault("shiire_ryou2s", $zaiko_kakunin_tbl->shiire_ryou2s);
            $this->tag->setDefault("hokanyuuko_ryou1s", $zaiko_kakunin_tbl->hokanyuuko_ryou1s);
            $this->tag->setDefault("hokanyuuko_ryou2s", $zaiko_kakunin_tbl->hokanyuuko_ryou2s);
            $this->tag->setDefault("uriage_ryou1s", $zaiko_kakunin_tbl->uriage_ryou1s);
            $this->tag->setDefault("uriage_ryou2s", $zaiko_kakunin_tbl->uriage_ryou2s);
            $this->tag->setDefault("hokashukko_ryou1s", $zaiko_kakunin_tbl->hokashukko_ryou1s);
            $this->tag->setDefault("hokashukko_ryou2s", $zaiko_kakunin_tbl->hokashukko_ryou2s);
            $this->tag->setDefault("shiiresaki_mr_cd", $zaiko_kakunin_tbl->shiiresaki_mr_cd);
            $this->tag->setDefault("tokuisaki_mr_cd", $zaiko_kakunin_tbl->tokuisaki_mr_cd);
            $this->tag->setDefault("nounyuu_kijitu", $zaiko_kakunin_tbl->nounyuu_kijitu);
            $this->tag->setDefault("nouki", $zaiko_kakunin_tbl->nouki);
            $this->tag->setDefault("hacchuu_dt_id", $zaiko_kakunin_tbl->hacchuu_dt_id);
            $this->tag->setDefault("juchuu_dt_id", $zaiko_kakunin_tbl->juchuu_dt_id);
            $this->tag->setDefault("hacchuuzan_ryou1", $zaiko_kakunin_tbl->hacchuuzan_ryou1);
            $this->tag->setDefault("hacchuuzan_ryou2", $zaiko_kakunin_tbl->hacchuuzan_ryou2);
            $this->tag->setDefault("juchuuzan_ryou1", $zaiko_kakunin_tbl->juchuuzan_ryou1);
            $this->tag->setDefault("juchuuzan_ryou2", $zaiko_kakunin_tbl->juchuuzan_ryou2);
            $this->tag->setDefault("azukari_zan1s", $zaiko_kakunin_tbl->azukari_zan1s);
            $this->tag->setDefault("azukari_zan2s", $zaiko_kakunin_tbl->azukari_zan2s);
            $this->tag->setDefault("azukari_tasi1s", $zaiko_kakunin_tbl->azukari_tasi1s);
            $this->tag->setDefault("azukari_tasi2s", $zaiko_kakunin_tbl->azukari_tasi2s);
            $this->tag->setDefault("azukari_hiki1s", $zaiko_kakunin_tbl->azukari_hiki1s);
            $this->tag->setDefault("azukari_hiki2s", $zaiko_kakunin_tbl->azukari_hiki2s);
            $this->tag->setDefault("kousin_user_id", $zaiko_kakunin_tbl->kousin_user_id);
            $this->tag->setDefault("updated", $zaiko_kakunin_tbl->updated);
            $this->tag->setDefault("sakusei_user_id", $zaiko_kakunin_tbl->sakusei_user_id);
            $this->tag->setDefault("created", $zaiko_kakunin_tbl->created);
            
        }
    }

    /**
     * Creates a new zaiko_kakunin_tbl
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "zaiko_kakunin_tbl",
                'action' => 'index'
            ]);

            return;
        }

        $zaiko_kakunin_tbl = new ZaikoKakuninTbl();
        $zaiko_kakunin_tbl->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $zaiko_kakunin_tbl->tantouMrCd = $this->request->getPost("tantou_mr_cd");
        $zaiko_kakunin_tbl->tanniMr1Cd = $this->request->getPost("tanni_mr1_cd");
        $zaiko_kakunin_tbl->tanniMr2Cd = $this->request->getPost("tanni_mr2_cd");
        $zaiko_kakunin_tbl->iro = $this->request->getPost("iro");
        $zaiko_kakunin_tbl->iromei = $this->request->getPost("iromei");
        $zaiko_kakunin_tbl->lot = $this->request->getPost("lot");
        $zaiko_kakunin_tbl->kobetucd = $this->request->getPost("kobetucd");
        $zaiko_kakunin_tbl->hinsituKbnCd = $this->request->getPost("hinsitu_kbn_cd");
        $zaiko_kakunin_tbl->hinsituHyoukaKbnCd = $this->request->getPost("hinsitu_hyouka_kbn_cd");
        $zaiko_kakunin_tbl->soukoMrCd = $this->request->getPost("souko_mr_cd");
        $zaiko_kakunin_tbl->nyuukobis = $this->request->getPost("nyuukobis");
        $zaiko_kakunin_tbl->shukkobis = $this->request->getPost("shukkobis");
        $zaiko_kakunin_tbl->nyuushukkobi = $this->request->getPost("nyuushukkobi");
        $zaiko_kakunin_tbl->nyuushukkoym = $this->request->getPost("nyuushukkoym");
        $zaiko_kakunin_tbl->denpyouMrCd = $this->request->getPost("denpyou_mr_cd");
        $zaiko_kakunin_tbl->id = $this->request->getPost("id");
        $zaiko_kakunin_tbl->cd = $this->request->getPost("cd");
        $zaiko_kakunin_tbl->meisaiId = $this->request->getPost("meisai_id");
        $zaiko_kakunin_tbl->meisaiCd = $this->request->getPost("meisai_cd");
        $zaiko_kakunin_tbl->utiwakeKbnCd = $this->request->getPost("utiwake_kbn_cd");
        $zaiko_kakunin_tbl->torihikisakiCd = $this->request->getPost("torihikisaki_cd");
        $zaiko_kakunin_tbl->bikou = $this->request->getPost("bikou");
        $zaiko_kakunin_tbl->zaikoRyou1s = $this->request->getPost("zaiko_ryou1s");
        $zaiko_kakunin_tbl->zaikoRyou2s = $this->request->getPost("zaiko_ryou2s");
        $zaiko_kakunin_tbl->tankaTanniMrCd = $this->request->getPost("tanka_tanni_mr_cd");
        $zaiko_kakunin_tbl->shiirebiTankas = $this->request->getPost("shiirebi_tankas");
        $zaiko_kakunin_tbl->shiireGakus = $this->request->getPost("shiire_gakus");
        $zaiko_kakunin_tbl->shiireRyou1s = $this->request->getPost("shiire_ryou1s");
        $zaiko_kakunin_tbl->shiireRyou2s = $this->request->getPost("shiire_ryou2s");
        $zaiko_kakunin_tbl->hokanyuukoRyou1s = $this->request->getPost("hokanyuuko_ryou1s");
        $zaiko_kakunin_tbl->hokanyuukoRyou2s = $this->request->getPost("hokanyuuko_ryou2s");
        $zaiko_kakunin_tbl->uriageRyou1s = $this->request->getPost("uriage_ryou1s");
        $zaiko_kakunin_tbl->uriageRyou2s = $this->request->getPost("uriage_ryou2s");
        $zaiko_kakunin_tbl->hokashukkoRyou1s = $this->request->getPost("hokashukko_ryou1s");
        $zaiko_kakunin_tbl->hokashukkoRyou2s = $this->request->getPost("hokashukko_ryou2s");
        $zaiko_kakunin_tbl->shiiresakiMrCd = $this->request->getPost("shiiresaki_mr_cd");
        $zaiko_kakunin_tbl->tokuisakiMrCd = $this->request->getPost("tokuisaki_mr_cd");
        $zaiko_kakunin_tbl->nounyuuKijitu = $this->request->getPost("nounyuu_kijitu");
        $zaiko_kakunin_tbl->nouki = $this->request->getPost("nouki");
        $zaiko_kakunin_tbl->hacchuuDtId = $this->request->getPost("hacchuu_dt_id");
        $zaiko_kakunin_tbl->juchuuDtId = $this->request->getPost("juchuu_dt_id");
        $zaiko_kakunin_tbl->hacchuuzanRyou1 = $this->request->getPost("hacchuuzan_ryou1");
        $zaiko_kakunin_tbl->hacchuuzanRyou2 = $this->request->getPost("hacchuuzan_ryou2");
        $zaiko_kakunin_tbl->juchuuzanRyou1 = $this->request->getPost("juchuuzan_ryou1");
        $zaiko_kakunin_tbl->juchuuzanRyou2 = $this->request->getPost("juchuuzan_ryou2");
        $zaiko_kakunin_tbl->azukariZan1s = $this->request->getPost("azukari_zan1s");
        $zaiko_kakunin_tbl->azukariZan2s = $this->request->getPost("azukari_zan2s");
        $zaiko_kakunin_tbl->azukariTasi1s = $this->request->getPost("azukari_tasi1s");
        $zaiko_kakunin_tbl->azukariTasi2s = $this->request->getPost("azukari_tasi2s");
        $zaiko_kakunin_tbl->azukariHiki1s = $this->request->getPost("azukari_hiki1s");
        $zaiko_kakunin_tbl->azukariHiki2s = $this->request->getPost("azukari_hiki2s");
        $zaiko_kakunin_tbl->kousinUserId = $this->request->getPost("kousin_user_id");
        $zaiko_kakunin_tbl->updated = $this->request->getPost("updated");
        $zaiko_kakunin_tbl->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $zaiko_kakunin_tbl->created = $this->request->getPost("created");
        

        if (!$zaiko_kakunin_tbl->save()) {
            foreach ($zaiko_kakunin_tbl->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "zaiko_kakunin_tbl",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("zaiko_kakunin_tbl was created successfully");

        $this->dispatcher->forward([
            'controller' => "zaiko_kakunin_tbl",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a zaiko_kakunin_tbl edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "zaiko_kakunin_tbl",
                'action' => 'index'
            ]);

            return;
        }

        $shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $zaiko_kakunin_tbl = ZaikoKakuninTbl::findFirstByshouhin_mr_cd($shouhin_mr_cd);

        if (!$zaiko_kakunin_tbl) {
            $this->flash->error("zaiko_kakunin_tbl does not exist " . $shouhin_mr_cd);

            $this->dispatcher->forward([
                'controller' => "zaiko_kakunin_tbl",
                'action' => 'index'
            ]);

            return;
        }

        $zaiko_kakunin_tbl->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $zaiko_kakunin_tbl->tantouMrCd = $this->request->getPost("tantou_mr_cd");
        $zaiko_kakunin_tbl->tanniMr1Cd = $this->request->getPost("tanni_mr1_cd");
        $zaiko_kakunin_tbl->tanniMr2Cd = $this->request->getPost("tanni_mr2_cd");
        $zaiko_kakunin_tbl->iro = $this->request->getPost("iro");
        $zaiko_kakunin_tbl->iromei = $this->request->getPost("iromei");
        $zaiko_kakunin_tbl->lot = $this->request->getPost("lot");
        $zaiko_kakunin_tbl->kobetucd = $this->request->getPost("kobetucd");
        $zaiko_kakunin_tbl->hinsituKbnCd = $this->request->getPost("hinsitu_kbn_cd");
        $zaiko_kakunin_tbl->hinsituHyoukaKbnCd = $this->request->getPost("hinsitu_hyouka_kbn_cd");
        $zaiko_kakunin_tbl->soukoMrCd = $this->request->getPost("souko_mr_cd");
        $zaiko_kakunin_tbl->nyuukobis = $this->request->getPost("nyuukobis");
        $zaiko_kakunin_tbl->shukkobis = $this->request->getPost("shukkobis");
        $zaiko_kakunin_tbl->nyuushukkobi = $this->request->getPost("nyuushukkobi");
        $zaiko_kakunin_tbl->nyuushukkoym = $this->request->getPost("nyuushukkoym");
        $zaiko_kakunin_tbl->denpyouMrCd = $this->request->getPost("denpyou_mr_cd");
        $zaiko_kakunin_tbl->id = $this->request->getPost("id");
        $zaiko_kakunin_tbl->cd = $this->request->getPost("cd");
        $zaiko_kakunin_tbl->meisaiId = $this->request->getPost("meisai_id");
        $zaiko_kakunin_tbl->meisaiCd = $this->request->getPost("meisai_cd");
        $zaiko_kakunin_tbl->utiwakeKbnCd = $this->request->getPost("utiwake_kbn_cd");
        $zaiko_kakunin_tbl->torihikisakiCd = $this->request->getPost("torihikisaki_cd");
        $zaiko_kakunin_tbl->bikou = $this->request->getPost("bikou");
        $zaiko_kakunin_tbl->zaikoRyou1s = $this->request->getPost("zaiko_ryou1s");
        $zaiko_kakunin_tbl->zaikoRyou2s = $this->request->getPost("zaiko_ryou2s");
        $zaiko_kakunin_tbl->tankaTanniMrCd = $this->request->getPost("tanka_tanni_mr_cd");
        $zaiko_kakunin_tbl->shiirebiTankas = $this->request->getPost("shiirebi_tankas");
        $zaiko_kakunin_tbl->shiireGakus = $this->request->getPost("shiire_gakus");
        $zaiko_kakunin_tbl->shiireRyou1s = $this->request->getPost("shiire_ryou1s");
        $zaiko_kakunin_tbl->shiireRyou2s = $this->request->getPost("shiire_ryou2s");
        $zaiko_kakunin_tbl->hokanyuukoRyou1s = $this->request->getPost("hokanyuuko_ryou1s");
        $zaiko_kakunin_tbl->hokanyuukoRyou2s = $this->request->getPost("hokanyuuko_ryou2s");
        $zaiko_kakunin_tbl->uriageRyou1s = $this->request->getPost("uriage_ryou1s");
        $zaiko_kakunin_tbl->uriageRyou2s = $this->request->getPost("uriage_ryou2s");
        $zaiko_kakunin_tbl->hokashukkoRyou1s = $this->request->getPost("hokashukko_ryou1s");
        $zaiko_kakunin_tbl->hokashukkoRyou2s = $this->request->getPost("hokashukko_ryou2s");
        $zaiko_kakunin_tbl->shiiresakiMrCd = $this->request->getPost("shiiresaki_mr_cd");
        $zaiko_kakunin_tbl->tokuisakiMrCd = $this->request->getPost("tokuisaki_mr_cd");
        $zaiko_kakunin_tbl->nounyuuKijitu = $this->request->getPost("nounyuu_kijitu");
        $zaiko_kakunin_tbl->nouki = $this->request->getPost("nouki");
        $zaiko_kakunin_tbl->hacchuuDtId = $this->request->getPost("hacchuu_dt_id");
        $zaiko_kakunin_tbl->juchuuDtId = $this->request->getPost("juchuu_dt_id");
        $zaiko_kakunin_tbl->hacchuuzanRyou1 = $this->request->getPost("hacchuuzan_ryou1");
        $zaiko_kakunin_tbl->hacchuuzanRyou2 = $this->request->getPost("hacchuuzan_ryou2");
        $zaiko_kakunin_tbl->juchuuzanRyou1 = $this->request->getPost("juchuuzan_ryou1");
        $zaiko_kakunin_tbl->juchuuzanRyou2 = $this->request->getPost("juchuuzan_ryou2");
        $zaiko_kakunin_tbl->azukariZan1s = $this->request->getPost("azukari_zan1s");
        $zaiko_kakunin_tbl->azukariZan2s = $this->request->getPost("azukari_zan2s");
        $zaiko_kakunin_tbl->azukariTasi1s = $this->request->getPost("azukari_tasi1s");
        $zaiko_kakunin_tbl->azukariTasi2s = $this->request->getPost("azukari_tasi2s");
        $zaiko_kakunin_tbl->azukariHiki1s = $this->request->getPost("azukari_hiki1s");
        $zaiko_kakunin_tbl->azukariHiki2s = $this->request->getPost("azukari_hiki2s");
        $zaiko_kakunin_tbl->kousinUserId = $this->request->getPost("kousin_user_id");
        $zaiko_kakunin_tbl->updated = $this->request->getPost("updated");
        $zaiko_kakunin_tbl->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $zaiko_kakunin_tbl->created = $this->request->getPost("created");
        

        if (!$zaiko_kakunin_tbl->save()) {

            foreach ($zaiko_kakunin_tbl->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "zaiko_kakunin_tbl",
                'action' => 'edit',
                'params' => [$zaiko_kakunin_tbl->shouhin_mr_cd]
            ]);

            return;
        }

        $this->flash->success("zaiko_kakunin_tbl was updated successfully");

        $this->dispatcher->forward([
            'controller' => "zaiko_kakunin_tbl",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a zaiko_kakunin_tbl
     *
     * @param string $shouhin_mr_cd
     */
    public function deleteAction($shouhin_mr_cd)
    {
        $zaiko_kakunin_tbl = ZaikoKakuninTbl::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$zaiko_kakunin_tbl) {
            $this->flash->error("zaiko_kakunin_tbl was not found");

            $this->dispatcher->forward([
                'controller' => "zaiko_kakunin_tbl",
                'action' => 'index'
            ]);

            return;
        }

        if (!$zaiko_kakunin_tbl->delete()) {

            foreach ($zaiko_kakunin_tbl->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "zaiko_kakunin_tbl",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("zaiko_kakunin_tbl was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "zaiko_kakunin_tbl",
            'action' => "index"
        ]);
    }

}
