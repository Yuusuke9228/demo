<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TestZaikoShimeController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for test_zaiko_shime
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'TestZaikoShime', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "shouhin_mr_cd";

        $test_zaiko_shime = TestZaikoShime::find($parameters);
        if (count($test_zaiko_shime) == 0) {
            $this->flash->notice("The search did not find any test_zaiko_shime");

            $this->dispatcher->forward([
                "controller" => "test_zaiko_shime",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $test_zaiko_shime,
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
     * Edits a test_zaiko_shime
     *
     * @param string $shouhin_mr_cd
     */
    public function editAction($shouhin_mr_cd)
    {
        if (!$this->request->isPost()) {

            $test_zaiko_shime = TestZaikoShime::findFirstByshouhin_mr_cd($shouhin_mr_cd);
            if (!$test_zaiko_shime) {
                $this->flash->error("test_zaiko_shime was not found");

                $this->dispatcher->forward([
                    'controller' => "test_zaiko_shime",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->shouhin_mr_cd = $test_zaiko_shime->shouhin_mr_cd;

            $this->tag->setDefault("shouhin_mr_cd", $test_zaiko_shime->shouhin_mr_cd);
            $this->tag->setDefault("tantou_mr_cd", $test_zaiko_shime->tantou_mr_cd);
            $this->tag->setDefault("tanni_mr1_cd", $test_zaiko_shime->tanni_mr1_cd);
            $this->tag->setDefault("tanni_mr2_cd", $test_zaiko_shime->tanni_mr2_cd);
            $this->tag->setDefault("iro", $test_zaiko_shime->iro);
            $this->tag->setDefault("iromei", $test_zaiko_shime->iromei);
            $this->tag->setDefault("lot", $test_zaiko_shime->lot);
            $this->tag->setDefault("kobetucd", $test_zaiko_shime->kobetucd);
            $this->tag->setDefault("hinsitu_kbn_cd", $test_zaiko_shime->hinsitu_kbn_cd);
            $this->tag->setDefault("hinsitu_hyouka_kbn_cd", $test_zaiko_shime->hinsitu_hyouka_kbn_cd);
            $this->tag->setDefault("souko_mr_cd", $test_zaiko_shime->souko_mr_cd);
            $this->tag->setDefault("nyuukobis", $test_zaiko_shime->nyuukobis);
            $this->tag->setDefault("shukkobis", $test_zaiko_shime->shukkobis);
            $this->tag->setDefault("nyuushukkobi", $test_zaiko_shime->nyuushukkobi);
            $this->tag->setDefault("nyuushukkoym", $test_zaiko_shime->nyuushukkoym);
            $this->tag->setDefault("denpyou_mr_cd", $test_zaiko_shime->denpyou_mr_cd);
            $this->tag->setDefault("id", $test_zaiko_shime->id);
            $this->tag->setDefault("cd", $test_zaiko_shime->cd);
            $this->tag->setDefault("meisai_id", $test_zaiko_shime->meisai_id);
            $this->tag->setDefault("meisai_cd", $test_zaiko_shime->meisai_cd);
            $this->tag->setDefault("utiwake_kbn_cd", $test_zaiko_shime->utiwake_kbn_cd);
            $this->tag->setDefault("torihikisaki_cd", $test_zaiko_shime->torihikisaki_cd);
            $this->tag->setDefault("bikou", $test_zaiko_shime->bikou);
            $this->tag->setDefault("zaiko_ryou1s", $test_zaiko_shime->zaiko_ryou1s);
            $this->tag->setDefault("zaiko_ryou2s", $test_zaiko_shime->zaiko_ryou2s);
            $this->tag->setDefault("tanka_tanni_mr_cd", $test_zaiko_shime->tanka_tanni_mr_cd);
            $this->tag->setDefault("shiirebi_tankas", $test_zaiko_shime->shiirebi_tankas);
            $this->tag->setDefault("shiire_gakus", $test_zaiko_shime->shiire_gakus);
            $this->tag->setDefault("shiire_ryou1s", $test_zaiko_shime->shiire_ryou1s);
            $this->tag->setDefault("shiire_ryou2s", $test_zaiko_shime->shiire_ryou2s);
            $this->tag->setDefault("hokanyuuko_ryou1s", $test_zaiko_shime->hokanyuuko_ryou1s);
            $this->tag->setDefault("hokanyuuko_ryou2s", $test_zaiko_shime->hokanyuuko_ryou2s);
            $this->tag->setDefault("uriage_ryou1s", $test_zaiko_shime->uriage_ryou1s);
            $this->tag->setDefault("uriage_ryou2s", $test_zaiko_shime->uriage_ryou2s);
            $this->tag->setDefault("hokashukko_ryou1s", $test_zaiko_shime->hokashukko_ryou1s);
            $this->tag->setDefault("hokashukko_ryou2s", $test_zaiko_shime->hokashukko_ryou2s);
            $this->tag->setDefault("shiiresaki_mr_cd", $test_zaiko_shime->shiiresaki_mr_cd);
            $this->tag->setDefault("tokuisaki_mr_cd", $test_zaiko_shime->tokuisaki_mr_cd);
            $this->tag->setDefault("nounyuu_kijitu", $test_zaiko_shime->nounyuu_kijitu);
            $this->tag->setDefault("nouki", $test_zaiko_shime->nouki);
            $this->tag->setDefault("hacchuu_dt_id", $test_zaiko_shime->hacchuu_dt_id);
            $this->tag->setDefault("juchuu_dt_id", $test_zaiko_shime->juchuu_dt_id);
            $this->tag->setDefault("hacchuuzan_ryou1", $test_zaiko_shime->hacchuuzan_ryou1);
            $this->tag->setDefault("hacchuuzan_ryou2", $test_zaiko_shime->hacchuuzan_ryou2);
            $this->tag->setDefault("juchuuzan_ryou1", $test_zaiko_shime->juchuuzan_ryou1);
            $this->tag->setDefault("juchuuzan_ryou2", $test_zaiko_shime->juchuuzan_ryou2);
            $this->tag->setDefault("azukari_zan1s", $test_zaiko_shime->azukari_zan1s);
            $this->tag->setDefault("azukari_zan2s", $test_zaiko_shime->azukari_zan2s);
            $this->tag->setDefault("azukari_tasi1s", $test_zaiko_shime->azukari_tasi1s);
            $this->tag->setDefault("azukari_tasi2s", $test_zaiko_shime->azukari_tasi2s);
            $this->tag->setDefault("azukari_hiki1s", $test_zaiko_shime->azukari_hiki1s);
            $this->tag->setDefault("azukari_hiki2s", $test_zaiko_shime->azukari_hiki2s);
            $this->tag->setDefault("kousin_user_id", $test_zaiko_shime->kousin_user_id);
            $this->tag->setDefault("updated", $test_zaiko_shime->updated);
            $this->tag->setDefault("sakusei_user_id", $test_zaiko_shime->sakusei_user_id);
            $this->tag->setDefault("created", $test_zaiko_shime->created);
            
        }
    }

    /**
     * Creates a new test_zaiko_shime
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "test_zaiko_shime",
                'action' => 'index'
            ]);

            return;
        }

        $test_zaiko_shime = new TestZaikoShime();
        $test_zaiko_shime->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $test_zaiko_shime->tantouMrCd = $this->request->getPost("tantou_mr_cd");
        $test_zaiko_shime->tanniMr1Cd = $this->request->getPost("tanni_mr1_cd");
        $test_zaiko_shime->tanniMr2Cd = $this->request->getPost("tanni_mr2_cd");
        $test_zaiko_shime->iro = $this->request->getPost("iro");
        $test_zaiko_shime->iromei = $this->request->getPost("iromei");
        $test_zaiko_shime->lot = $this->request->getPost("lot");
        $test_zaiko_shime->kobetucd = $this->request->getPost("kobetucd");
        $test_zaiko_shime->hinsituKbnCd = $this->request->getPost("hinsitu_kbn_cd");
        $test_zaiko_shime->hinsituHyoukaKbnCd = $this->request->getPost("hinsitu_hyouka_kbn_cd");
        $test_zaiko_shime->soukoMrCd = $this->request->getPost("souko_mr_cd");
        $test_zaiko_shime->nyuukobis = $this->request->getPost("nyuukobis");
        $test_zaiko_shime->shukkobis = $this->request->getPost("shukkobis");
        $test_zaiko_shime->nyuushukkobi = $this->request->getPost("nyuushukkobi");
        $test_zaiko_shime->nyuushukkoym = $this->request->getPost("nyuushukkoym");
        $test_zaiko_shime->denpyouMrCd = $this->request->getPost("denpyou_mr_cd");
        $test_zaiko_shime->id = $this->request->getPost("id");
        $test_zaiko_shime->cd = $this->request->getPost("cd");
        $test_zaiko_shime->meisaiId = $this->request->getPost("meisai_id");
        $test_zaiko_shime->meisaiCd = $this->request->getPost("meisai_cd");
        $test_zaiko_shime->utiwakeKbnCd = $this->request->getPost("utiwake_kbn_cd");
        $test_zaiko_shime->torihikisakiCd = $this->request->getPost("torihikisaki_cd");
        $test_zaiko_shime->bikou = $this->request->getPost("bikou");
        $test_zaiko_shime->zaikoRyou1s = $this->request->getPost("zaiko_ryou1s");
        $test_zaiko_shime->zaikoRyou2s = $this->request->getPost("zaiko_ryou2s");
        $test_zaiko_shime->tankaTanniMrCd = $this->request->getPost("tanka_tanni_mr_cd");
        $test_zaiko_shime->shiirebiTankas = $this->request->getPost("shiirebi_tankas");
        $test_zaiko_shime->shiireGakus = $this->request->getPost("shiire_gakus");
        $test_zaiko_shime->shiireRyou1s = $this->request->getPost("shiire_ryou1s");
        $test_zaiko_shime->shiireRyou2s = $this->request->getPost("shiire_ryou2s");
        $test_zaiko_shime->hokanyuukoRyou1s = $this->request->getPost("hokanyuuko_ryou1s");
        $test_zaiko_shime->hokanyuukoRyou2s = $this->request->getPost("hokanyuuko_ryou2s");
        $test_zaiko_shime->uriageRyou1s = $this->request->getPost("uriage_ryou1s");
        $test_zaiko_shime->uriageRyou2s = $this->request->getPost("uriage_ryou2s");
        $test_zaiko_shime->hokashukkoRyou1s = $this->request->getPost("hokashukko_ryou1s");
        $test_zaiko_shime->hokashukkoRyou2s = $this->request->getPost("hokashukko_ryou2s");
        $test_zaiko_shime->shiiresakiMrCd = $this->request->getPost("shiiresaki_mr_cd");
        $test_zaiko_shime->tokuisakiMrCd = $this->request->getPost("tokuisaki_mr_cd");
        $test_zaiko_shime->nounyuuKijitu = $this->request->getPost("nounyuu_kijitu");
        $test_zaiko_shime->nouki = $this->request->getPost("nouki");
        $test_zaiko_shime->hacchuuDtId = $this->request->getPost("hacchuu_dt_id");
        $test_zaiko_shime->juchuuDtId = $this->request->getPost("juchuu_dt_id");
        $test_zaiko_shime->hacchuuzanRyou1 = $this->request->getPost("hacchuuzan_ryou1");
        $test_zaiko_shime->hacchuuzanRyou2 = $this->request->getPost("hacchuuzan_ryou2");
        $test_zaiko_shime->juchuuzanRyou1 = $this->request->getPost("juchuuzan_ryou1");
        $test_zaiko_shime->juchuuzanRyou2 = $this->request->getPost("juchuuzan_ryou2");
        $test_zaiko_shime->azukariZan1s = $this->request->getPost("azukari_zan1s");
        $test_zaiko_shime->azukariZan2s = $this->request->getPost("azukari_zan2s");
        $test_zaiko_shime->azukariTasi1s = $this->request->getPost("azukari_tasi1s");
        $test_zaiko_shime->azukariTasi2s = $this->request->getPost("azukari_tasi2s");
        $test_zaiko_shime->azukariHiki1s = $this->request->getPost("azukari_hiki1s");
        $test_zaiko_shime->azukariHiki2s = $this->request->getPost("azukari_hiki2s");
        $test_zaiko_shime->kousinUserId = $this->request->getPost("kousin_user_id");
        $test_zaiko_shime->updated = $this->request->getPost("updated");
        $test_zaiko_shime->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $test_zaiko_shime->created = $this->request->getPost("created");
        

        if (!$test_zaiko_shime->save()) {
            foreach ($test_zaiko_shime->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test_zaiko_shime",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("test_zaiko_shime was created successfully");

        $this->dispatcher->forward([
            'controller' => "test_zaiko_shime",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a test_zaiko_shime edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "test_zaiko_shime",
                'action' => 'index'
            ]);

            return;
        }

        $shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $test_zaiko_shime = TestZaikoShime::findFirstByshouhin_mr_cd($shouhin_mr_cd);

        if (!$test_zaiko_shime) {
            $this->flash->error("test_zaiko_shime does not exist " . $shouhin_mr_cd);

            $this->dispatcher->forward([
                'controller' => "test_zaiko_shime",
                'action' => 'index'
            ]);

            return;
        }

        $test_zaiko_shime->shouhinMrCd = $this->request->getPost("shouhin_mr_cd");
        $test_zaiko_shime->tantouMrCd = $this->request->getPost("tantou_mr_cd");
        $test_zaiko_shime->tanniMr1Cd = $this->request->getPost("tanni_mr1_cd");
        $test_zaiko_shime->tanniMr2Cd = $this->request->getPost("tanni_mr2_cd");
        $test_zaiko_shime->iro = $this->request->getPost("iro");
        $test_zaiko_shime->iromei = $this->request->getPost("iromei");
        $test_zaiko_shime->lot = $this->request->getPost("lot");
        $test_zaiko_shime->kobetucd = $this->request->getPost("kobetucd");
        $test_zaiko_shime->hinsituKbnCd = $this->request->getPost("hinsitu_kbn_cd");
        $test_zaiko_shime->hinsituHyoukaKbnCd = $this->request->getPost("hinsitu_hyouka_kbn_cd");
        $test_zaiko_shime->soukoMrCd = $this->request->getPost("souko_mr_cd");
        $test_zaiko_shime->nyuukobis = $this->request->getPost("nyuukobis");
        $test_zaiko_shime->shukkobis = $this->request->getPost("shukkobis");
        $test_zaiko_shime->nyuushukkobi = $this->request->getPost("nyuushukkobi");
        $test_zaiko_shime->nyuushukkoym = $this->request->getPost("nyuushukkoym");
        $test_zaiko_shime->denpyouMrCd = $this->request->getPost("denpyou_mr_cd");
        $test_zaiko_shime->id = $this->request->getPost("id");
        $test_zaiko_shime->cd = $this->request->getPost("cd");
        $test_zaiko_shime->meisaiId = $this->request->getPost("meisai_id");
        $test_zaiko_shime->meisaiCd = $this->request->getPost("meisai_cd");
        $test_zaiko_shime->utiwakeKbnCd = $this->request->getPost("utiwake_kbn_cd");
        $test_zaiko_shime->torihikisakiCd = $this->request->getPost("torihikisaki_cd");
        $test_zaiko_shime->bikou = $this->request->getPost("bikou");
        $test_zaiko_shime->zaikoRyou1s = $this->request->getPost("zaiko_ryou1s");
        $test_zaiko_shime->zaikoRyou2s = $this->request->getPost("zaiko_ryou2s");
        $test_zaiko_shime->tankaTanniMrCd = $this->request->getPost("tanka_tanni_mr_cd");
        $test_zaiko_shime->shiirebiTankas = $this->request->getPost("shiirebi_tankas");
        $test_zaiko_shime->shiireGakus = $this->request->getPost("shiire_gakus");
        $test_zaiko_shime->shiireRyou1s = $this->request->getPost("shiire_ryou1s");
        $test_zaiko_shime->shiireRyou2s = $this->request->getPost("shiire_ryou2s");
        $test_zaiko_shime->hokanyuukoRyou1s = $this->request->getPost("hokanyuuko_ryou1s");
        $test_zaiko_shime->hokanyuukoRyou2s = $this->request->getPost("hokanyuuko_ryou2s");
        $test_zaiko_shime->uriageRyou1s = $this->request->getPost("uriage_ryou1s");
        $test_zaiko_shime->uriageRyou2s = $this->request->getPost("uriage_ryou2s");
        $test_zaiko_shime->hokashukkoRyou1s = $this->request->getPost("hokashukko_ryou1s");
        $test_zaiko_shime->hokashukkoRyou2s = $this->request->getPost("hokashukko_ryou2s");
        $test_zaiko_shime->shiiresakiMrCd = $this->request->getPost("shiiresaki_mr_cd");
        $test_zaiko_shime->tokuisakiMrCd = $this->request->getPost("tokuisaki_mr_cd");
        $test_zaiko_shime->nounyuuKijitu = $this->request->getPost("nounyuu_kijitu");
        $test_zaiko_shime->nouki = $this->request->getPost("nouki");
        $test_zaiko_shime->hacchuuDtId = $this->request->getPost("hacchuu_dt_id");
        $test_zaiko_shime->juchuuDtId = $this->request->getPost("juchuu_dt_id");
        $test_zaiko_shime->hacchuuzanRyou1 = $this->request->getPost("hacchuuzan_ryou1");
        $test_zaiko_shime->hacchuuzanRyou2 = $this->request->getPost("hacchuuzan_ryou2");
        $test_zaiko_shime->juchuuzanRyou1 = $this->request->getPost("juchuuzan_ryou1");
        $test_zaiko_shime->juchuuzanRyou2 = $this->request->getPost("juchuuzan_ryou2");
        $test_zaiko_shime->azukariZan1s = $this->request->getPost("azukari_zan1s");
        $test_zaiko_shime->azukariZan2s = $this->request->getPost("azukari_zan2s");
        $test_zaiko_shime->azukariTasi1s = $this->request->getPost("azukari_tasi1s");
        $test_zaiko_shime->azukariTasi2s = $this->request->getPost("azukari_tasi2s");
        $test_zaiko_shime->azukariHiki1s = $this->request->getPost("azukari_hiki1s");
        $test_zaiko_shime->azukariHiki2s = $this->request->getPost("azukari_hiki2s");
        $test_zaiko_shime->kousinUserId = $this->request->getPost("kousin_user_id");
        $test_zaiko_shime->updated = $this->request->getPost("updated");
        $test_zaiko_shime->sakuseiUserId = $this->request->getPost("sakusei_user_id");
        $test_zaiko_shime->created = $this->request->getPost("created");
        

        if (!$test_zaiko_shime->save()) {

            foreach ($test_zaiko_shime->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test_zaiko_shime",
                'action' => 'edit',
                'params' => [$test_zaiko_shime->shouhin_mr_cd]
            ]);

            return;
        }

        $this->flash->success("test_zaiko_shime was updated successfully");

        $this->dispatcher->forward([
            'controller' => "test_zaiko_shime",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a test_zaiko_shime
     *
     * @param string $shouhin_mr_cd
     */
    public function deleteAction($shouhin_mr_cd)
    {
        $test_zaiko_shime = TestZaikoShime::findFirstByshouhin_mr_cd($shouhin_mr_cd);
        if (!$test_zaiko_shime) {
            $this->flash->error("test_zaiko_shime was not found");

            $this->dispatcher->forward([
                'controller' => "test_zaiko_shime",
                'action' => 'index'
            ]);

            return;
        }

        if (!$test_zaiko_shime->delete()) {

            foreach ($test_zaiko_shime->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test_zaiko_shime",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("test_zaiko_shime was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "test_zaiko_shime",
            'action' => "index"
        ]);
    }

}
