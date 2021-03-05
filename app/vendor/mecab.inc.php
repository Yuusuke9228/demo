<?php
/*
* Add By Nishiyama 2019/10/24
*/


class Mecab
{
    private function mecab_exec($input, $opt = false)
    {
        $mecab_cmd = "/opt/mecab/bin/mecab";
        $tmp_dir = sys_get_temp_dir();
        $file_in = tempnam($tmp_dir, 'mecab-in-');
        $file_out = tempnam($tmp_dir, 'mecab-out-');
        if ($opt === false) {
            $opt = "-b " . (1024 * 64) . '/opt/mecab/lib/mecab/dic/neologd';
        }
        file_put_contents($file_in, $input . "\n");
        $cmd = "\"$mecab_cmd\" $opt \"$file_in\" -o \"$file_out\"";
        exec($cmd);
        $out = file_get_contents($file_out);
        unlink($file_in);
        unlink($file_out);
        return $out;
    }

    public function mecab_parse($input, $mecab_opt = false)
    {
        $out = $this->mecab_exec($input, $mecab_opt);
        $lines = explode("\n", trim($out));
        $result = [];
        foreach ($lines as $line) {
            list($word, $params) = explode("\t", $line . "\t");
            $list = explode(",", trim($params));
            array_unshift($list, $word);
            $result[] = $list;
        }
        return $result;
    }

    public function mecab_parse_simple($input, $mecab_opt = false)
    {
        $out = $this->mecab_exec($input, $mecab_opt);
        $lines = explode("\n", trim($out));
        $res = [];
        foreach ($lines as $line) {
            $res[] = trim(substr($line, 0, strpos($line, "\t")));
        }
        return $res;
    }

    public function return_kana($req)
    {
        $reading = '';
        foreach ($req as $v) {
            $word = $v[0];
            if (preg_match('/^[a-zA-Z0-9]+$/', $word)) {
                $reading .= mb_convert_kana($word, "k");
                continue;
            }
            if (strpos(",.、。", $word) !== false) {
                $reading .= mb_convert_kana($word, "k");
                continue;
            }
            if (preg_match('/^[ｦ-ﾟｰ ]+$/u', $word)) {
                $reading .= mb_convert_kana($word, "k");
                continue;
            }
            if (preg_match('/^[[:graph:]|[:space:]]+$/i', $word)) {
                $reading .= $word;
                continue;
            }
            if ($word === 'EOS') continue;
            $tmp = isset($v[4]) ? $v[8] : "";
            $reading .= mb_convert_kana($tmp, "k");
        }
        if (strpos($reading, 'ﾋｶﾞｼﾚ') !== false) {
            $reading = str_replace('ﾋｶﾞｼﾚ', 'ﾄｳﾚ', $reading);
        } elseif (strpos($reading, 'ﾐﾅﾐｱ') !== false) {
            $reading = str_replace('ﾐﾅﾐｱ', 'ﾅﾝﾔ', $reading);
        }
        return $reading;
    }
}
