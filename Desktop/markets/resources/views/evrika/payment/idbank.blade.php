
<form id="redirect_to_idram" style="display: none" action="https://money.idram.am/payment.aspx" method="POST">
    <input type="hidden" name="EDP_LANGUAGE" value="{{app()->getLocale()}}">
    <input type="hidden" name="EDP_REC_ACCOUNT" value="110000339">
    <input type="hidden" name="EDP_DESCRIPTION" value="Description">
    <input type="hidden" name="EDP_AMOUNT" value="{{$array["Amount"]}}">
    <input type="hidden" name="EDP_BILL_NO" value="{{$array["OrderID"]}}">
    <input type="submit" value="submit">
</form>
<script>document.addEventListener('DOMContentLoaded', function(){ document.getElementById("redirect_to_idram").submit();});</script>
