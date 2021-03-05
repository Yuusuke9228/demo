<?php

use TokuisakiTankaDts;

class TokuisakiTankaDtsController extends ControllerBase
{
    /**
     *
     * @return array
     */
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $tokuisaki_mr_cd = $this->request->getPost('tokuisaki_mr_cd');
            $shouhin_mr_cd_from = $this->request->getPost('shouhin_mr_cd_from');
            $shouhin_mr_cd_to = $this->request->getPost('shouhin_mr_cd_to');

            if ($tokuisaki_mr_cd === '') {
                // 得意先が空なら、空配列を返す
                return $this->view->shouhin_list = [];
            }
            $where = '';
            if ($shouhin_mr_cd_from !== '') {
                if ($shouhin_mr_cd_to !== '') {
                    $where = "WHERE a.cd BETWEEN '${shouhin_mr_cd_from}' AND '${shouhin_mr_cd_to}' ";
                } else {
                    $where = "WHERE a.cd BETWEEN '${shouhin_mr_cd_from}' AND 'ZZZZZZZZZZZ' ";
                }
            } else {
                if ($shouhin_mr_cd_to !== '') {
                    $where = "WHERE a.cd BETWEEN '00000000' AND '${shouhin_mr_cd_to}' ";
                } else {
                    $where = "WHERE a.cd BETWEEN '00000000' AND 'ZZZZZZZZZZZ' ";
                }
            }
            // 在庫管理市内の商品は表示しない
            $where .= "AND a.zaikokanri = 1";
            $db = \Phalcon\DI::getDefault()->get('db');

            if ($this->request->getPost('flg') === '1') {
                // 全商品表示
                $phql = "
                    SELECT
                        a.id, a.cd AS cd, a.name AS name, b.name AS tani1, c.name AS tani2,
                        a.joudai AS joudai, a.uri_tanka1 AS uri_tanka1, a.tanka_kbn AS tanka_kbn,
                        a.uri_genka AS uri_genka, d.tanka AS tokuisaki_betsu_tanka, 
                        d.updated_at AS apdated_at
                    FROM shouhin_mrs AS a
                    LEFT JOIN tanni_mrs AS b ON b.cd = a.tanni_mr1_cd
                    LEFT JOIN tanni_mrs AS c ON c.cd = a.tanni_mr2_cd
                    LEFT JOIN tokuisaki_tanka_dts AS d ON d.shouhin_mr_cd = a.cd 
                          AND d.tokuisaki_mr_cd = ${tokuisaki_mr_cd}
                    " . $where . "
                    ORDER BY a.cd
                ";

                $stmt = $db->prepare($phql);
                $stmt->execute();
                $shouhin_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            } else {
                // 販売履歴が有るもの
                $phql = "
                    SELECT
                        a.id, a.cd AS cd, a.name AS name, b.name AS tani1, c.name AS tani2,
                        a.joudai AS joudai, a.uri_tanka1 AS uri_tanka1, a.tanka_kbn AS tanka_kbn,
                        a.uri_genka AS uri_genka, d.tanka AS tokuisaki_betsu_tanka, 
                        d.updated_at AS updated_at
                    FROM shouhin_mrs AS a
                    LEFT JOIN tanni_mrs AS b ON b.cd = a.tanni_mr1_cd
                    LEFT JOIN tanni_mrs AS c ON c.cd = a.tanni_mr2_cd
                    LEFT JOIN tokuisaki_tanka_dts AS d ON d.shouhin_mr_cd = a.cd AND d.tokuisaki_mr_cd = ${tokuisaki_mr_cd}
                    " . $where . "
                    ORDER BY a.cd
                ";
                $stmt = $db->prepare($phql);
                $stmt->execute();
                $shouhin_list_bases = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $uriage_list_sql = "
                    SELECT
                        b.shouhin_mr_cd AS shouhin_mr_cd,
                        b.tanka AS tanka,
                        MAX(a.uriagebi) AS saisyuu_uriagebi
                    FROM uriage_dts AS a
                    LEFT JOIN uriage_meisai_dts AS b ON b.uriage_dt_id = a.id
                    WHERE a.tokuisaki_mr_cd = ${tokuisaki_mr_cd}
                    GROUP BY b.shouhin_mr_cd
                ";
                $stmt = $db->prepare($uriage_list_sql);
                $stmt->execute();
                $uriage_lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $shouhin_list = [];
                $j = 0;
                $saisyuu_tanka = 0;
                $flg = false;
                // 不要な要素を削除
                for ($i = 0; $i < count($shouhin_list_bases); $i++) {
                    for ($c = 0; $c < count($uriage_lists); $c++) {
                        if ($shouhin_list_bases[$i]['cd'] === $uriage_lists[$c]['shouhin_mr_cd']) {
                            $flg = true;
                            $saisyuu_tanka = $uriage_lists[$c]['tanka'];
                            break;
                        } else {
                            $flg = false;
                        }
                    }
                    if ($flg) {
                        $shouhin_list[$j] = $shouhin_list_bases[$i];
                        $shouhin_list[$j]['saisyuu_tanka'] = $saisyuu_tanka;
                        $j++;
                    }
                    $flg = false;
                }
            }

            $this->tag->setDefault('tokuisaki_mr_cd', $this->request->getPost('tokuisaki_mr_cd'));
            $this->tag->setDefault('tokuisaki_name', $this->request->getPost('tokuisaki_name'));
            $this->tag->setDefault('shouhin_mr_cd_from', $this->request->getPost('shouhin_mr_cd_from'));
            $this->tag->setDefault('shouhin_mr_cd_to', $this->request->getPost('shouhin_mr_cd_to'));
            $this->tag->setDefault('flg', $this->request->getPost('flg'));

            return $this->view->shouhin_list = $shouhin_list;
        } else {
            // POST以外は空配列を返却
            return $this->view->shouhin_list = [];
        }
    }

    /**
     * 商品毎に得意先別の設定単価を一覧表示
     *
     * @return Object
     */
    public function shouhin_indexAction() {
        if ($this->request->isPost()) {
            $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');

            if ($shouhin_mr_cd === '') {
                // 商品コードが空なら、空配列を返す
                return $this->view->tokuisaki_list = [];
            }
            //原価0の商品 & 在庫管理市内の商品は表示しない
            $where = "WHERE c.uri_genka > 0 AND c.zaikokanri = 1 ";

            $db = \Phalcon\DI::getDefault()->get('db');
            $phql = "
                SELECT
                    a.id, a.cd AS cd, a.name AS name, sub.tani1 AS tani1,sub.tani2 AS tani2,
                    sub.joudai AS joudai, sub.uri_tanka1 AS uri_tanka1, sub.tanka_kbn AS tanka_kbn,
                    sub.uri_genka AS uri_genka, sub.tokuisaki_betsu_tanka AS tokuisaki_betsu_tanka
                FROM tokuisaki_mrs AS a
                LEFT JOIN
                    (
                        SELECT
                            sub_a.cd AS shouhin_mr_cd,sub_b.tokuisaki_mr_cd AS tokuisaki_mr_cd,
                            sub_a.joudai AS joudai, sub_a.uri_tanka1 AS uri_tanka1, sub_a.tanka_kbn AS tanka_kbn,
                            sub_a.uri_genka AS uri_genka, sub_c.name AS tani1,sub_d.name AS tani2,
                            sub_b.tanka AS tokuisaki_betsu_tanka
                        FROM shouhin_mrs AS sub_a
                        LEFT JOIN tokuisaki_tanka_dts AS sub_b ON sub_b.shouhin_mr_cd = sub_a.cd
                        LEFT JOIN tanni_mrs AS sub_c ON sub_c.cd = sub_a.tanni_mr1_cd
                        LEFT JOIN tanni_mrs AS sub_d ON sub_d.cd = sub_a.tanni_mr2_cd
                        WHERE sub_a.uri_genka > 0 AND sub_a.zaikokanri = 1 AND sub_a.cd = '${shouhin_mr_cd}'
                    ) AS sub ON sub.tokuisaki_mr_cd = a.cd
                ORDER BY a.cd
            ";

            $stmt = $db->prepare($phql);
            $stmt->execute();
            $tokuisaki_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $this->tag->setDefault('shouhin_mr_cd', $this->request->getPost('shouhin_mr_cd'));
            $this->tag->setDefault('shouhin_name', $this->request->getPost('shouhin_name'));
            $this->tag->setDefault('joudai', $this->request->getPost('joudai'));
            $this->tag->setDefault('uri_tanka', $this->request->getPost('uri_tanka'));
            $this->tag->setDefault('shouhin_tani', $this->request->getPost('shouhin_tani'));
            return $this->view->tokuisaki_list = $tokuisaki_list;
        } else {
            //POST以外は空配列を返却
            return $this->view->tokuisaki_list = [];
        }
    }

    /**
     *
     * Ajaxで更新
     */
    public function saveAjaxAction()
    {
        header("Content-type: text/plain; charset=UTF-8");
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "Error: Not Ajax!!";
        }
        $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');
        $tanka = (float)$this->request->getPost('tanka');
        $tokuisaki_mr_cd = $this->request->getPost('tokuisaki_mr_cd');

        $count = TokuisakiTankaDts::count([
            "conditions" => "shouhin_mr_cd = '${shouhin_mr_cd}' AND tokuisaki_mr_cd = '${tokuisaki_mr_cd}'",
        ]);

        $db = \Phalcon\DI::getDefault()->get('db');
        $created_at = $this->created_at = date("Y-m-d H:i:s");
        $sakusei_user_id = $this->sakusei_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];
        $updated_at = $this->updated_at = date("Y-m-d H:i:s");
        $kousin_user_id = $this->kousin_user_id = (int)$this->getDI()->getSession()->get('auth')['id'];

        if ($count > 0 ) {
            $phql = "UPDATE tokuisaki_tanka_dts SET tanka = ${tanka} WHERE shouhin_mr_cd = '${shouhin_mr_cd}' AND tokuisaki_mr_cd = '${tokuisaki_mr_cd}'";
        } else {
            $phql = "
                INSERT INTO
                    tokuisaki_tanka_dts(shouhin_mr_cd, tokuisaki_mr_cd, tanka, sakusei_user_id, created_at, kousin_user_id, updated_at) 
                VALUES 
                   ('${shouhin_mr_cd}', '${tokuisaki_mr_cd}', ${tanka}, ${sakusei_user_id}, '${created_at}', ${kousin_user_id}, '${updated_at}')"
            ;
        }
        $stmt = $db->prepare($phql);
        $stmt->execute();

        $response->setContent(json_encode($this->request->getPost()));
        return $response;
    }

    /**
     * @return \Phalcon\Http\Response
     */
    public function ajaxGetAction()
    {
        $this->view->disable();
        $response = new \Phalcon\Http\Response();
        if (!$this->request->isAjax()) {
            echo "Error: Request error!!";
        }
        $tokuisaki_tanka = TokuisakiTankaDts::find([
            'order' => 'id',
            'columns' => 'shouhin_mr_cd, tokuisaki_mr_cd, tanka',
            'conditions' => ' shouhin_mr_cd = ?1 AND tokuisaki_mr_cd = ?2',
            'bind' => [1 => $this->request->getPost('cd'), 2 => $this->request->getPost('tokuisaki_mr_cd')],
        ]);

        return $response->setContent(json_encode($tokuisaki_tanka));
    }

    /**
     * Back Out a tokuisaki_tanka_dt
     * @TODO テーブル・コード未実装
     * 必要なら作る
     *
     * @param string $tokuisaki_tanka_dt, $dlt_flg
     */
//    public function _bakOut($tokuisaki_tanka_dt, $dlt_flg = 0)
//    {
//
//    }
}
