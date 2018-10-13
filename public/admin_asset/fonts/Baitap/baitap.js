function initsophan(sophan)
{
	var str="";
	for(var i=1;i<=sophan;i++)
	{
		str = str+'<div class=" input-group" id="phan'+i+'">\
                <span class="input-group-addon">Số câu phần '+i+'</span>\
                <input id="socauphan'+i+'" type="text" class="form-control" name="socauphan'+i+'">\
              </div>'
	}
	return str;
}

function initkhungcacphan(sophanbaitap)
{
	var strkhung="";
	for(var i=1;i<=sophanbaitap;i++)
	{
		strkhung=strkhung+'	<div class="panel panel-default" id=phan'+i+'>\
            					<div class="panel-heading ">Phần '+i+'</div>\
            					<div class="panel-body padding-l-r-0 " id="bodyphan'+i+'">\
              						<div class="selection-left col-md-6 col-xs-6 col-sm-6" id="phan'+i+'left"></div>\
              						<div class="selection-right col-md-6 col-xs-6 col-sm-6" id="phan'+i+'right"></div>\
            					</div>\
          					</div>';
	}
	return strkhung;
}

function initcau(sophanbaitap,strleft,strright)
{
	
	for(var i =1;i<=sophanbaitap;i++)
	{
		var strleft="";
		var strright="";
		var socaumoiphan = $('#socauphan'+i+'').val();
		for(var j=1;j<=socaumoiphan;j++)
		{
			if(j%2==0)
			{
				strright=strright+'<div id="cau'+j+'-'+i+'">\
              <label class="col-xs-4" style="text-align:right;" for="usr">Câu'+j+':</label>\
              <label class="radio-inline"><input type="radio" value="a" name="cau'+j+""+i+'" id="cau'+j+'a-'+i+'">A</label>\
              <label class="radio-inline"><input type="radio" value="b" name="cau'+j+""+i+'" id="cau'+j+'b-'+i+'">B</label>\
              <label class="radio-inline"><input type="radio" value="c" name="cau'+j+""+i+'" id="cau'+j+'c-'+i+'">C</label>\
              <label class="radio-inline"><input type="radio" value="d" name="cau'+j+""+i+'" id="cau'+j+'d-'+i+'">D</label>\
            </div><div class="clearfix"></div>';
			}
			else{
				strleft=strleft+'<div id="cau'+j+'-'+i+'">\
              <label class="col-xs-4" style="text-align:right;" for="usr">Câu '+j+':</label>\
              <label class="radio-inline"><input type="radio" value="a" name="cau'+j+""+i+'" id="cau'+j+'a-'+i+'">A</label>\
              <label class="radio-inline"><input type="radio" value="b" name="cau'+j+""+i+'" id="cau'+j+'b-'+i+'">B</label>\
              <label class="radio-inline"><input type="radio" value="c" name="cau'+j+""+i+'" id="cau'+j+'c-'+i+'">C</label>\
              <label class="radio-inline"><input type="radio" value="d" name="cau'+j+""+i+'" id="cau'+j+'d-'+i+'">D</label>\
              </div><div class="clearfix"></div>';
			}
		}
		$('#phan'+i+'left').html(strleft);
		$('#phan'+i+'right').html(strright);
	}
}

$(document).ready(function(){

	$('#checktitle').hide();
	$('#checksocau').hide();
	var phanbaitap = $('#phan').val();
	$('#phan').change(function(){
		var sophan = $('#phan').val();
		phanbaitap=sophan;
		$('#socau').html(initsophan(sophan));
	});



	$('#tao').click(function(){
		if($('#tenbaitap').val()=="")
		{
			$('#checktitle').show();
			return false;
		}else{
			$('#checktitle').hide();
		}
		for(var i=1;i<=phanbaitap;i++)
		{
			if(($('#socauphan'+i+'').val()=="")||($('#socauphan'+i+'').val()<=0)){
				$('#checksocau').show();
				return false;
			}else{
				$('#checksocau').hide();
			}
		}
		$('#answer-sheet').html(initkhungcacphan(phanbaitap));
		initcau(phanbaitap);
	})
});