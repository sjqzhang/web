/**
 * Created by wenhua on 14-7-25.
 */

function loadPage(href) {

    /*
    $("#page_div").load(href, function (response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            $("#page_div").html(msg + xhr.status + " " + xhr.statusText);
        }
        //$("#page_div").html(response);
        //alert(response)
        //return "aaa";
        //console.log(response)
    });
  */
  //alert(href)

   $.get(href,function(data){
      if($('.login-container',$(data)).length>0){
        window.location.href='http://'+window.location.host+'/index.php/home/login';
        return;
      }
      $("#page_div").html(data);
   });

}

function test(ret) {
    alert(ret);
}
$(function () {
    $(".sidebar li a").click(function (e) {
        var href = $(this).attr("href");
        if (href == "#") {

        } else {
            loadPage(href)
            e.preventDefault();
        }

    });

});
$.fn.extend({
    // 替换class
    replaceClass: function (replaceClass, stayClass) {
        var newClass = replaceClass;
        if (stayClass) {
            newClass += stayClass;
        }
        this.attr('class', newClass);
        return this;
    }
});

$.extend({
    // 切换显示
    toggleShow: function (c1, c2, d) {

        if (d) {
            $(c1).show();
            $(c2).hide();
        }
        else {
            $(c1).hide();
            $(c2).show();
        }
    },

    popMessage: function (type, message) {
        if ($('#msg-pop').length == 0) {
            $('<div id="msg-pop"><span id="msg-pop-body"></span></div>').appendTo('body');
        }
        $('#msg-pop-body').replaceClass('msg-pop-' + type).html(message);
        $('#msg-pop').show().delay(2000).fadeOut(500);
    }
});
$(function () {
    $("#info").click(function (e) {
        $('.modal-title').text('个人信息');
        $('#myModal').modal('show');
    });
});

/*****************************************************************
 jQuery Validate扩展验证方法  (linjq)
 *****************************************************************/
$(function(){
    // 判断整数value是否等于0
    jQuery.validator.addMethod("isIntEqZero", function(value, element) {
        value=parseInt(value);
        return this.optional(element) || value==0;
    }, "整数必须为0");

    // 判断整数value是否大于0
    jQuery.validator.addMethod("isIntGtZero", function(value, element) {
        value=parseInt(value);
        return this.optional(element) || value>0;
    }, "整数必须大于0");

    // 判断整数value是否大于或等于0
    jQuery.validator.addMethod("isIntGteZero", function(value, element) {
        value=parseInt(value);
        return this.optional(element) || value>=0;
    }, "整数必须大于或等于0");

    // 判断整数value是否不等于0
    jQuery.validator.addMethod("isIntNEqZero", function(value, element) {
        value=parseInt(value);
        return this.optional(element) || value!=0;
    }, "整数必须不等于0");

    // 判断整数value是否小于0
    jQuery.validator.addMethod("isIntLtZero", function(value, element) {
        value=parseInt(value);
        return this.optional(element) || value<0;
    }, "整数必须小于0");

    // 判断整数value是否小于或等于0
    jQuery.validator.addMethod("isIntLteZero", function(value, element) {
        value=parseInt(value);
        return this.optional(element) || value<=0;
    }, "整数必须小于或等于0");

    // 判断浮点数value是否等于0
    jQuery.validator.addMethod("isFloatEqZero", function(value, element) {
        value=parseFloat(value);
        return this.optional(element) || value==0;
    }, "浮点数必须为0");

    // 判断浮点数value是否大于0
    jQuery.validator.addMethod("isFloatGtZero", function(value, element) {
        value=parseFloat(value);
        return this.optional(element) || value>0;
    }, "浮点数必须大于0");

    // 判断浮点数value是否大于或等于0
    jQuery.validator.addMethod("isFloatGteZero", function(value, element) {
        value=parseFloat(value);
        return this.optional(element) || value>=0;
    }, "浮点数必须大于或等于0");

    // 判断浮点数value是否不等于0
    jQuery.validator.addMethod("isFloatNEqZero", function(value, element) {
        value=parseFloat(value);
        return this.optional(element) || value!=0;
    }, "浮点数必须不等于0");

    // 判断浮点数value是否小于0
    jQuery.validator.addMethod("isFloatLtZero", function(value, element) {
        value=parseFloat(value);
        return this.optional(element) || value<0;
    }, "浮点数必须小于0");

    // 判断浮点数value是否小于或等于0
    jQuery.validator.addMethod("isFloatLteZero", function(value, element) {
        value=parseFloat(value);
        return this.optional(element) || value<=0;
    }, "浮点数必须小于或等于0");

    // 判断浮点型
    jQuery.validator.addMethod("isFloat", function(value, element) {
        return this.optional(element) || /^[-\+]?\d+(\.\d+)?$/.test(value);
    }, "只能包含数字、小数点等字符");

    // 匹配integer
    jQuery.validator.addMethod("isInteger", function(value, element) {
        return this.optional(element) || (/^[-\+]?\d+$/.test(value) && parseInt(value)>=0);
    }, "匹配integer");

    // 判断数值类型，包括整数和浮点数
    jQuery.validator.addMethod("isNumber", function(value, element) {
        return this.optional(element) || /^[-\+]?\d+$/.test(value) || /^[-\+]?\d+(\.\d+)?$/.test(value);
    }, "匹配数值类型，包括整数和浮点数");

    // 只能输入[0-9]数字
    jQuery.validator.addMethod("isDigits", function(value, element) {
        return this.optional(element) || /^\d+$/.test(value);
    }, "只能输入0-9数字");

    // 判断中文字符
    jQuery.validator.addMethod("isChinese", function(value, element) {
        return this.optional(element) || /^[\u0391-\uFFE5]+$/.test(value);
    }, "只能包含中文字符。");

    // 判断英文字符
    jQuery.validator.addMethod("isEnglish", function(value, element) {
        return this.optional(element) || /^[A-Za-z]+$/.test(value);
    }, "只能包含英文字符。");

    // 手机号码验证
    jQuery.validator.addMethod("isMobile", function(value, element) {
        var length = value.length;
        return this.optional(element) || (length == 11 && /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/.test(value));
    }, "请正确填写您的手机号码。");

    // 电话号码验证
    jQuery.validator.addMethod("isPhone", function(value, element) {
        var tel = /^(\d{3,4}-?)?\d{7,9}$/g;
        return this.optional(element) || (tel.test(value));
    }, "请正确填写您的电话号码。");

    // 联系电话(手机/电话皆可)验证
    jQuery.validator.addMethod("isTel", function(value,element) {
        var length = value.length;
        var mobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        var tel = /^(\d{3,4}-?)?\d{7,9}$/g;
        return this.optional(element) || tel.test(value) || (length==11 && mobile.test(value));
    }, "请正确填写您的联系方式");

    // 匹配qq
    jQuery.validator.addMethod("isQq", function(value, element) {
        return this.optional(element) || /^[1-9]\d{4,12}$/;
    }, "匹配QQ");

    // 邮政编码验证
    jQuery.validator.addMethod("isZipCode", function(value, element) {
        var zip = /^[0-9]{6}$/;
        return this.optional(element) || (zip.test(value));
    }, "请正确填写您的邮政编码。");

    // 匹配密码，以字母开头，长度在6-12之间，只能包含字符、数字和下划线。
    jQuery.validator.addMethod("isPwd", function(value, element) {
        return this.optional(element) || /^[a-zA-Z]\\w{6,12}$/.test(value);
    }, "以字母开头，长度在6-12之间，只能包含字符、数字和下划线。");

    // 身份证号码验证
    jQuery.validator.addMethod("isIdCardNo", function(value, element) {
        //var idCard = /^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/;
        return this.optional(element) || isIdCardNo(value);
    }, "请输入正确的身份证号码。");

    // IP地址验证
    jQuery.validator.addMethod("ip", function(value, element) {
        return this.optional(element) || /^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/.test(value);
    }, "请填写正确的IP地址。");

    // 字符验证，只能包含中文、英文、数字、下划线等字符。
    jQuery.validator.addMethod("stringCheck", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\u4e00-\u9fa5-_]+$/.test(value);
    }, "只能包含中文、英文、数字、下划线等字符");

    // 匹配english
    jQuery.validator.addMethod("isEnglish", function(value, element) {
        return this.optional(element) || /^[A-Za-z]+$/.test(value);
    }, "匹配english");

    // 匹配汉字
    jQuery.validator.addMethod("isChinese", function(value, element) {
        return this.optional(element) || /^[\u4e00-\u9fa5]+$/.test(value);
    }, "匹配汉字");

    // 匹配中文(包括汉字和字符)
    jQuery.validator.addMethod("isChineseChar", function(value, element) {
        return this.optional(element) || /^[\u0391-\uFFE5]+$/.test(value);
    }, "匹配中文(包括汉字和字符) ");

    // 判断是否为合法字符(a-zA-Z0-9-_)
    jQuery.validator.addMethod("isRightfulString", function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9_-]+$/.test(value);
    }, "判断是否为合法字符(a-zA-Z0-9-_)");

    // 判断是否包含中英文特殊字符，除英文"-_"字符外
    jQuery.validator.addMethod("isContainsSpecialChar", function(value, element) {
        var reg = RegExp(/[(\ )(\`)(\~)(\!)(\@)(\#)(\$)(\%)(\^)(\&)(\*)(\()(\))(\+)(\=)(\|)(\{)(\})(\')(\:)(\;)(\')(',)(\[)(\])(\.)(\<)(\>)(\/)(\?)(\~)(\！)(\@)(\#)(\￥)(\%)(\…)(\&)(\*)(\（)(\）)(\—)(\+)(\|)(\{)(\})(\【)(\】)(\‘)(\；)(\：)(\”)(\“)(\’)(\。)(\，)(\、)(\？)]+/);
        return this.optional(element) || !reg.test(value);
    }, "含有中英文特殊字符");


    //身份证号码的验证规则
    function isIdCardNo(num){
        //if (isNaN(num)) {alert("输入的不是数字！"); return false;}
        var len = num.length, re;
        if (len == 15)
            re = new RegExp(/^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{2})(\w)$/);
        else if (len == 18)
            re = new RegExp(/^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\w)$/);
        else {
            //alert("输入的数字位数不对。");
            return false;
        }
        var a = num.match(re);
        if (a != null)
        {
            if (len==15)
            {
                var D = new Date("19"+a[3]+"/"+a[4]+"/"+a[5]);
                var B = D.getYear()==a[3]&&(D.getMonth()+1)==a[4]&&D.getDate()==a[5];
            }
            else
            {
                var D = new Date(a[3]+"/"+a[4]+"/"+a[5]);
                var B = D.getFullYear()==a[3]&&(D.getMonth()+1)==a[4]&&D.getDate()==a[5];
            }
            if (!B) {
                //alert("输入的身份证号 "+ a[0] +" 里出生日期不对。");
                return false;
            }
        }
        if(!re.test(num)){
            //alert("身份证最后一位只能是数字和字母。");
            return false;
        }
        return true;
    }
$('#sidebar-toggle').on('click', function() {
    $('#sidebar').css({
        'overflow': 'visible',
        'transform': 'translateX(0)'
    });
    $(document).on('click.st', function() {
        $('#sidebar').css({
            'transform': 'translateX(-100%)'
        });
        $(document).off('click.st');
    });
    return false;
});


});

$.fn.bindselectSearch=function(){
    var that  = $(this);
    that.chosen({allow_single_deselect:true}); 
    $(window).off('resize.chosen').on('resize.chosen', function() {
        that.each(function() {
             var $this = $(this);
             $this.next().css({'width': $this.parent().width()});
        })
    }).trigger('resize.chosen');

}



//添加左右选列扩展
$.fn.bindListSelect = function(data){


    if(undefined == data.setName){
        data.setName = "mselect"
    }
    if(undefined == data.selectd){
        data.selectd = []
    }
    if(undefined == data.slist){
        data.slist = []
    }

    
    var html = (function(){
/*
<table class="lrselect" width="100%" cellpadding="0" align="center" class="listshow" border="1" cellspacing="0">
    <tr>
        <td colspan=3><label>搜索</label><input type='text' class='search' /></td>
    </tr>     
    <tr> 
      <td class="black" width="45%" align="center" > 
          <select class="left mselect" id="left" multiple="multiple"  > 
                  
          </select> 
      </td> 
      <td align="center"width="10%"> 
          <input type="button"  class="leftbnt"  value="<<删除"/> 
          <br/> 
          <br/> 
          <input type="button" class="rightbnt"  value="添加>>"/> 
      </td> 
              
      <td class="black" width="45%" align="center"> 
            <select class="right mselect" aria-required="true"  multiple="multiple">
           </select>  
       </td> 
   </tr> 
   <input type=hidden name="{rname}" />
</table>
*/
    }).heredoc().replace("{rname}",data.setName);
    var $this = $(this);
    $this.empty();
    $this.append($(html));
    $this.find(".mselect").attr("style","width: 160px;height: 250px");
    $this.undelegate(".rightbnt","click");
    $this.undelegate(".leftbnt","click");
    var d = [];
    for (var i = data.slist.length - 1; i >= 0; i--) {
        var item = data.slist[i];
        var c = $("<option>").attr('value',item.value).html(item.name);
        if(data.selectd.indexOf(item.value) < 0){
            if(d.indexOf(item.value) < 0){
                $this.find(".left").append(c);
            }
        }else{
            $this.find(".right").append(c);
        }
        d.push(item.value);
    };
   
    
    var _cvalue=function(){
        var mselect = $this.find(".right option")
        var res=[];
        for (var i = mselect.length - 1; i >= 0; i--) {
          var item =  mselect[i];
          res.push(item.value);
        };
        $this.find("input[type=hidden]").val( res.join(",") );
    }

    $this.delegate("input.search","keypress blur keyup keydown focus",function(){
        var content = $(this).val();
        if(content == "" || content == undefined){
            $this.find(".left option").show();
            return;
        }
        $this.find(".left option").each(function(){
            var th = $(this);
            var otext = th.text();
            if(otext.indexOf(content) != -1){
                th.show();
            }else{
                th.hide();
            }

        });
    });

    $this.delegate(".rightbnt","click",function(){
       var content =  $this.find(".left option:selected").clone();
       $this.find(".left option:selected").remove();
       $this.find(".right").append(content);
       _cvalue();
    });
    $this.delegate(".leftbnt","click",function(){
        var content =  $this.find(".right option:selected").clone();
        $this.find(".right option:selected").remove();
        $this.find(".left").append(content);
        _cvalue();
    });
    _cvalue();
}


String.prototype.trim=function() {

    return this.replace(/(^\s*)|(\s*$)/g,'');
}
