<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>菜品添加</title>
    <style>
        .img-container{
            width: 230px;
            height: 150px;
            background:#F2F2F2;
            margin-bottom:35px;
			margin-left:40px;
            overflow: hidden;
            border: 1px solid #000;
			background-color:#FFC;
			background-image:url(images/S81122-11210803.jpg);
			background-size:100%;
			border-radius:5px;
			
        }
        .img-container>img{
            width:230px;
            height: 150px;
			
        }
        .img{
            width: 230px;
            height: 150px;
			background-image:url(images/PG%358%601_RR8N9LX4S95Z5B.png);
        }
    </style>
</head><center>
<body style="background-image:url(images/img.jpg); background-size:100%;opacity:0.8">
<table><tr><th height=100></th></tr><tr><th width=300px></th><th>
    <form method="POST" action="cai.php" enctype="multipart/form-data" class="card-form">
    <div>
            <div class="img-container"></div>
            <font color="#333333" size="+0" ><strong>上传菜样</strong></font>:<input class="img-btn" type="file" id="drivingLicence" name="drivingLicence" style="height:30px; width:180px; " >
        </div>
       <input type="submit"      value="提    交"  style="width:320px; height:40px; background-color:#F00; background-image:url(images/S81122-14430781.jpg); background-size:100%; border-radius:5px; font-size:16px; font-weight:800; font:Tahoma, Geneva, sans-serif; color:#FFF ">        
    </form></th></tr></table>
    <script>
        
//上传图片并预览
        function previewImg(fileInput,imgDiv){
            if(window.FileReader){//支持FileReader的时候
                var reader=new FileReader();
                reader.readAsDataURL(fileInput.files[0]);
                reader.onload=function(evt){
                    imgDiv.innerHTML="\<img src="+evt.target.result+"\>";
                }
            }else{//兼容ie9-
                imgDiv.innerHTML='<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + fileInput.value + '\)\';"></div>';
            }
        }
        function selectImg(fileInputs,imgDivs){
            var checkImg=new RegExp("(.jpg$)|(.png$)|(.bmp$)|(.jpeg$)","i");
            var i=0;
            for(;i<fileInputs.length&&i<imgDivs.length;i++){
                (function(i){//立即执行函数；保存i
                    fileInputs[i].onchange=function(){
                        if(checkImg.test(fileInputs[i].value)){
                            previewImg(this,imgDivs[i]);
                        }else{
                            alert("只支持上传.jpg .png .bmp .jpeg;你的选择有误");
                        }
                    };
                })(i);
            }

        }
        /* 为IE6 IE7 IE8增加document.getElementsByClassName函数 */
        /MSIE\s*(\d+)/i.test(navigator.userAgent);
        var isIE=parseInt(RegExp.$1?RegExp.$1:0);
        if(isIE>0&&isIE<9){
            document.getElementsByClassName=function(cls){
                var els=this.getElementsByTagName('*');
                var ell=els.length;
                var elements=[];
                for(var n=0;n<ell;n++){
                    var oCls=els[n].className||'';
                    if(oCls.indexOf(cls)<0)        continue;
                    oCls=oCls.split(/\s+/);
                    var oCll=oCls.length;
                    for(var j=0;j<oCll;j++){
                        if(cls==oCls[j]){
                            elements.push(els[n]);
                            break;
                        }
                    }
                }
                return elements;
            }
        }
        var fileInputs=document.getElementsByClassName("img-btn");//文件选择按钮
        var imgDivs=document.getElementsByClassName("img-container");//图片容器
        selectImg(fileInputs,imgDivs);
    </script>
</body>
</html>
