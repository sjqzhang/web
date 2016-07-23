<div class="main-content" id="page_div">
    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="alert alert-block alert-success">
                        <h1>欢迎使用数据平台！</h1>
                    </div>



                    <div id="browser_tip" style="color:red;"> </div>

                            <script>


                            var userAgent = navigator.userAgent.toLowerCase();
                             jQuery.browser = {
                             version: (userAgent.match( /.+(?:rv|it|ra|ie|me)[\/: ]([\d.]+)/ ) || [])[1],
                             safari: /webkit/.test( userAgent ),
                             opera: /opera/.test( userAgent ),
                             chrome: /chrome/.test( userAgent ),
                             msie: /msie/.test( userAgent ) && !/opera/.test( userAgent ),
                             mozilla: /mozilla/.test( userAgent ) && !/(compatible|webkit)/.test( userAgent )
                             };


                            $(document).ready(function(){



                                function check_browser() {


                                  var tipid='#browser_tip';
                                    if( $.browser.msie ) {


                                        $(tipid).html('请使用webkit或chrome内核的浏览器浏览,否则可能出现不正常的现免!!!');




                                    } else {

                                        var isupdate=false;

                                        try {

                                        if($.browser.mozilla&& parseFloat($.browser.version)<29){

                                            isupdate=true;

                                        }
                                        if($.browser.chrome&& parseFloat($.browser.version)<35){

                                            isupdate=true;

                                        }
                                        }catch(e) {


                                        }


                                        if(isupdate) {


                                            $(tipid).html('浏览器版本过低,请升级你的浏览器版本!!!');

                                        }



                                    }


                                }

                                check_browser();


                            });


                            </script>




                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.page-content-area -->
    </div>
    <!-- /.page-content -->
</div>
<!-- /.main-content -->
