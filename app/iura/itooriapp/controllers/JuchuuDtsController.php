<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class JuchuuDtsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for juchuu_dts
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'JuchuuDts', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $juchuu_dts = JuchuuDts::find($parameters);
        if (count($juchuu_dts) == 0) {
            $this->flash->notice("The search did not find any juchuu_dts");

            $this->dispatcher->forward([
                "controller" => "juchuu_dts",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $juchuu_dts,
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
     * Edits a juchuu_dt
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $juchuu_dt = JuchuuDts::findFirstByid($id);
            if (!$juchuu_dt) {
                $this->flash->error("juchuu_dt was not found");

                $this->dispatcher->forward([
                    'controller' => "juchuu_dts",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $juchuu_dt->id;

            $this->tag->setDefault("id", $juchuu_dt->id);
            $this->tag->setDefault("cd", $juchuu_dt->cd);
            $this->tag->setDefault("nendo", $juchuu_dt->nendo);
            $this->tag->setDefault("tekiyou", $juchuu_dt->tekiyou);
            $this->tag->setDefault("juchuubi", $juchuu_dt->juchuubi);
            $this->tag->setDefault("zeiritu_tekiyoubi", $juchuu_dt->zeiritu_tekiyoubi);
            $this->tag->setDefault("tokuisaki_mr_cd", $juchuu_dt->tokuisaki_mr_cd);
            $this->tag->setDefault("torihiki_kbn_cd", $juchuu_dt->torihiki_kbn_cd);
            $this->tag->setDefault("zei_tenka_kbn_cd", $juchuu_dt->zei_tenka_kbn_cd);
            $this->tag->setDefault("tantou_mr_cd", $juchuu_dt->tantou_mr_cd);
            $this->tag->setDefault("shimekiri_flg", $juchuu_dt->shimekiri_flg);
            $this->tag->setDefault("nounyuu_kijitu", $juchuu_dt->nounyuu_kijitu);
            $this->tag->setDefault("mitumori_dt_id", $juchuu_dt->mitumori_dt_id);
            $this->tag->setDefault("saki_hacchuu_cd", $juchuu_dt->saki_hacchuu_cd);
            $this->tag->setDefault("nounyuusaki_mr_cd", $juchuu_dt->nounyuusaki_mr_cd);
            $this->tag->setDefault("nounyuusaki", $juchuu_dt->nounyuusaki);
            $this->tag->setDefault("chokusousaki_kbn_cd", $juchuu_dt->chokusousaki_kbn_cd);
            $this->tag->setDefault("id_moto", $juchuu_dt->id_moto);
            $this->tag->setDefault("hikae_dltflg", $juchuu_dt->hikae_dltflg);
            $this->tag->setDefault("hikae_user_id", $juchuu_dt->hikae_user_id);
            $this->tag->setDefault("hikae_nichiji", $juchuu_dt->hikae_nichiji);
            $this->tag->setDefault("sakusei_user_id", $juchuu_dt->sakusei_user_id);
            $this->tag->setDefault("created", $juchuu_dt->created);
            $this->tag->setDefault("kousin_user_id", $juchuu_dt->kousin_user_id);
            $this->tag->setDefault("updated", $juchuu_dt->updated);
            
        }
    }

    /**
     * Creates a new juchuu_dt
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "juchuu_dts",
                'action' => 'index'
            ]);

            return;
        }

        $juchuu_dt = new JuchuuDts();
        $juchuu_dt->Cd = $this->request->getPost("cd");
        $juchuu_dt->Nendo = $this->request->getPost("nendo");
        $juchuu_dt->Tekiyou = $this->request->getPost("tekiyou");
        $juchuu_dt->Juchuubi = $this->request->getPost("juchuubi");
        $juchuu_dt->Zeiritu_tekiyoubi = $this->request->getPost("zeiritu_tekiyoubi");
        $juchuu_dt->Tokuisaki_mr_cd = $this->request->getPost("tokuisaki_mr_cd");
        $juchuu_dt->Torihiki_kbn_cd = $this->request->getPost("torihiki_kbn_cd");
        $juchuu_dt->Zei_tenka_kbn_cd = $this->request->getPost("zei_tenka_kbn_cd");
        $juchuu_dt->Tantou_mr_cd = $this->request->getPost("tantou_mr_cd");
        $juchuu_dt->Shimekiri_flg = $this->request->getPost("shimekiri_flg");
        $juchuu_dt->Nounyuu_kijitu = $this->request->getPost("nounyuu_kijitu");
        $juchuu_dt->Mitumori_dt_id = $this->request->getPost("mitumori_dt_id");
        $juchuu_dt->Saki_hacchuu_cd = $this->request->getPost("saki_hacchuu_cd");
        $juchuu_dt->Nounyuusaki_mr_cd = $this->request->getPost("nounyuusaki_mr_cd");
        $juchuu_dt->Nounyuusaki = $this->request->getPost("nounyuusaki");
        $juchuu_dt->Chokusousaki_kbn_cd = $this->request->getPost("chokusousaki_kbn_cd");
        $juchuu_dt->Id_moto = $this->request->getPost("id_moto");
        $juchuu_dt->Hikae_dltflg = $this->request->getPost("hikae_dltflg");
        $juchuu_dt->Hikae_user_id = $this->request->getPost("hikae_user_id");
        $juchuu_dt->Hikae_nichiji = $this->request->getPost("hikae_nichiji");
        $juchuu_dt->Sakusei_user_id = $this->request->getPost("sakusei_user_id");
        $juchuu_dt->Created = $this->request->getPost("created");
        $juchuu_dt->Kousin_user_id = $this->request->getPost("kousin_user_id");
        $juchuu_dt->Updated = $this->request->getPost("updated");
        

        if (!$juchuu_dt->save()) {
            foreach ($juchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "juchuu_dts",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("juchuu_dt was created successfully");

        $this->dispatcher->forward([
            'controller' => "juchuu_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a juchuu_dt edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "juchuu_dts",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $juchuu_dt = JuchuuDts::findFirstByid($id);

        if (!$juchuu_dt) {
            $this->flash->error("juchuu_dt does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "juchuu_dts",
                'action' => 'index'
            ]);

            return;
        }

        $juchuu_dt->Cd = $this->request->getPost("cd");
        $juchuu_dt->Nendo = $this->request->getPost("nendo");
        $juchuu_dt->Tekiyou = $this->request->getPost("tekiyou");
        $juchuu_dt->Juchuubi = $this->request->getPost("juchuubi");
        $juchuu_dt->Zeiritu_tekiyoubi = $this->request->getPost("zeiritu_tekiyoubi");
        $juchuu_dt->Tokuisaki_mr_cd = $this->request->getPost("tokuisaki_mr_cd");
        $juchuu_dt->Torihiki_kbn_cd = $this->request->getPost("torihiki_kbn_cd");
        $juchuu_dt->Zei_tenka_kbn_cd = $this->request->getPost("zei_tenka_kbn_cd");
        $juchuu_dt->Tantou_mr_cd = $this->request->getPost("tantou_mr_cd");
        $juchuu_dt->Shimekiri_flg = $this->request->getPost("shimekiri_flg");
        $juchuu_dt->Nounyuu_kijitu = $this->request->getPost("nounyuu_kijitu");
        $juchuu_dt->Mitumori_dt_id = $this->request->getPost("mitumori_dt_id");
        $juchuu_dt->Saki_hacchuu_cd = $this->request->getPost("saki_hacchuu_cd");
        $juchuu_dt->Nounyuusaki_mr_cd = $this->request->getPost("nounyuusaki_mr_cd");
        $juchuu_dt->Nounyuusaki = $this->request->getPost("nounyuusaki");
        $juchuu_dt->Chokusousaki_kbn_cd = $this->request->getPost("chokusousaki_kbn_cd");
        $juchuu_dt->Id_moto = $this->request->getPost("id_moto");
        $juchuu_dt->Hikae_dltflg = $this->request->getPost("hikae_dltflg");
        $juchuu_dt->Hikae_user_id = $this->request->getPost("hikae_user_id");
        $juchuu_dt->Hikae_nichiji = $this->request->getPost("hikae_nichiji");
        $juchuu_dt->Sakusei_user_id = $this->request->getPost("sakusei_user_id");
        $juchuu_dt->Created = $this->request->getPost("created");
        $juchuu_dt->Kousin_user_id = $this->request->getPost("kousin_user_id");
        $juchuu_dt->Updated = $this->request->getPost("updated");
        

        if (!$juchuu_dt->save()) {

            foreach ($juchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "juchuu_dts",
                'action' => 'edit',
                'params' => [$juchuu_dt->id]
            ]);

            return;
        }

        $this->flash->success("juchuu_dt was updated successfully");

        $this->dispatcher->forward([
            'controller' => "juchuu_dts",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a juchuu_dt
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $juchuu_dt = JuchuuDts::findFirstByid($id);
        if (!$juchuu_dt) {
            $this->flash->error("juchuu_dt was not found");

            $this->dispatcher->forward([
                'controller' => "juchuu_dts",
                'action' => 'index'
            ]);

            return;
        }

        if (!$juchuu_dt->delete()) {

            foreach ($juchuu_dt->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "juchuu_dts",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("juchuu_dt was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "juchuu_dts",
            'action' => "index"
        ]);
    }

	public function copyfrompropAction()
	{
		if ($this->db->execute('TRUNCATE TABLE sfn.juchuu_dts')) { // 全削除
			$this->flash->success("juchuu_dt was deleted successfully");
		} else {
			$this->flash->error("juchuu_dt was not deleted ERROR!!");
		}
		$sql='INSERT INTO sfn.juchuu_dts (
				cd,
				nendo,
				tekiyou,
				juchuubi,
				tokuisaki_mr_cd,
				torihiki_kbn_cd,
				zei_tenka_kbn_cd,
				tantou_mr_cd,
				saki_hacchuu_cd,
				nounyuusaki,
				sakusei_user_id,
				created,
				kousin_user_id,
				updated)
			SELECT
				kakou_no,
				year(date_add(hakkou_date, interval "61" DAY))-1,
				bikou1,
				hakkou_date,
				"SMM",
				"1",
				"10",
				"82",
				substr(kakou_no,1,4),
				urisaki,
				5,
				hakkou_date,
				5,
				hakkou_date
			FROM iraikiroku_vws group by substr(kakou_no,1,4)';
		if ($this->db->execute($sql)) {
			$this->flash->success("juchuu_dt was created successfully");
		} else {
			$this->flash->error("juchuu_dt was not created ERROR!!");
		}
/** デバッグ
 echo "<pre>";
 var_dump($rows);
 echo "</pre>";
 return;
*/
        $this->dispatcher->forward([
            'controller' => "juchuu_dts",
            'action' => "search"
        ]);
	}

}
