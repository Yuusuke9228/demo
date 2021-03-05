<?php

use Phalcon\Mvc\Controller;

class BackupController extends ControllerBase
{

	/**
	 * Index action
	 */
	public function indexAction()
	{
		//echo "\n<br>start";
		$config = $this->db->getDescriptor();
		$filePath = "/var/local/dbsave/";
		$fileName = $config["dbname"] . "_dbdump_" . date("d") . ".sql";
		$command = "mysqldump " . $config["dbname"]
			. " --host=" . $config["host"]
			. " --user=" . $config["username"]
			. " --password=" . $config["password"]
			. " > " . $filePath . $fileName;
		//echo "\n<br>".$command;
		$retint = 0;
		$retstr = system($command, $retint);

		//echo "\n<br>(".$retint.")".$retstr;

		if ($retint) {
			$this->flash->error("バックアップが失敗しました。(" . $retint . ":" . $retstr . ")");
			$this->view->exp = null;
		} else {
			$this->flash->success("バックアップが完了しました。" . $filePath . $fileName);
			$this->view->exp = $this->url->get('backup/download/' . date("d")); //
		}

		$this->dispatcher->forward(array(
			'controller' => "navigators"
		));
	}


	public function downloadAction($day = 0)
	{
		$day = $day ?? date("d");
		$config = $this->db->getDescriptor();
		$filePath = "/var/local/dbsave/";
		$fileName = $config["dbname"] . "_dbdump_" . $day . ".sql";
		//保存したらダウンロード
		$dlFile = $filePath . $fileName;    //ファイルパス
		header('Content-Type: application/octet-stream');   //ダウンロードの指示
		header('Content-Disposition: attachment; filename="' . $fileName . '"');    //ダウンロードするファイル名
		header('Content-Length: ' . filesize($dlFile));       //ファイルサイズを指定することでプログレスバーが表示される。
		ob_end_clean(); //ファイル破損を防ぐ //出力バッファのゴミ捨て
		readfile($dlFile);
		exit;
	}
}
