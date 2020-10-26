<?php
function fnc_make_html_karte_list($a_user_ai, $a_page_number)
{
    $html = '';
    //41_order_tblデータ
    $ary_fld = array('order_ai', 'order_counsel_datetime', 'order_visit_datetime'); //SELECT取得値
    $where = 'order_user_ai=:order_user_ai AND order_flg_karte=true';
    $asc_bind['order_user_ai'] = array('val' => $a_user_ai, 'type' => PDO_INT); //指定user_ai
    $orderby = 'ORDER BY order_visit_datetime DESC,order_counsel_datetime DESC LIMIT ' . (5 * ($a_page_number - 1)) . ',5';
    $ary_fetchall = fnc_pdo_select('41_order_tbl', $ary_fld, $where, $orderby, $asc_bind);
    foreach ($ary_fetchall as $idx => $asc_order) { //1件該当が前提
        $order_ai = $asc_order['order_ai'];
        $order_counsel_datetime = $asc_order['order_counsel_datetime'];
        $order_visit_datetime = $asc_order['order_visit_datetime'];
        //
        $html .= <<< EOM
        <div class="karte_list_flame">
            <img src="photo/order/p{$order_ai}_ptp_hair_after-1.jpg" alt="カルテ画像" style="height:130px; width:100px;">
            <div class="karte_txt1">
                <div class="karte_counsel_karte_txt">
                    <div class="karte_txt">
                        <p>●カウンセリング</p>
                        <span>{$order_counsel_datetime}</span>
                    </div>
                    <div class="karte_txt">
                        <p>●カルテ</p>
                        <span>{$order_visit_datetime}</span>
                    </div>
                </div>
                <a class="btn" href="user_karte.php?order_ai=$order_ai">詳細をみる</a>
            </div>
        </div>
        EOM;
    }
    return $html;
}
