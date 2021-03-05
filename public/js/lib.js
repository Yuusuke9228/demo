//英数全角→半角 Add By Nishiyama 2019-10-23
function toHalfWidth(elm)
{
    return elm.replace(/[Ａ-Ｚａ-ｚ０-９！-～]/g, function (s)
    {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
}

//カナ全角→半角 Add By Nishiyama 2019-10-23
function zenkakuToHankaku(mae)
{
    let zen = ['ア', 'イ', 'ウ', 'エ', 'オ', 'カ', 'キ', 'ク', 'ケ', 'コ'
        , 'サ', 'シ', 'ス', 'セ', 'ソ', 'タ', 'チ', 'ツ', 'テ', 'ト'
        , 'ナ', 'ニ', 'ヌ', 'ネ', 'ノ', 'ハ', 'ヒ', 'フ', 'ヘ', 'ホ'
        , 'マ', 'ミ', 'ム', 'メ', 'モ', 'ヤ', 'ヰ', 'ユ', 'ヱ', 'ヨ'
        , 'ラ', 'リ', 'ル', 'レ', 'ロ', 'ワ', 'ヲ', 'ン'
        , 'ガ', 'ギ', 'グ', 'ゲ', 'ゴ', 'ザ', 'ジ', 'ズ', 'ゼ', 'ゾ'
        , 'ダ', 'ヂ', 'ヅ', 'デ', 'ド', 'バ', 'ビ', 'ブ', 'ベ', 'ボ'
        , 'パ', 'ピ', 'プ', 'ペ', 'ポ'
        , 'ァ', 'ィ', 'ゥ', 'ェ', 'ォ', 'ャ', 'ュ', 'ョ', 'ッ'
        , '゛', '°', '、', '。', '「', '」', 'ー', '・'];
    let han = ['ｱ', 'ｲ', 'ｳ', 'ｴ', 'ｵ', 'ｶ', 'ｷ', 'ｸ', 'ｹ', 'ｺ'
        , 'ｻ', 'ｼ', 'ｽ', 'ｾ', 'ｿ', 'ﾀ', 'ﾁ', 'ﾂ', 'ﾃ', 'ﾄ'
        , 'ﾅ', 'ﾆ', 'ﾇ', 'ﾈ', 'ﾉ', 'ﾊ', 'ﾋ', 'ﾌ', 'ﾍ', 'ﾎ'
        , 'ﾏ', 'ﾐ', 'ﾑ', 'ﾒ', 'ﾓ', 'ﾔ', 'ｲ', 'ﾕ', 'ｴ', 'ﾖ'
        , 'ﾗ', 'ﾘ', 'ﾙ', 'ﾚ', 'ﾛ', 'ﾜ', 'ｦ', 'ﾝ'
        , 'ｶﾞ', 'ｷﾞ', 'ｸﾞ', 'ｹﾞ', 'ｺﾞ', 'ｻﾞ', 'ｼﾞ', 'ｽﾞ', 'ｾﾞ', 'ｿﾞ'
        , 'ﾀﾞ', 'ﾁﾞ', 'ﾂﾞ', 'ﾃﾞ', 'ﾄﾞ', 'ﾊﾞ', 'ﾋﾞ', 'ﾌﾞ', 'ﾍﾞ', 'ﾎﾞ'
        , 'ﾊﾟ', 'ﾋﾟ', 'ﾌﾟ', 'ﾍﾟ', 'ﾎﾟ'
        , 'ｧ', 'ｨ', 'ｩ', 'ｪ', 'ｫ', 'ｬ', 'ｭ', 'ｮ', 'ｯ'
        , 'ﾞ', 'ﾟ', '､', '｡', '｢', '｣', 'ｰ', '･'];
    let ato = "";
    for (let i = 0; i < mae.length; i++)
    {
        let maechar = mae.charAt(i);
        let zenindex = zen.indexOf(maechar);
        if (zenindex >= 0)
        {
            maechar = han[zenindex];
        }
        ato += maechar;
    }
    return ato;
}

/*
 * 略称を作成 Add By Nishiyama 2019/10/23
 */
function make_ryakushou(input)
{
    if (input.indexOf('') !== -1)
    {
        replaced = input.replace(/株式会社/g, '(株)');
    } else if (input.indexOf('') !== -1)
    {
        replaced = input.replace(/有限会社/g, '(有)');
    } else
    {
        replaced = input;	//そのまま返却
    }
    var text = substr(replaced, 18, '');
    return text;
}

function substr(text, len, truncation)
{
    if (truncation === undefined) { truncation = ''; }
    var text_array = text.split('');
    var count = 0;
    var str = '';
    for (i = 0; i < text_array.length; i++)
    {
        var n = escape(text_array[i]);
        if (n.length < 4) count++;
        else count += 2;
        if (count > len)
        {
            return str + truncation;
        }
        str += text.charAt(i);
    }
    return text;
}