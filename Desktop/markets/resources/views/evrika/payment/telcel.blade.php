<?php
$shop_key = "LEnGy<Hp!s*|n_T!7f{5O]QfTKGod2^gN{O(aBXFchE?ahZPQvSMI6Yq|-z>i9rt[$^HkdWPty?8Oq^ZEb=-i8pxlhdLq7OFZgXBc%IBD>KuYJ[eC{zl3DU1vPuTa9qL";
$shop_id = "sergej-arustamja@mail.ru";
$sum = number_format(1, 2, '.', '');
$desc = "Telcel paymant". $order_id;
$currency = 51;
$cur_locale = 'en';
$locale = 'en';
$valid_days =1;
$order_id = "fgfg456456dfdf";

$signature = md5($shop_key.
$shop_id.
$order_id.
$currency.
$sum.
base64_encode($desc).
$valid_days.
base64_encode($order_id)
);

?>


<form target="_blank" action="https://telcellmoney.am/invoices" method="POST" id="telcell_form">
    <input type="hidden" name="description" value="{{urlencode(base64_encode($desc))}}"/>
    <input type="hidden" name="sum" value="{{$sum}}"/>
    <input type="hidden" name="currency" value="{{$currency}}"/>
    <input type="hidden" name="issuer_id" value="{{urlencode(base64_encode($order_id))}}"/>
    <input type="hidden" name="valid_days" value="{{$valid_days}}"/>
    <input type="hidden" name="bill:issuer" value="{{urlencode($shop_id)}}"/>
    <input type="hidden" name="buyer" value="3283005053463"/>
    <input type="hidden" name="checksum" value="{{$signature}}"/>
    <input type="submit" value="Pay telcell"/>
    <a class="button cancel" href="/">Cancel payment and return back</a>
 </form>
