<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{

    private $_headerMenu = array(
        'navbar-left' => array(
            'menus' => array(
                'caption' => 'メニュー',
                'action' => 'index'
            ),
            'invoices' => array(
                'caption' => 'Invoices',
                'action' => 'index'
            ),
            'about' => array(
                'caption' => 'About',
                'action' => 'index'
            ),
            'contact' => array(
                'caption' => 'Contact',
                'action' => 'index'
            ),
        ),
        'navbar-right' => array(
            'session' => array(
                'caption' => 'Log In/Sign Up',
                'action' => 'index'
            ),
        )
    );

    private $_tabs = array(
        '導入' => array(
            'controller' => 'navigators',
            'action' => 'dounyuu',
            'any' => false
        ),
        '売上' => array(
            'controller' => 'navigators',
            'action' => 'uriage',
            'any' => false
        ),
        '売上レポート' => array(
            'controller' => 'navigators',
            'action' => 'uriagerepo',
            'any' => false
        ),
        '仕入' => array(
            'controller' => 'navigators',
            'action' => 'shiire',
            'any' => false
        ),
        '在庫' => array(
            'controller' => 'navigators',
            'action' => 'zaiko',
            'any' => false
        ),
        '仕入在庫レポート' => array(
            'controller' => 'navigators',
            'action' => 'shiirezaikorepo',
            'any' => false
        ),
        '事業所データ' => array(
            'controller' => 'navigators',
            'action' => 'jigyousho',
            'any' => false
        )
    );

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        echo '<div id="navbar" class="navbar-collapse collapse">';
        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_navLeft();
            echo '<ul class="nav navbar-nav navbar-right">';
            echo   '<li>' . $this->tag->linkTo(array($this->view->getControllerName().'/new', '新規F2', 'id' => 'F2')) . '</li>';
            echo   '<li><a href="#" onclick="f8key();return false;">>参照F8</a></li>';
            echo   '<li class="dropdown">';
            echo     '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$this->getDI()->getSession()->get('auth')['name'].'<b class="caret"></b></a>';
            echo       '<ul class="dropdown-menu" role="menu">';
            echo         '<li>' . $this->tag->linkTo(array('users/edit/'.$this->getDI()->getSession()->get('auth')['id'], 'プロフィール修正', 'target'=>'_blank')) . '</li>';
            echo         '<li>' . $this->tag->linkTo('session/end', 'Log Out') . '</li>';
            echo       '</ul>';
            echo   '</li>';
        } else {
            echo '<ul class="nav navbar-nav navbar-right">';
            echo '  <li>' . $this->tag->linkTo('session', 'Log In/Sign Up') . '</li>';
        }
        echo   '</ul>';
        echo '</div>';

    }

    public function _navLeft()
    {
        echo   '<ul class="nav navbar-nav navbar-left">';
        echo     '<li class="dropdown">';
        echo       '<a href="#" class="dropdown-toggle" data-toggle="dropdown">台帳<b class="caret"></b></a>';
        echo       '<ul class="dropdown-menu" role="menu">';
        echo         '<li>' . $this->tag->linkTo(array('tokuisaki_mrs/new', '得意先台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">請求情報</a>';
        echo           '<ul class="dropdown-menu" role="menu">';
        echo             '<li>' . $this->tag->linkTo(array('shimegrp_kbns', '締グループ', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('nyuukin_kbns', '入金区分', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('shiiresaki_mrs/new', '仕入先台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">支払情報</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shimegrp_kbns', '締グループ', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('nyuukin_kbns', '支払区分', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('nyuukin_kbns', '振込依頼銀行', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('shouhin_mrs/new', '商品台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">商品価格表</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '得意先別', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '仕入先別', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '商品別売上', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '商品別仕入', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('kousei_buhin_mrs/new', '構成部品台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('kousei_buhin_mrs', '構成部品使用一覧', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('zaiko_henkan_dts/new?kbn=5', '導入時在庫入力', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('tantou_mrs', '担当者台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('souko_mrs', '倉庫台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('nounyuusaki_mrs/new', '納入先台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('menu_group_mrs/menu/2', '分類台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('project_mrs', 'プロジェクト一覧', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('denpyou_tekiyou_mrs', '伝票摘要台帳', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">予算設定</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '得意先別', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '商品別', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '担当者別', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">コード変更</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '得意先台帳...', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '仕入先台帳...', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '商品台帳...', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">単価一括変更</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '商品台帳...', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', 'セット商品台帳...', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '商品価格帯（得意先別/商品別売上）...', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shouhin_mrs', '商品価格帯（仕入先別/商品別仕入）...', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo       '</ul>';
        echo     '</li>';
        echo     '<li class="dropdown">';
        echo       '<a href="#" class="dropdown-toggle" data-toggle="dropdown">売上<b class="caret"></b></a>';
        echo       '<ul class="dropdown-menu" role="menu">';
        echo         '<li>' . $this->tag->linkTo(array('mitumori_dts/new', '見積書', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('juchuu_dts/new', '受注伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('uriage_dts/new', '売上伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('uriage_dts', '売上伝票承認...', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('uriage_dts', '今回の売上締切...', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">請求締</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('seikyuu_simekiri', '請求締切', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('seikyuusho_hakkou', '請求書発行', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('seikyuu_meisaisho', '請求明細書', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('seikyuu_simekiri_itiranhyou', '請求締切一覧表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('seikyuu_simekiri_torikesi', '請求締切の取消', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li>' . $this->tag->linkTo(array('nyuukin_dts/new', '入金伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('nyuukin_denpyou_shounin', '入金伝票承認...', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('konkai_nyuukin_simekiri', '今回の入金締切...', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('tokuisaki_mrs/motochou', '得意先元帳', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('urikake_zandaka_itiranhyou', '売掛残高一覧表', 'target'=>'_blank')) . '</li>';
        echo       '</ul>';
        echo     '</li>';
        echo     '<li class="dropdown">';
        echo       '<a href="#" class="dropdown-toggle" data-toggle="dropdown">仕入<b class="caret"></b></a>';
        echo       '<ul class="dropdown-menu" role="menu">';
        echo         '<li>' . $this->tag->linkTo(array('hacchuu_dts/new', '発注伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('hacchuu_dts', '発注一括作成', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('shiire_dts/new', '仕入伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('shiire_dts', '仕入伝票承認...', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('shiire_dts', '今回の仕入締切...', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">支払締</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shiharai_simekiri', '支払締切', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharaisho_hakkou', '支払書発行', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharai_meisaisho', '支払明細書', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharai_simekiri_itiranhyou', '支払締切一覧表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharai_simekiri_torikesi', '支払締切の取消', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li>' . $this->tag->linkTo(array('shukkin_denpyou', '出金伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('shukkin_denpyou_shounin', '出金伝票承認...', 'target'=>'_blank')) . '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">自動出金</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_naiyou_kakunin', '出金内容の確認', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_denpyou_jidou_sakusei', '出金伝票自動作成', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '銀行振込処理', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li>' . $this->tag->linkTo(array('konkai_shukkin_simekiri', '今回の出金締切...', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('shiiresaki_motochou', '仕入先元帳', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('kaikake_zandaka_itiranhyou', '買掛残高一覧表', 'target'=>'_blank')) . '</li>';
        echo       '</ul>';
        echo     '</li>';
        echo     '<li class="dropdown">';
        echo       '<a href="#" class="dropdown-toggle" data-toggle="dropdown">在庫<b class="caret"></b></a>';
        echo       '<ul class="dropdown-menu" role="menu">';
        echo         '<li>' . $this->tag->linkTo(array('zaiko_henkan_dts/new?kbn=3', '出庫伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('zaiko_henkan_dts/new?kbn=2', '倉庫移動伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('zaiko_henkan_dts/new?kbn=1', '生産伝票', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('kousei_buhin_mrs', '構成部品在庫照会', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('zaiko_kakunin_vws/summary', '在庫確認', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('report_zaiko_vws/index', '在庫一覧表', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('shimezaiko_dts', '棚卸一括調整', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('shouhin_mrs', '売上原価更新', 'target'=>'_blank')) . '</li>';
        echo       '</ul>';
        echo     '</li>';
        echo     '<li class="dropdown">';
        echo       '<a href="#" class="dropdown-toggle" data-toggle="dropdown">レポート<b class="caret"></b></a>';
        echo       '<ul class="dropdown-menu" role="menu">';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">見積レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shiharai_simekiri', '見積明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharaisho_hakkou', '見積一覧表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">受注レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('juchuu_meisai_dts/index', '受注明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharaisho_hakkou', '出荷予定一覧表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">売上レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('report_uriage', '売上明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_uriage/nippou', '売上日報', 'target'=>'_blank')) . '</li>';
        echo             '<li class="nav-divider"></li>';
        echo             '<li>' . $this->tag->linkTo(array('report_uriage/geppou', '売上月報', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_uriage/suii', '売上推移表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_uriage/junni', '売上順位表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_uriage/bunseki', '売上分析表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">予算レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shiharai_simekiri', '予算実績推移表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharaisho_hakkou', '予算実績対比表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">回収レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_naiyou_kakunin', '回収予定表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_denpyou_jidou_sakusei', '入金予定表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '回収状況一覧表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '受取手形一覧表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">入金レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_naiyou_kakunin', '入金明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_denpyou_jidou_sakusei', '入金日報', 'target'=>'_blank')) . '</li>';
        echo             '<li class="nav-divider"></li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '入金月報', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('konkai_shukkin_simekiri', '発注明細表', 'target'=>'_blank')) . '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">仕入レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_naiyou_kakunin', '仕入明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_denpyou_jidou_sakusei', '仕入日報', 'target'=>'_blank')) . '</li>';
        echo             '<li class="nav-divider"></li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '仕入月報', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '仕入推移表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '仕入順位表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '仕入分析表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">支払レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_naiyou_kakunin', '支払予定表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_denpyou_jidou_sakusei', '出金予定表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '支払状況一覧表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '支払手形一覧表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">出金レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_naiyou_kakunin', '出金明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shukkin_denpyou_jidou_sakusei', '出金日報', 'target'=>'_blank')) . '</li>';
        echo             '<li class="nav-divider"></li>';
        echo             '<li>' . $this->tag->linkTo(array('ginkou_furikomi_shori', '出金月報', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">在庫レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('report_zaiko_vws/shukko', '出庫明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_zaiko_vws/idou', '倉庫移動明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_zaiko_vws/nyuushukko', '入出庫明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li class="nav-divider"></li>';
        echo             '<li>' . $this->tag->linkTo(array('report_zaiko_vws/suii', '在庫推移表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_zaiko_vws/junni', '在庫順位表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('report_zaiko_vws/tairyuu', '滞留商品一覧表', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">生産レポート</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('shiharai_simekiri', '生産明細表', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('shiharaisho_hakkou', '生産日報', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('konkai_shukkin_simekiri', '売上仕入比較表', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('shiiresaki_motochou', 'プロジェクト実績一覧表', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('kaikake_zandaka_itiranhyou', '消費税集計表', 'target'=>'_blank')) . '</li>';
        echo       '</ul>';
        echo     '</li>';
        echo     '<li class="dropdown">';
        echo       '<a href="#" class="dropdown-toggle" data-toggle="dropdown">ツール<b class="caret"></b></a>';
        echo       '<ul class="dropdown-menu" role="menu">';
        echo         '<li class="dropdown-submenu">';
        echo           '<a href="#" class="dropdown-toggle" data-toggle="dropdown">ユーザー管理</a>';
        echo           '<ul class="dropdown-menu">';
        echo             '<li>' . $this->tag->linkTo(array('users', 'ユーザー設定', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('user_group_mrs', 'ユーザーグループ設定', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('users', 'ログの表示', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('users', 'パスワードの変更', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('users', '承認者の確認', 'target'=>'_blank')) . '</li>';
        echo             '<li>' . $this->tag->linkTo(array('users', '承認対象者の確認', 'target'=>'_blank')) . '</li>';
        echo           '</ul>';
        echo         '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('mitumori_dts', 'データ管理...', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('juchuu_dts', '仕訳作成', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('load_mrs/search', '移入移出', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('load_koumoku_mrs/search', '移入移出項目', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('table_mrs/search', 'テーブル', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('koumoku_mrs/search', 'テーブル項目', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('howto_dts', 'ハウツー', 'target'=>'howto')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('menus/search', 'メニュー', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('menu_group_mrs/search', 'メニューグループ', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('edit_views/edit/'.$this->view->getControllerName().'/'.$this->view->getActionName().'.phtml' , 'このview編集', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('edit_views', 'views一覧', 'target'=>'viewsindex')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('webtools.php', 'WEB開発', 'target'=>'webtools')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('edit_codes/edit/controllers/'.str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($this->view->getControllerName())))).'Controller.php', 'このcontroller編集', 'target'=>'_blank')) . '</li>';
        echo         '<li>' . $this->tag->linkTo(array('edit_codes/edit/models/'.str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower($this->view->getControllerName())))).'.php' , 'このmodel編集', 'target'=>'_blank')) . '</li>';
        echo         '<li class="nav-divider"></li>';
        echo         '<li>' . $this->tag->linkTo(array('//'.$_SERVER['SERVER_NAME'].'/phpMyAdmin/index.php', 'DB操作', false, 'target'=>'myadmin')) . '</li>';
        echo       '</ul>';
        echo     '</li>';
        echo   '</ul>';
    }


    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs" style="padding:30px 0 0 0">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
                $capstyle = '<span class="bg-primary">'; $capstyle_end = '</span>';
            } else {
                echo '<li>';
                $capstyle=''; $capstyle_end='';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $capstyle.$caption.$capstyle_end), '</li>';
        }
        echo '</ul>';
    }
}
