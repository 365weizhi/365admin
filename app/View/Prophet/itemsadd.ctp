<form method="POST">
<pre>输入商品的url，换行分割</pre>
<textarea id='urls' name='urls' style="width: 100%; height: 200px;">
</textarea>
<br>
<input id='formBtn' type='submit' value="Add Items" />
</form>
<!--
<script>
$(function(){
    $('#formBtn').click(function(){
	var urls = $("#urls").val().trim();
	alert(urls);
    });
    function getUrlArr(){
	var urlArr = [];
	var urls = $("#urls").val().trim();
	if(urls)
	    urlArr = urls.trim().split(/\s+/g);
	return urlArr;
    }

    function arrayToObject(arr){
	var i;
	var obj = {};
	for(i = 0; i < arr.length; i++){
	    obj[i] = arr[i];
	}
	return obj;
    }

    function requestByAjax(url, data){
	$.ajax({
	    url: url,
	    type: "POST",
 	    data: data,
	    dataType: "JSON",
	    success: function(something){
		alert(something);
	    },
	})();
    }
</script>
-->
