<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class JuchuuMeisaiDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for juchuu_meisai_dts
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'JuchuuMeisaiDts', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $juchuu_meisai_dts = JuchuuMeisaiDts::find($parameters);
        if (count($juchuu_meisai_dts) == 0) {
            $this->flash->notice("The search did not find any juchuu_meisai_dts");

            $this->dispatcher->forward([
                "controller" => "juchuu_meisai_dts",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $juchuu_meisai_dts,
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
     * Edits a juchuu_meisai_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $juchuu_meisai_dt = JuchuuMeisaiDts::findFirstByid($id);
            if (!$juchuu_meisai_dt) {
                $this->flash->error("juchuu_meisai_dt was not found");

                $this->dispatcher->forward([
                    'controller' => "juchuu_meisai_dts",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $juchuu_meisai_dt->id;

            $this->tag->setDefault("id", $juchuu_meisai_dt->id);
            $this->tag->setDefault("cd", $juchuu_meisai_dt->cd);
            $this->tag->setDefault("utiwake_kbn_cd", $juchuu_meisai_dt->utiwake_kbn_cd);
            $this->tag->setDefault("juchuu_dt_id", $juchuu_meisai_dt->juchuu_dt_id);
            $this->tag->setDefault("shouhin_mr_cd", $juchuu_meisai_dt->shouhin_mr_cd);
            $this->tag->setDefault("tanni_mr_cd", $juchuu_meisai_dt->tanni_mr_cd);
            $this->tag->setDefault("kousei", $juchuu_meisai_dt->kousei);
            $this->tag->setDefault("irisuu", $juchuu_meisai_dt->irisuu);
            $this->tag->setDefault("keisu", $juchuu_meisai_dt->keisu);
            $this->tag->setDefault("tekiyou", $juchuu_meisai_dt->tekiyou);
            $this->tag->setDefault("lot", $juchuu_meisai_dt->lot);
            $this->tag->setDefault("kobetucd", $juchuu_meisai_dt->kobetucd);
            $this->tag->setDefault("hinsitu_kbn_cd", $juchuu_meisai_dt->hinsitu_kbn_cd);
            $this->tag->setDefault("souko_mr_cd", $juchuu_meisai_dt->souko_mr_cd);
            $this->tag->setDefault("kikaku", $juchuu_meisai_dt->kikaku);
            $this->tag->setDefault("iro", $juchuu_meisai_dt->iro);
            $this->tag->setDefault("iromei", $juchuu_meisai_dt->iromei);
            $this->tag->setDefault("size", $juchuu_meisai_dt->size);
            $this->tag->setDefault("suuryou", $juchuu_meisai_dt->suuryou);
            $this->tag->setDefault("suuryou1", $juchuu_meisai_dt->suuryou1);
            $this->tag->setDefault("tanni_mr1_cd", $juchuu_meisai_dt->tanni_mr1_cd);
            $this->tag->setDefault("suuryou2", $juchuu_meisai_dt->suuryou2);
            $this->tag->setDefault("tanni_mr2_cd", $juchuu_meisai_dt->tanni_mr2_cd);
            $this->tag->setDefault("tanka_kbn", $juchuu_meisai_dt->tanka_kbn);
            $this->tag->setDefault("gentanka", $juchuu_meisai_dt->gentanka);
            $this->tag->setDefault("tanka", $juchuu_meisai_dt->tanka);
            $this->tag->setDefault("kingaku", $juchuu_meisai_dt->kingaku);
            $this->tag->setDefault("genkagaku", $juchuu_meisai_dt->genkagaku);
            $this->tag->setDefault("zeinukigaku", $juchuu_meisai_dt->zeinukigaku);
            $this->tag->setDefault("zeigaku", $juchuu_meisai_dt->zeigaku);
            $this->tag->setDefault("project_mr_cd", $juchuu_meisai_dt->project_mr_cd);
            $this->tag->setDefault("zeiritu_mr_cd", $juchuu_meisai_dt->zeiritu_mr_cd);
            $this->tag->setDefault("bikou", $juchuu_meisai_dt->bikou);
            $this->tag->setDefault("nouki", $juchuu_meisai_dt->nouki);
            $this->tag->setDefault("hacchuurendou_flg", $juchuu_meisai_dt->hacchuurendou_flg);
            $this->tag->setDefault("id_moto", $juchuu_meisai_dt->id_moto);
            $this->tag->setDefault("hikae_dltflg", $juchuu_meisai_dt->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $juchuu_meisai_dt->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $juchuu_meisai_dt->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $juchuu_meisai_dt->sakusei_user_id);
            $this->tag->setDefault("created", $juchuu_meisai_dt->created);
            $this->tag->setDefault("kousin_user_id", $juchuu_meisai_dt->kousin_user_id);
            $this->tag->setDefault("updated", $juchuu_meisai_dt->updated);
            
        }
    }

    /**
     * Creates a new juchuu_meisai_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ]);

            return;
        }

        $juchuu_meisai_dt = new JuchuuMeisaiDts();
        $juchuu_meisai_dt->Cd = $this->request->getPost("cd");
        $juchuu_meisai_dt->Utiwake_kbn_cd = $this->request->getPost("utiwake_kbn_cd");
        $juchuu_meisai_dt->Juchuu_dt_id = $this->request->getPost("juchuu_dt_id");
        $juchuu_meisai_dt->Shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $juchuu_meisai_dt->Tanni_mr_cd = $this->request->getPost("tanni_mr_cd");
        $juchuu_meisai_dt->Kousei = $this->request->getPost("kousei");
        $juchuu_meisai_dt->Irisuu = $this->request->getPost("irisuu");
        $juchuu_meisai_dt->Keisu = $this->request->getPost("keisu");
        $juchuu_meisai_dt->Tekiyou = $this->request->getPost("tekiyou");
        $juchuu_meisai_dt->Lot = $this->request->getPost("lot");
        $juchuu_meisai_dt->Kobetucd = $this->request->getPost("kobetucd");
        $juchuu_meisai_dt->Hinsitu_kbn_cd = $this->request->getPost("hinsitu_kbn_cd");
        $juchuu_meisai_dt->Souko_mr_cd = $this->request->getPost("souko_mr_cd");
        $juchuu_meisai_dt->Kikaku = $this->request->getPost("kikaku");
        $juchuu_meisai_dt->Iro = $this->request->getPost("iro");
        $juchuu_meisai_dt->Iromei = $this->request->getPost("iromei");
        $juchuu_meisai_dt->Size = $this->request->getPost("size");
        $juchuu_meisai_dt->Suuryou = $this->request->getPost("suuryou");
        $juchuu_meisai_dt->Suuryou1 = $this->request->getPost("suuryou1");
        $juchuu_meisai_dt->Tanni_mr1_cd = $this->request->getPost("tanni_mr1_cd");
        $juchuu_meisai_dt->Suuryou2 = $this->request->getPost("suuryou2");
        $juchuu_meisai_dt->Tanni_mr2_cd = $this->request->getPost("tanni_mr2_cd");
        $juchuu_meisai_dt->Tanka_kbn = $this->request->getPost("tanka_kbn");
        $juchuu_meisai_dt->Gentanka = $this->request->getPost("gentanka");
        $juchuu_meisai_dt->Tanka = $this->request->getPost("tanka");
        $juchuu_meisai_dt->Kingaku = $this->request->getPost("kingaku");
        $juchuu_meisai_dt->Genkagaku = $this->request->getPost("genkagaku");
        $juchuu_meisai_dt->Zeinukigaku = $this->request->getPost("zeinukigaku");
        $juchuu_meisai_dt->Zeigaku = $this->request->getPost("zeigaku");
        $juchuu_meisai_dt->Project_mr_cd = $this->request->getPost("project_mr_cd");
        $juchuu_meisai_dt->Zeiritu_mr_cd = $this->request->getPost("zeiritu_mr_cd");
        $juchuu_meisai_dt->Bikou = $this->request->getPost("bikou");
        $juchuu_meisai_dt->Nouki = $this->request->getPost("nouki");
        $juchuu_meisai_dt->Hacchuurendou_flg = $this->request->getPost("hacchuurendou_flg");
        $juchuu_meisai_dt->Id_moto = $this->request->getPost("id_moto");
        $juchuu_meisai_dt->Hikae_dltflg = $this->request->getPost("hikae_dltflg");
        $juchuu_meisai_dt->Hikae_user_id = $this->request->getPost("hikae_user_id");
        $juchuu_meisai_dt->Hikae_nichiji = $this->request->getPost("hikae_nichiji");
        $juchuu_meisai_dt->Sakusei_user_id = $this->request->getPost("sakusei_user_id");
        $juchuu_meisai_dt->Created = $this->request->getPost("created");
        $juchuu_meisai_dt->Kousin_user_id = $this->request->getPost("kousin_user_id");
        $juchuu_meisai_dt->Updated = $this->request->getPost("updated");
        

        if (!$juchuu_meisai_dt->save()) {
            foreach ($juchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "juchuu_meisai_dts",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("juchuu_meisai_dt was created successfully");

        $this->dispatcher->forward([
            'controller' => "juchuu_meisai_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a juchuu_meisai_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $juchuu_meisai_dt = JuchuuMeisaiDts::findFirstByid($id);

        if (!$juchuu_meisai_dt) {
            $this->flash->error("juchuu_meisai_dt does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ]);

            return;
        }

        $juchuu_meisai_dt->Cd = $this->request->getPost("cd");
        $juchuu_meisai_dt->Utiwake_kbn_cd = $this->request->getPost("utiwake_kbn_cd");
        $juchuu_meisai_dt->Juchuu_dt_id = $this->request->getPost("juchuu_dt_id");
        $juchuu_meisai_dt->Shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $juchuu_meisai_dt->Tanni_mr_cd = $this->request->getPost("tanni_mr_cd");
        $juchuu_meisai_dt->Kousei = $this->request->getPost("kousei");
        $juchuu_meisai_dt->Irisuu = $this->request->getPost("irisuu");
        $juchuu_meisai_dt->Keisu = $this->request->getPost("keisu");
        $juchuu_meisai_dt->Tekiyou = $this->request->getPost("tekiyou");
        $juchuu_meisai_dt->Lot = $this->request->getPost("lot");
        $juchuu_meisai_dt->Kobetucd = $this->request->getPost("kobetucd");
        $juchuu_meisai_dt->Hinsitu_kbn_cd = $this->request->getPost("hinsitu_kbn_cd");
        $juchuu_meisai_dt->Souko_mr_cd = $this->request->getPost("souko_mr_cd");
        $juchuu_meisai_dt->Kikaku = $this->request->getPost("kikaku");
        $juchuu_meisai_dt->Iro = $this->request->getPost("iro");
        $juchuu_meisai_dt->Iromei = $this->request->getPost("iromei");
        $juchuu_meisai_dt->Size = $this->request->getPost("size");
        $juchuu_meisai_dt->Suuryou = $this->request->getPost("suuryou");
        $juchuu_meisai_dt->Suuryou1 = $this->request->getPost("suuryou1");
        $juchuu_meisai_dt->Tanni_mr1_cd = $this->request->getPost("tanni_mr1_cd");
        $juchuu_meisai_dt->Suuryou2 = $this->request->getPost("suuryou2");
        $juchuu_meisai_dt->Tanni_mr2_cd = $this->request->getPost("tanni_mr2_cd");
        $juchuu_meisai_dt->Tanka_kbn = $this->request->getPost("tanka_kbn");
        $juchuu_meisai_dt->Gentanka = $this->request->getPost("gentanka");
        $juchuu_meisai_dt->Tanka = $this->request->getPost("tanka");
        $juchuu_meisai_dt->Kingaku = $this->request->getPost("kingaku");
        $juchuu_meisai_dt->Genkagaku = $this->request->getPost("genkagaku");
        $juchuu_meisai_dt->Zeinukigaku = $this->request->getPost("zeinukigaku");
        $juchuu_meisai_dt->Zeigaku = $this->request->getPost("zeigaku");
        $juchuu_meisai_dt->Project_mr_cd = $this->request->getPost("project_mr_cd");
        $juchuu_meisai_dt->Zeiritu_mr_cd = $this->request->getPost("zeiritu_mr_cd");
        $juchuu_meisai_dt->Bikou = $this->request->getPost("bikou");
        $juchuu_meisai_dt->Nouki = $this->request->getPost("nouki");
        $juchuu_meisai_dt->Hacchuurendou_flg = $this->request->getPost("hacchuurendou_flg");
        $juchuu_meisai_dt->Id_moto = $this->request->getPost("id_moto");
        $juchuu_meisai_dt->Hikae_dltflg = $this->request->getPost("hikae_dltflg");
        $juchuu_meisai_dt->Hikae_user_id = $this->request->getPost("hikae_user_id");
        $juchuu_meisai_dt->Hikae_nichiji = $this->request->getPost("hikae_nichiji");
        $juchuu_meisai_dt->Sakusei_user_id = $this->request->getPost("sakusei_user_id");
        $juchuu_meisai_dt->Created = $this->request->getPost("created");
        $juchuu_meisai_dt->Kousin_user_id = $this->request->getPost("kousin_user_id");
        $juchuu_meisai_dt->Updated = $this->request->getPost("updated");
        

        if (!$juchuu_meisai_dt->save()) {

            foreach ($juchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "juchuu_meisai_dts",
                'action' => 'edit',
                'params' => [$juchuu_meisai_dt->id]
            ]);

            return;
        }

        $this->flash->success("juchuu_meisai_dt was updated successfully");

        $this->dispatcher->forward([
            'controller' => "juchuu_meisai_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a juchuu_meisai_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $juchuu_meisai_dt = JuchuuMeisaiDts::findFirstByid($id);
        if (!$juchuu_meisai_dt) {
            $this->flash->error("juchuu_meisai_dt was not found");

            $this->dispatcher->forward([
                'controller' => "juchuu_meisai_dts",
                'action' => 'index'
            ]);

            return;
        }

        if (!$juchuu_meisai_dt->delete()) {

            foreach ($juchuu_meisai_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "juchuu_meisai_dts",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("juchuu_meisai_dt was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "juchuu_meisai_dts",
            'action' => "index"
        ]);
    }

	public function copyfrompropAction()
	{
		if ($this->db->execute('TRUNCATE TABLE sfn.juchuu_meisai_dts')) { // 全削除
			$this->flash->success("juchuu_meisai_dt was deleted successfully");
		} else {
			$this->flash->error("juchuu_meisai_dt was not deleted ERROR!!");
		}
//		20加工製品 3/撚糸
		$sql="INSERT INTO sfn.juchuu_meisai_dts (
				cd,
				utiwake_kbn_cd,
				juchuu_dt_id,
				shouhin_mr_cd,
				kousei,
				tekiyou,
				lot,
				iro,
				hinsitu_kbn_cd,
				souko_mr_cd,
				suuryou1,
				tanni_mr1_cd,
				suuryou2,
				tanni_mr2_cd,
				tanka_kbn,
				gentanka,
				tanka,
				kingaku,
				genkagaku,
				zeinukigaku,
				zeigaku,
				zeiritu_mr_cd,
				bikou,
				nouki,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				(select count(*) from prop_hikiate_vws a1
					JOIN hisasi_vws as d1 ON d1.sasizu_no = a1.sasizu_no
					where a1.kakou_no1=a.kakou_no1 and a1.sasizu_no<a.sasizu_no)*6+1 as cd,
				20 as utiwake_kbn_cd,
				b.id as juchuu_dt_id,
				concat('3/',d.ito_code) as shouhin_mr_cd,
				'-' as kousei,
				concat(a.itomei,' ',IFNULL(a.itomei2,'')) as tekiyou,
				a.lot as lot,
				a.sasizu_no as iro,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				(CASE WHEN e.cd=4 THEN 1
					ELSE d.sasizu_honsuu END) as suuryou1,
				(CASE WHEN e.cd=4 THEN 4
					ELSE 11 END) as tanni_mr1_cd,
				d.sasizu_ryou as suuryou2,
				5 as tanni_mr2_cd,
				(CASE WHEN e.cd=5 THEN 2 ELSE 1 END) as tanka_kbn,
				c.sofina_kakoutin as gentanka,
				0 as tanka,
				0 as kingaku,
				(CASE e.cd WHEN 5 THEN d.sasizu_ryou
					WHEN 4 THEN 1 ELSE d.sasizu_honsuu
					END) * c.sofina_kakoutin as genkagaku,
				0 as zeinukigaku,
				0 as zeigaku,
				90 as zeiritu_mr_cd,
				a.bikou as bikou,
				d.seisan_kaishi as nouki,
				b.sakusei_user_id,
				b.created,
				b.kousin_user_id,
				b.updated
			FROM prop_hikiate_vws as a
			JOIN sfn.juchuu_dts as b ON b.cd = a.kakou_no1
			LEFT JOIN iraikiroku_vws as c ON c.kakou_no = a.kakou_no1
			JOIN hisasi_vws as d ON d.sasizu_no = a.sasizu_no
			LEFT JOIN sfn.tanni_mrs as e ON e.name = a.tanni
			ORDER BY b.id, a.sasizu_no";
		if ($this->db->execute($sql)) {
			$this->flash->success("juchuu_meisai_dt was created successfully");
		} else {
			$this->flash->error("juchuu_meisai_dt was not created ERROR!!");
		}
//		10加工賃 N/撚糸
		$sql="INSERT INTO sfn.juchuu_meisai_dts (
				cd,
				utiwake_kbn_cd,
				juchuu_dt_id,
				shouhin_mr_cd,
				kousei,
				tekiyou,
				lot,
				iro,
				hinsitu_kbn_cd,
				souko_mr_cd,
				keisu,
				suuryou,
				suuryou1,
				tanni_mr1_cd,
				suuryou2,
				tanni_mr2_cd,
				tanka_kbn,
				gentanka,
				tanka,
				kingaku,
				genkagaku,
				zeinukigaku,
				zeigaku,
				zeiritu_mr_cd,
				bikou,
				nouki,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				(select count(*) from prop_hikiate_vws a1
					JOIN hisasi_vws as d1 ON d1.sasizu_no = a1.sasizu_no
					where a1.kakou_no1=a.kakou_no1 and a1.sasizu_no<a.sasizu_no)*6+2 AS cd,
				10 as utiwake_kbn_cd,
				b.id as juchuu_dt_id,
				concat('N/',d.ito_code) as shouhin_mr_cd,
				'├' as kousei,
				concat(a.itomei,' ',IFNULL(a.itomei2,'')) as tekiyou,
				a.lot as lot,
				a.sasizu_no,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				1 as keisu,
				d.sasizu_ryou as suuryou,
				(CASE WHEN e.cd=4 THEN 1
					ELSE d.sasizu_honsuu END) as suuryou1,
				(CASE WHEN e.cd=4 THEN 4
					ELSE 11 END) as tanni_mr1_cd,
				d.sasizu_ryou as suuryou2,
				5 as tanni_mr2_cd,
				(CASE WHEN e.cd=5 THEN 2 ELSE 1 END) as tanka_kbn,
				c.sofina_kakoutin as gentanka,
				c.sofina_kakoutin as tanka,
				(CASE e.cd WHEN 5 THEN d.sasizu_ryou
					WHEN 4 THEN 1 ELSE d.sasizu_honsuu
					END) * c.sofina_kakoutin as kingaku,
				(CASE e.cd WHEN 5 THEN d.sasizu_ryou
					WHEN 4 THEN 1 ELSE d.sasizu_honsuu
					END) * c.sofina_kakoutin as genkagaku,
				(CASE e.cd WHEN 5 THEN d.sasizu_ryou
					WHEN 4 THEN 1 ELSE d.sasizu_honsuu
					END) * c.sofina_kakoutin as zeinukigaku,
				(CASE e.cd WHEN 5 THEN d.sasizu_ryou
					WHEN 4 THEN 1 ELSE d.sasizu_honsuu
					END) * c.sofina_kakoutin * 0.08 as zeigaku,
				12 as zeiritu_mr_cd,
				a.bikou as bikou,
				d.seisan_kaishi as nouki,
				b.sakusei_user_id,
				b.created,
				b.kousin_user_id,
				b.updated
			FROM prop_hikiate_vws as a
			JOIN sfn.juchuu_dts as b ON b.cd = a.kakou_no1
			LEFT JOIN iraikiroku_vws as c ON c.kakou_no = a.kakou_no1
			JOIN hisasi_vws as d ON d.sasizu_no = a.sasizu_no
			LEFT JOIN sfn.tanni_mrs as e ON e.name = a.tanni
			ORDER BY b.id, a.sasizu_no";
		if ($this->db->execute($sql)) {
			$this->flash->success("juchuu_meisai_dt was created successfully");
		} else {
			$this->flash->error("juchuu_meisai_dt was not created ERROR!!");
		}
//		20加工製品 1/原料-1
		$sql="INSERT INTO sfn.juchuu_meisai_dts (
				cd,
				utiwake_kbn_cd,
				juchuu_dt_id,
				shouhin_mr_cd,
				kousei,
				tekiyou,
				lot,
				iro,
				hinsitu_kbn_cd,
				souko_mr_cd,
				keisu,
				suuryou,
				suuryou1,
				tanni_mr1_cd,
				suuryou2,
				tanni_mr2_cd,
				tanka_kbn,
				gentanka,
				tanka,
				kingaku,
				genkagaku,
				zeinukigaku,
				zeigaku,
				zeiritu_mr_cd,
				bikou,
				nouki,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				(select a0.cd from sfn.juchuu_meisai_dts a0
					where a0.juchuu_dt_id=b.id and a0.utiwake_kbn_cd=10 and a0.iro=a.sasizu_no)+f.genryou_jun as cd,
				21 as utiwake_kbn_cd,
				b.id as juchuu_dt_id,
				g.cd as shouhin_mr_cd,
				'└' as kousei,
				g.name as tekiyou,
				g.lot as lot,
				a.sasizu_no as iro,
				11 as hinsitu_kbn_cd,
				'HARA' as souko_mr_cd,
				f.gentanni as keisu,
				d.sasizu_ryou as suuryou,
				if(e.cd=4,1,d.sasizu_honsuu) as suuryou1,
				if(e.cd=4,4,11) as tanni_mr1_cd,
				d.sasizu_ryou * f.gentanni as suuryou2,
				5 as tanni_mr2_cd,
				if(e.cd=5,2,1) as tanka_kbn,
				0 as gentanka,
				0 as tanka,
				0 as kingaku,
				0 as genkagaku,
				0 as zeinukigaku,
				0 as zeigaku,
				90 as zeiritu_mr_cd,
				a.bikou as bikou,
				d.seisan_kaishi as nouki,
				b.sakusei_user_id,
				b.created,
				b.kousin_user_id,
				b.updated
			FROM prop_hikiate_vws as a
			LEFT JOIN higenr_vws as f ON f.sasizu_no = a.sasizu_no
			LEFT JOIN sfn.shouhin_mrs as g ON g.cd LIKE concat('%',f.itocode) AND g.zaikokanri = 1
			JOIN sfn.juchuu_dts as b ON b.cd = a.kakou_no1
			LEFT JOIN iraikiroku_vws as c ON c.kakou_no = a.kakou_no1
			JOIN hisasi_vws as d ON d.sasizu_no = a.sasizu_no
			LEFT JOIN sfn.tanni_mrs as e ON e.name = a.tanni
			ORDER BY b.id, a.sasizu_no";
		if ($this->db->execute($sql)) {
			$this->flash->success("juchuu_meisai_dt was created successfully");
		} else {
			$this->flash->error("juchuu_meisai_dt was not created ERROR!!");
		}
/** デバッグ
 echo "<pre>";
 var_dump($rows);
 echo "</pre>";
 return;
*/
        $this->dispatcher->forward([
            'controller' => "juchuu_meisai_dts",
            'action' => "search"
        ]);
	}

}
