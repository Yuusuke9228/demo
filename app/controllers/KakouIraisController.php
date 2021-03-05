<?php
 


class KakouIraisController extends ControllerBase
{
    /**
     * Index action
     * 加工依頼のデータを取得してViewへ渡す
     *
     * @return void
     */
    public function indexAction()
    {
        if ($this->request->isPost()) {
            $startDate = $this->request->getPost('start_date');
            $endDate = $this->request->getPost('end_date');
        } else {
            $startDate = date("Y-m-01", strtotime("-3 month")); // 取り敢えずデフォルトで3ヶ月表示
            $endDate = date("Y-m-t");
        }

        $db = \Phalcon\DI::getDefault()->get('db');
        $phql = "
            select
                a.id as h_id,
                a.cd as h_cd,
                a.hacchuubi as hacchuubi,
                a.nounyuu_kijitu as nounyuu_kijitu,
                k.nouki_hensin as nouki_hensin,
                b.id as h_meisai_id,
                b.cd as row,
                a.shiiresaki_mr_cd as shiiresaki_mr_cd,
                g.name as shiiresaki_name,
                case when c.nyuuka_kbn_max = '5' then '完' when c.nyuuka_kbn_max = '8' then 'ｷｬﾝｾﾙ' else '' end as nyuuka_kbn,
                b.utiwake_kbn_cd as utiwake_kbn_cd,
                b.shouhin_mr_cd as shouhin_mr_cd,
                b.tekiyou as tekiyou,
                b.iro as iro,
                b.lot as lot,
                b.suuryou1 as suuryou1,
                e.name as tanni1,
                b.suuryou2 as suuryou2,
                b.keisu as keisu,
                f.name as tanni2,
                b.tanka as tanka,
                if(b.tanka_kbn=2, f.name, e.name) as tanka_tani,
                b.bikou as memo
            from hacchuu_dts as a
            left join hacchuu_meisai_dts as b on b.hacchuu_dt_id = a.id
            left join kakou_irais as k on k.h_meisai_id = b.id
            left join shiire_nyuuka_max_vws as c on c.hacchuu_dt_id = a.id and c.cd = b.shouhin_mr_cd and c.irocd = b.iro
            left join tanni_mrs as e on e.cd = b.tanni_mr1_cd
            left join tanni_mrs as f on f.cd = b.tanni_mr2_cd
            left join shiiresaki_mrs as g on g.cd = a.shiiresaki_mr_cd
            left join shouhin_mrs as h on h.cd = b.shouhin_mr_cd
            where ( a.hacchuubi between '{$startDate}' and '{$endDate}' )
            and a.shiiresaki_mr_cd not in (
                select cd as cd from shiiresaki_mrs where shiiresaki_bunrui5_kbn_cd = 'S'
            )
            and (b.bikou not like '%調整%' )
            order by a.id DESC, b.cd
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // 発注データを加工依頼で使用できる形に編集
        $data = [];
        $i = 0;
        $tempSuuryou = 0;
        $tempId = '';
        foreach ($rows as $row) {
            $tempId = $data[$i]['h_id'];
            if ($row['utiwake_kbn_cd'] === '20') {
                $data[$i]['h_id'] = $row['h_id'];
                $data[$i]['h_cd'] = $row['h_cd'];
                $data[$i]['h_meisai_id'] = $row['h_meisai_id'];
                $data[$i]['row'] = $row['row'];
                $data[$i]['shiiresaki_mr_cd'] = $row['shiiresaki_mr_cd'];
                $data[$i]['shiiresaki_name'] = $row['shiiresaki_name'];
                $data[$i]['nyuuka_kbn'] = $row['nyuuka_kbn'];
                $data[$i]['shouhin_mr_cd'] = $row['shouhin_mr_cd'];
                $data[$i]['tekiyou'] = $row['tekiyou'];
                $data[$i]['iro'] = $row['iro'];
                $data[$i]['lot'] = $row['lot'];
                $data[$i]['suuryou1'] = $row['suuryou1'];
                $data[$i]['tanni1'] = $row['tanni1'];
                $data[$i]['nouki'] = $row['nouki'];
                $data[$i]['suuryou2'] = $row['suuryou2'];
                $tempSuuryou = (float)$row['suuryou2'];
                $data[$i]['tanni2'] = $row['tanni2'];
                $data[$i]['lot'] = $row['lot'];
                $data[$i]['hacchuubi'] = $row['hacchuubi'];
                $data[$i]['nounyuu_kijitu'] = $row['nounyuu_kijitu'];
                $data[$i]['nouki_hensin'] = $row['nouki_hensin'];
            } else if ($row['utiwake_kbn_cd'] === '21') { // 原料
                if ($tempId === $row['h_id']) {
                    $data[$i]['genryou_cd'] .= $row['shouhin_mr_cd'] . ',';
                    $data[$i]['genryou_name'] .= $row['tekiyou'] . ',';
                    $data[$i]['konritsu'] .= $row['keisu'] . ',';
//                    try {
//                        $data[$i]['konritsu'] .= round(((float)$row['suuryou2'] / $tempSuuryou) * 100) . '%,';
//                    } catch (Exception $e) {
//                        $data[$i]['konritsu'] .= '0%,';
//                    }
                }
            } else if ($row['utiwake_kbn_cd'] === '10') { // 工賃か試作
                if ($row['shouhin_mr_cd'] == '988') { // 試作
                    continue; // 内訳１０は試作でも表示しない
//                    if ((float)$row['suuryou1'] < 0) {
//                        continue;
//                    } else if ((float)$row['suuryou2'] < 0) {
//                        continue;
//                    }
//                    $data[$i]['h_id'] = $row['h_id'];
//                    $data[$i]['h_meisai_id'] = $row['h_meisai_id'];
//                    $data[$i]['h_cd'] = $row['h_cd'];
//                    $data[$i]['row'] = $row['row'];
//                    $data[$i]['shiiresaki_mr_cd'] = $row['shiiresaki_mr_cd'];
//                    $data[$i]['shiiresaki_name'] = $row['shiiresaki_name'];
//                    $data[$i]['nyuuka_kbn'] = $row['nyuuka_kbn'];
//                    $data[$i]['shouhin_mr_cd'] = $row['shouhin_mr_cd'];
//                    $data[$i]['tekiyou'] = $row['tekiyou'];
//                    $data[$i]['iro'] = $row['iro'];
//                    $data[$i]['lot'] = $row['lot'];
//                    $data[$i]['suuryou1'] = $row['suuryou1'];
//                    $data[$i]['tanni1'] = $row['tanni1'];
//                    $data[$i]['nouki'] = $row['nouki'];
//                    $data[$i]['suuryou2'] = $row['suuryou2'];
//                    $data[$i]['tanni2'] = $row['tanni2'];
//                    $data[$i]['lot'] = $row['lot'];
//                    $data[$i]['kouchin'] = $row['tanka'];
//                    $data[$i]['tanka_tani'] = $row['tanka_tani'];
//                    $data[$i]['genryou_cd'] = '';
//                    $data[$i]['genryou_name'] = '';
//                    $data[$i]['konritsu'] = '0%';
//                    $data[$i]['hacchuubi'] = $row['hacchuubi'];
//                    $data[$i]['nounyuu_kijitu'] = $row['nounyuu_kijitu'];
//                    $data[$i]['nouki_hensin'] = $row['nouki_hensin'];
//                    $tempSuuryou = 0;
//                    $i++;
                } else { // 工賃
                    if ($data[$i]['shouhin_mr_cd']) {
                        if ($tempId === $data[$i]['h_id']) {
                            $data[$i]['kouchin'] = $row['tanka'];
                            $data[$i]['tanka_tani'] = $row['tanka_tani'];
                            $tempSuuryou = 0;
                            $i++;
                        }
                    }
                }
            } else {
                continue;
            }
        }

        $this->tag->setDefault("start_date", $startDate);
        $this->tag->setDefault("end_date", $endDate);
        $this->view->data = $data;
    }

    /**
     * 編集
     *
     * @return void
     */
    public function editAction()
    {
        $h_id = $this->request->getQuery('h_id');
        $h_meisai_id = $this->request->getQuery('h_meisai_id');
        $h_cd = $this->request->getQuery('h_cd');
        $meisaiRow = $this->request->getQuery('meisai_row');
        $genryouCds = $this->request->getQuery('genryou_cd');
        $genryouNames = $this->request->getQuery('genryou_name');
        $konritsu = $this->request->getQuery('konritsu');
        $koutin = $this->request->getQuery('koutin');
        $tanka_tani = $this->request->getQuery('tanka_tani');
        if ($this->request->getQuery('message')) {
            $message = $this->request->getQuery('message');
        } else {
            $message = '';
        }

        $db = \Phalcon\DI::getDefault()->get('db');
        // 発注データ
        $phql = "
            select
                a.id as h_id,
                a.cd as h_cd,
                a.nounyuu_kijitu as nounyuu_kijitu,
                b.id as h_meisai_id,
                a.hacchuubi as hacchuubi,
                c.name as shiiresaki_name,
                a.juchuu_dt_cd as juchuu_no,
                d.name as tantou_name,
                b.shouhin_mr_cd as shouhin_mr_cd,
                b.tekiyou as tekiyou,
                b.lot as lot,
                b.suuryou1 as suuryou1,
                e.name as tanni1,
                b.suuryou2 as suuryou2,
                f.name as tanni2,
                b.utiwake_kbn_cd as utiwake
            from hacchuu_dts as a 
            left join hacchuu_meisai_dts as b on b.hacchuu_dt_id = a.id
            left join shiiresaki_mrs as c on c.cd = a.shiiresaki_mr_cd
            left join tantou_mrs as d on d.cd = a.tantou_mr_cd
            left join tanni_mrs as e on e.cd = b.tanni_mr1_cd
            left join tanni_mrs as f on f.cd = b.tanni_mr2_cd
            where a.id = {$h_id} and b.id = {$h_meisai_id}
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($data[0]['juchuu_no'] > 0) {
            $query = $this->modelsManager->createQuery("select id from JuchuuDts where cd = {$data[0]['juchuu_no']}");
            $juchuuModel = $query->execute();
        } else {
            $juchuuModel = '';
        }

        $this->tag->setDefault('h_id', $h_id);
        $this->tag->setDefault('h_meisai_id', $h_meisai_id);
        $this->tag->setDefault('h_cd', $h_cd);
        $this->tag->setDefault('meisai_row', $meisaiRow);
        $this->tag->setDefault('nouki_memo', $data[0]['nounyuu_kijitu']);
        if ($juchuuModel !== '') {
            $this->tag->setDefault('juchuu_id', $juchuuModel[0]['id']);
            $this->tag->setDefault('juchuu_no', $data[0]['juchuu_no']);
        }
        $this->tag->setDefault('koutin', $koutin);
        $this->tag->setDefault('tanka_tani', $tanka_tani);
        $this->tag->setDefault('shiiresaki_name', $data[0]['shiiresaki_name']);
        $this->tag->setDefault('hacchuubi', $data[0]['hacchuubi']);
        $this->tag->setDefault('tantou_name', $data[0]['tantou_name']);
        $this->tag->setDefault('shouhin_mr_cd', $data[0]['shouhin_mr_cd']);
        $this->tag->setDefault('tekiyou', $data[0]['tekiyou']);
        $this->tag->setDefault('lot', $data[0]['lot']);
        $this->tag->setDefault('suuryou1', number_format($data[0]['suuryou1']));
        $this->tag->setDefault('tanni1', $data[0]['tanni1']);
        $this->tag->setDefault('suuryou2', number_format($data[0]['suuryou2'], 2));
        $this->tag->setDefault('tanni2', $data[0]['tanni2']);

        // 加工依頼内容取得
        $phql = "
            select * from kakou_irais where h_meisai_id = {$h_meisai_id}
        ";
        $stmt = $db->prepare($phql);
        $stmt->execute();
        $iraiData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->tag->setDefault('id', $iraiData[0]['id']);
        $this->tag->setDefault('sfn_cd', $iraiData[0]['sfn_cd']); // 承認状態を管理している
        $this->tag->setDefault('naiyou_1', $iraiData[0]['naiyou_1']);
        $this->tag->setDefault('naiyou_2', $iraiData[0]['naiyou_2']);
        $this->tag->setDefault('naiyou_3', $iraiData[0]['naiyou_3']);
        $this->tag->setDefault('naiyou_4', $iraiData[0]['naiyou_4']);
        $this->tag->setDefault('naiyou_5', $iraiData[0]['naiyou_5']);
        $this->tag->setDefault('naiyou_6', $iraiData[0]['naiyou_6']);
        $this->tag->setDefault('naiyou_7', $iraiData[0]['naiyou_7']);
        $this->tag->setDefault('naiyou_8', $iraiData[0]['naiyou_8']);
        $this->tag->setDefault('naiyou_9', $iraiData[0]['naiyou_9']);
        $this->tag->setDefault('naiyou_10', $iraiData[0]['naiyou_10']);
        $this->tag->setDefault('naiyou_11', $iraiData[0]['naiyou_11']);
        $this->tag->setDefault('naiyou_12', $iraiData[0]['naiyou_12']);
        $this->tag->setDefault('naiyou_13', $iraiData[0]['naiyou_13']);
        $this->tag->setDefault('nouki_memo2', $iraiData[0]['nouki_memo2']);
        $this->tag->setDefault('nouki_hensin', $iraiData[0]['nouki_hensin']);
        $this->tag->setDefault('gen_hensin', $iraiData[0]['gen_hensin']);
        $this->tag->setDefault('memo_1', $iraiData[0]['memo_1']);
        $this->tag->setDefault('memo_2', $iraiData[0]['memo_2']);
        $this->tag->setDefault('sai_fax_memo', $iraiData[0]['sai_fax_memo']);
        $this->tag->setDefault('synai_memo1', $iraiData[0]['synai_memo1']);
        $this->tag->setDefault('synai_memo2', $iraiData[0]['synai_memo2']);
        $this->tag->setDefault('memo_2', $iraiData[0]['memo_2']);
        $this->tag->setDefault('memo_2', $iraiData[0]['memo_2']);
        $this->tag->setDefault('kishumei', $iraiData[0]['kishumei']);
        $this->tag->setDefault('gen_nyuuka_honsuu', $iraiData[0]['gen_nyuuka_honsuu']);
        $this->tag->setDefault('gen_nyuuka_tanni', $iraiData[0]['gen_nyuuka_tanni']);
        $this->tag->setDefault('gen_nyuukabi', $iraiData[0]['gen_nyuukabi']);
        $this->tag->setDefault('asistant', $iraiData[0]['asistant']);
        $this->tag->setDefault('gotantousha', $iraiData[0]['gotantousha']);
        $this->tag->setDefault('genryou_cds', $genryouCds);
        $this->tag->setDefault('genryou_names', $genryouNames);
        $this->tag->setDefault('konritsu', $konritsu);
        $this->tag->setDefault('updated', $iraiData[0]['updated']);
        if ($iraiData[0]['kousin_user_id']) {
            $users = Users::find('id = ' . $iraiData[0]['kousin_user_id']);
            foreach ($users as $user) {
                $this->tag->setDefault('kousin_user_id', $user->name);
            }
        }


        if ($message !== '') {
            $this->view->message = $message;
        }
        $this->view->genryou_cds = explode(',', $genryouCds);
        $this->view->genryou_names = explode(',', $genryouNames);
        $this->view->konritsus = explode(',', $konritsu);
    }

    /**
     * Saves a kakou_irai edited
     *
     * @return void
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->error('POSTリクエストしか更新処理を行えません。');
            $this->dispatcher->forward([
                'controller' => "kakou_irais",
                'action' => 'index'
            ]);
            return;
        }
        $id = $this->request->getPost("id");
        $h_id = $this->request->getPost('h_id');
        $h_meisai_id = $this->request->getPost('h_meisai_id');
        // リダイレクト時に必要
        $h_cd = $this->request->getPost('h_cd');
        $meisaiRow = $this->request->getPost('meisai_row');
        $genryouCds = $this->request->getPost('genryou_cds');
        $genryouNames = $this->request->getPost('genryou_names');
        $konritsu = $this->request->getPost('konritsu');
        $koutin = $this->request->getPost('koutin');
        $tankaTanni = $this->request->getPost('tanka_tani');

        $kakou_irai = KakouIrais::findFirstByid($id);
        if (!$kakou_irai) {
            // idで見つからない場合、新規登録
            $kakou_irai = new KakouIrais();
        }
        $kakou_irai->h_id = $h_id;
        $kakou_irai->h_meisai_id = $h_meisai_id;
        $kakou_irai->meisai_row = $meisaiRow;
        $kakou_irai->nouki_memo2 = $this->request->getPost("nouki_memo2");
        $kakou_irai->naiyou_1 = $this->request->getPost("naiyou_1");
        $kakou_irai->naiyou_2 = $this->request->getPost("naiyou_2");
        $kakou_irai->naiyou_3 = $this->request->getPost("naiyou_3");
        $kakou_irai->naiyou_4 = $this->request->getPost("naiyou_4");
        $kakou_irai->naiyou_5 = $this->request->getPost("naiyou_5");
        $kakou_irai->naiyou_6 = $this->request->getPost("naiyou_6");
        $kakou_irai->naiyou_7 = $this->request->getPost("naiyou_7");
        $kakou_irai->naiyou_8 = $this->request->getPost("naiyou_8");
        $kakou_irai->naiyou_9 = $this->request->getPost("naiyou_9");
        $kakou_irai->naiyou_10 = $this->request->getPost("naiyou_10");
        $kakou_irai->naiyou_11 = $this->request->getPost("naiyou_11");
        $kakou_irai->naiyou_12 = $this->request->getPost("naiyou_12");
        $kakou_irai->naiyou_13 = $this->request->getPost("naiyou_13");
        $kakou_irai->memo_1 = $this->request->getPost("memo_1");
        $kakou_irai->memo_2 = $this->request->getPost("memo_2");
        $kakou_irai->meisai = $this->request->getPost("meisai");
        $kakou_irai->gen_nyuukasaki = $this->request->getPost("gen_nyuukasaki");
        $kakou_irai->gen_nyuukabi = $this->request->getPost("gen_nyuukabi");
        $kakou_irai->sai_fax_memo = $this->request->getPost("sai_fax_memo");
        $kakou_irai->asistant = $this->request->getPost("asistant");
        $kakou_irai->kishumei = $this->request->getPost("kishumei");
        $kakou_irai->kakou_kbn = $this->request->getPost("kakou_kbn");
        $kakou_irai->sfn_cd = $this->request->getPost("sfn_cd");
        $kakou_irai->nouki_hensin = $this->request->getPost("nouki_hensin");
        $kakou_irai->gen_hensin = $this->request->getPost("gen_hensin");
        $kakou_irai->gen_nyuuka_honsuu = $this->request->getPost("gen_nyuuka_honsuu");
        $kakou_irai->gen_nyuuka_tanni = $this->request->getPost("gen_nyuuka_tanni");
        $kakou_irai->gen_nyuukabi = $this->request->getPost("gen_nyuukabi");
        $kakou_irai->synai_memo1 = $this->request->getPost("synai_memo1");
        $kakou_irai->synai_memo2 = $this->request->getPost("synai_memo2");
        $kakou_irai->sfn_cd = $this->request->getPost("sfn_cd");
        $kakou_irai->shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $kakou_irai->gotantousha = $this->request->getPost('gotantousha');
        if (!$kakou_irai->save()) {
            foreach ($kakou_irai->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->flash->error('データ保存時にエラーが発生しました。');
            $this->dispatcher->forward([
                'controller' => "kakou_irais",
                'action' => 'index',
            ]);
            return;
        }

        $message = "加工依頼データを更新しました。";
        $params = [];
        $params['h_id'] = $h_id;
        $params['h_cd'] = $h_cd;
        $params['h_meisai_id'] = $h_meisai_id;
        $params['meisai_row'] = $meisaiRow;
        $params['genryou_cd'] = $genryouCds;
        $params['genryou_name'] = $genryouNames;
        $params['konritsu'] = $konritsu;
        $params['koutin'] = $koutin;
        $params['tanka_tani'] = $tankaTanni;
        $params['message'] = $message;
        $getParams = http_build_query($params);
        header(
            "Location: http://192.168.11.199/demo/kakou_irais/edit?{$getParams}"
        );
    }

    /**
     * 加工依頼エクセル印刷（Excelテンプレートへデータを出力する）
     *
     * @return \Phalcon\Http\Response
     */
    public function excelPrintAction(): \Phalcon\Http\Response
    {
        if (!$this->request->isPost()) {
            $this->flash->error('POSTリクエストしか更新処理を行えません。');
            $this->dispatcher->forward([
                'controller' => "kakou_irais",
                'action' => 'index'
            ]);
        }
        $id = $this->request->getPost("id");
        $h_id = $this->request->getPost('h_id');
        $h_meisai_id = $this->request->getPost('h_meisai_id');
        // リダイレクト時に必要
        $h_cd = $this->request->getPost('h_cd');
        $meisaiRow = $this->request->getPost('meisai_row');
        $genryouCds = $this->request->getPost('genryou_cds');
        $genryouNames = $this->request->getPost('genryou_names');
        $konritsu = $this->request->getPost('konritsu');
        $koutin = $this->request->getPost('koutin');
        $tankaTanni = $this->request->getPost('tanka_tani');

        $kakou_irai = KakouIrais::findFirstByid($id);
        if (!$kakou_irai) {
            // idで見つからない場合、新規登録
            $kakou_irai = new KakouIrais();
        }
        $kakou_irai->h_id = $h_id;
        $kakou_irai->h_meisai_id = $h_meisai_id;
        $kakou_irai->meisai_row = $meisaiRow;
        $kakou_irai->nouki_memo2 = $this->request->getPost("nouki_memo2");
        $kakou_irai->naiyou_1 = $this->request->getPost("naiyou_1");
        $kakou_irai->naiyou_2 = $this->request->getPost("naiyou_2");
        $kakou_irai->naiyou_3 = $this->request->getPost("naiyou_3");
        $kakou_irai->naiyou_4 = $this->request->getPost("naiyou_4");
        $kakou_irai->naiyou_5 = $this->request->getPost("naiyou_5");
        $kakou_irai->naiyou_6 = $this->request->getPost("naiyou_6");
        $kakou_irai->naiyou_7 = $this->request->getPost("naiyou_7");
        $kakou_irai->naiyou_8 = $this->request->getPost("naiyou_8");
        $kakou_irai->naiyou_9 = $this->request->getPost("naiyou_9");
        $kakou_irai->naiyou_10 = $this->request->getPost("naiyou_10");
        $kakou_irai->naiyou_11 = $this->request->getPost("naiyou_11");
        $kakou_irai->naiyou_12 = $this->request->getPost("naiyou_12");
        $kakou_irai->naiyou_13 = $this->request->getPost("naiyou_13");
        $kakou_irai->memo_1 = $this->request->getPost("memo_1");
        $kakou_irai->memo_2 = $this->request->getPost("memo_2");
        $kakou_irai->meisai = $this->request->getPost("meisai");
        $kakou_irai->gen_nyuukasaki = $this->request->getPost("gen_nyuukasaki");
        $kakou_irai->gen_nyuukabi = $this->request->getPost("gen_nyuukabi");
        $kakou_irai->sai_fax_memo = $this->request->getPost("sai_fax_memo");
        $kakou_irai->asistant = $this->request->getPost("asistant");
        $kakou_irai->kishumei = $this->request->getPost("kishumei");
        $kakou_irai->kakou_kbn = $this->request->getPost("kakou_kbn");
        $kakou_irai->sfn_cd = $this->request->getPost("sfn_cd");
        $kakou_irai->nouki_hensin = $this->request->getPost("nouki_hensin");
        $kakou_irai->gen_hensin = $this->request->getPost("gen_hensin");
        $kakou_irai->gen_nyuuka_honsuu = $this->request->getPost("gen_nyuuka_honsuu");
        $kakou_irai->gen_nyuuka_tanni = $this->request->getPost("gen_nyuuka_tanni");
        $kakou_irai->gen_nyuukabi = $this->request->getPost("gen_nyuukabi");
        $kakou_irai->synai_memo1 = $this->request->getPost("synai_memo1");
        $kakou_irai->synai_memo2 = $this->request->getPost("synai_memo2");
        $kakou_irai->sfn_cd = $this->request->getPost("sfn_cd");
        $kakou_irai->shouhin_mr_cd = $this->request->getPost("shouhin_mr_cd");
        $kakou_irai->gotantousha = $this->request->getPost('gotantousha');
        if (!$kakou_irai->save()) {
            foreach ($kakou_irai->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->flash->error('データ保存時にエラーが発生しました。');
            $this->dispatcher->forward([
                'controller' => "kakou_irais",
                'action' => 'index',
            ]);
        }
        $post = $this->request->getPost();

        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel5.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include __DIR__ . '/../vendor/PHPExcel/Classes/PHPExcel/IOFactory.php'; //Include PHPExcel_IOFactory
        $objReader = PHPExcel_IOFactory::createReader("Excel2007");
        //テンプレートファイルパス
        $temp_dir = __DIR__ . '/temp/';
        $temp_path = $temp_dir . 'kakou_irais.xlsx';
        $PHPExcel = $objReader->load($temp_path);
        $sheet = $PHPExcel->getSheetByName("VIEW");
        $sheet->setCellValue('A3', $post['shiiresaki_name']);
        $sheet->setCellValue('A4', $post['gotantousha']);
        $sheet->setCellValue('H4', $post['h_cd']);
        // 明細IDは長いので、末尾3桁の前に‐を入れる
        $tempString = str_split($post['h_meisai_id']);
        array_splice($tempString, -3, 0, '-');
        $sheet->setCellValue('H5', implode('', $tempString));
        $sheet->setCellValue('G1', date('Y年m月d日', strtotime($post['hacchuubi'])));
        $sheet->setCellValue('G43', $post['tantou_name']);
        $sheet->setCellValue('B6', $post['shouhin_mr_cd']);
        $sheet->setCellValue('D6', $post['tekiyou']);
        $sheet->setCellValue('B13', $post['suuryou2']);
        $sheet->setCellValue('E13', $post['tanni2']);
        $sheet->setCellValue('G13', $post['suuryou1']);
        $sheet->setCellValue('I13', $post['tanni1']);
        $sheet->setCellValue('B15', $post['lot']);
        $sheet->setCellValue('B17', $post['koutin']);
        $sheet->setCellValue('G17', '/ ' . $post['tanka_tani']);
        $sheet->setCellValue('A20', $post['naiyou_1']);
        $sheet->setCellValue('A21', $post['naiyou_2']);
        $sheet->setCellValue('A22', $post['naiyou_3']);
        $sheet->setCellValue('A23', $post['naiyou_4']);
        $sheet->setCellValue('A24', $post['naiyou_5']);
        $sheet->setCellValue('A25', $post['naiyou_6']);
        $sheet->setCellValue('A26', $post['naiyou_7']);
        $sheet->setCellValue('A27', $post['naiyou_8']);
        $sheet->setCellValue('A28', $post['naiyou_9']);
        $sheet->setCellValue('A29', $post['naiyou_10']);
        $sheet->setCellValue('A30', $post['naiyou_11']);
        $sheet->setCellValue('A31', $post['naiyou_12']);
        $sheet->setCellValue('A32', $post['naiyou_13']);
        $sheet->setCellValue('B34', $post['nouki_memo']);
        $sheet->setCellValue('B35', $post['nouki_memo2']);
        $sheet->setCellValue('G34', $post['nouki_hensin']);
        $sheet->setCellValue('A37', $post['memo_1']);
        $sheet->setCellValue('A38', $post['memo_2']);
        $sheet->setCellValue('A41', $post['kishumei']);
        $user = Users::findFirst((int)$post['asistant']);
        $sheet->setCellValue('G44', $user->name);
        $sheet->setCellValue('A47', $post['sai_fax_memo']);
        if ($post['sai_fax_memo'] !== '') {
            $sheet->setCellValue('A1', '再FAX備考要確認');
        }
        // 原料情報はひとまとめにする
        $keys = array_keys($post);
        $genryouCd = '';
        $genryouName = '';
        $konritsu = '';
        foreach ($keys as $key) {
            if (preg_match('/genryou_cd_/', $key)) {
                $genryouCd .= $post[$key] . ',' . PHP_EOL;
            } else if (preg_match('/genryou_name_/', $key)) {
                $genryouName .= $post[$key] . ',' . PHP_EOL ;
            } else if (preg_match('/konritsu_/', $key)) {
                $konritsu .= $post[$key] . ',' . PHP_EOL;
            }
        }
        $sheet->setCellValue('G9', $genryouCd);
        $sheet->setCellValue('B9', $genryouName);
        $sheet->setCellValue('H9', $konritsu);
        $PHPExcel->setActiveSheetIndex(1);

        $filename = uniqid("kakou_irais_" . $post['hacchuubi'] . '_' . $post['shiiresaki_name'] . '-' . $post['shouhin_mr_cd'] . '_', true) . '.xlsx';
        $upload = __DIR__ . '/temp/';
        $path = $upload . $filename;
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save($path);

        $response = new \Phalcon\Http\Response();
        $response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->setHeader('Cache-Control', 'max-age=0');
        $response->setHeader('Cache-Control', 'max-age=1');
        $response->setContent(file_get_contents($path));
        unlink($path);

        return $response;
    }

    /**
     * 商品ベースで加工内容検索
     *
     * @return void
     */
    public function modal_meisaiAction()
    {
        if ($this->request->isPost()) {
            $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');
        } else {
            $shouhin_mr_cd = $this->request->getQuery('shouhin_mr_cd');
        }
        $query = $this->modelsManager->createQuery("select * from KakouIrais where shouhin_mr_cd = '{$shouhin_mr_cd}'");
        $details = $query->execute();

        $this->tag->setDefault('shouhin_mr_cd', $shouhin_mr_cd);
        $this->view->details = $details;
    }

    /**
     * 発注ベースで加工内容検索
     *
     * @return void
     */
    public function modal_hacchuuAction()
    {
        if ($this->request->isPost()) {
            $shouhin_mr_cd = $this->request->getPost('shouhin_mr_cd');
            $h_cd = $this->request->getPost('h_cd');
        } else {
            $shouhin_mr_cd = $this->request->getQuery('shouhin_mr_cd');
            $h_cd = $this->request->getQuery('h_cd');
        }
        $query = $this->modelsManager->createQuery("select id from HacchuuDts where cd = {$h_cd}");
        $hacchuuDts = $query->execute();
        $h_id = $hacchuuDts[0]['id'];
        $query = $this->modelsManager->createQuery("select * from KakouIrais where h_id = {$h_id} and shouhin_mr_cd = '{$shouhin_mr_cd}'");
        $details = $query->execute();

        $this->tag->setDefault('shouhin_mr_cd', $shouhin_mr_cd);
        $this->tag->setDefault('h_id', $h_id);
        $this->tag->setDefault('h_cd', $h_cd);
        $this->view->details = $details;
    }
}
