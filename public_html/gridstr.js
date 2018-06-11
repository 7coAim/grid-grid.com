var layout;
var grid_size = 100;
var grid_margin = 3;
var block_params = {
    max_width: 6,
    max_height: 6
};




$(function() {
    layout = $('.layouts_grid ul').gridster({
        widget_margins: [grid_margin, grid_margin],
        widget_base_dimensions: [grid_size, grid_size],
        serialize_params: function($w, wgd) {
            return {
                x: wgd.col,
                y: wgd.row,
                width: wgd.size_x,
                height: wgd.size_y,
                id: $($w).attr('data-id'),
                name: $($w).find('.block_name').html(),
            };
        },
        draggable: {
            stop: function(event, ui){
                var id = this.$helper[0].attributes[0].value;
                var row = this.$helper[0].attributes[1].value;
                var col = this.$helper[0].attributes[2].value;
                console.log(id, row, col);
                var data = {request : $('#request').val()};
                var $ID = document.getElementById( 'name' ).getAttribute( 'foo' )
                var $jsonString =JSON.stringify(gridster.serialize());
                var $demo=document.getElementById( 'demo' ).getAttribute( 'foo' )
                console.log($ID, $demo);
                if($demo==1) {
                    $.ajax( {
                        type : 'POST',
                        url: 'gridstr_db.php',
                        data: { val : $jsonString ,name:$ID},

                        success: function( data) {
                            console.log(data);
                            // $( '#sample-text' ).html( data );
                            // $( '#sample-result' ).html( '<hr/><font color="blue">読み込みOK(IE,FireFox,SafariはOK)</font><hr/>' );
                        },
                        error: function( data ) {
                            $( '#sample-result' ).html( '<font color="red">読み込みNG(ChromeではNG)</font>' );
                        }
                    } );
                }
            }



        },

        min_rows: block_params.max_height
    }).data('gridster');


    $('.layout_block').resizable({
        grid: [grid_size + (grid_margin * 2), grid_size + (grid_margin * 2)],
        animate: false,
        minWidth: grid_size,
        minHeight: grid_size,
        containment: '#layouts_grid ul',
        autoHide: true,
        stop: function(event, ui) {
            var resized = $(this);
            setTimeout(function() {
                resizeBlock(resized);
            }, 300);
        }
    });

    $('.ui-resizable-handle').hover(function() {
        layout.disable();
    }, function() {
        layout.enable();
    });

    function resizeBlock(elmObj) {
        var elmObj = $(elmObj);
        var w = elmObj.width() - grid_size;
        var h = elmObj.height() - grid_size;
        for (var grid_w = 1; w > 0; w -= (grid_size + (grid_margin * 2))) {
            grid_w++;
        }
        for (var grid_h = 1; h > 0; h -= (grid_size + (grid_margin * 2))) {
            grid_h++;
        }
        layout.resize_widget(elmObj, grid_w, grid_h);

        var data = {request : $('#request').val()};
        var $ID = document.getElementById( 'name' ).getAttribute( 'foo' )
        var $jsonString =JSON.stringify(gridster.serialize());
        var $demo=document.getElementById( 'demo' ).getAttribute( 'foo' )
        if($demo==1) {

            $.ajax( {
                type : 'POST',
                url: 'gridstr_db.php',
                data: { val : $jsonString ,name:$ID},

                success: function( data) {
                    // alert(data);
                            // $( '#sample-text' ).html( data );
                            // $( '#sample-result' ).html( '<hr/><font color="blue">読み込みOK(IE,FireFox,SafariはOK)</font><hr/>' );
                },
                error: function( data ) {
                    $( '#sample-result' ).html( '<font color="red">読み込みNG(ChromeではNG)</font>' );
                }
            } );
        }


    }

    var gridster = $(".layouts_grid ul").gridster().data('gridster');

//remove box
    $(".deleteme").live("click",function() {


        $(this).parents().eq(2).addClass("activ");
        var deleteID = $("li.activ").attr("data-id");
        console.log(deleteID);
        gridster.remove_widget($('.activ'));
        $(this).parents().eq(2).removeClass("activ");

        var $i=deleteID;
        var data = {request : $('#request').val()};
        var $ID = document.getElementById( 'name' ).getAttribute( 'foo' )
        var $url= document.getElementById( 'dataurl' ).getAttribute( 'foo' )
        var $link= document.getElementById( 'datalink' ).getAttribute( 'foo' )
        var $jsonString =JSON.stringify(gridster.serialize());
        // var $id = this.$helper[0].attributes[0].value;
        var $demo=document.getElementById( 'demo' ).getAttribute( 'foo' )
        if($demo==1) {
            $.ajax( {
                type : 'POST',
                url: 'gridstr_db.php',
                data: { val : $jsonString ,name:$ID,deleteid:$i,url:$url,link:$link},

                success: function( data) {
                    console.log(data);
                            // $( '#sample-text' ).html( data );
                            // $( '#sample-result' ).html( '<hr/><font color="blue">読み込みOK(IE,FireFox,SafariはOK)</font><hr/>' );
                },
                error: function( data ) {
                    $( '#sample-result' ).html( '<font color="red">読み込みNG(ChromeではNG)</font>' );
                }
            } );
        }
    });

    var i=document.getElementById( 'count' ).getAttribute( 'foo' );　//インクリメント用
    var urlBox = $('#url');
    var picBox = $('#pics');

//タイル追加フォーム：「追加」ボタン
$( "#add-form .add" ).click(function(){
    var url = urlBox.val();
    var pic = picBox.val();
    console.log("STUB::"+url+","+pic);

    //フォームに入力してないときの条件分岐
    if(!url){
        $(".alert").remove();
        $("#linkurl").append('<span class="alert"><font color="#FF0000">　入力してください</font></span>');
    }else if(!pic){
        $(".alert").remove();
        $("#picurl").append('<span class="alert"><font color="#FF0000">　入力してください</font></span>');

    }else{
        $(".alert").remove();
        if(url.indexOf("<")!=-1||url.indexOf(">")!=-1||url.indexOf("\'")!=-1||url.indexOf("\"")!=-1){
            $(".alert").remove();
            $("#picurl").append('<span class="alert"><font color="#FF0000">　無効な文字が含まれています</font></span>');
        }else　if(pic.indexOf("<")!=-1||pic.indexOf(">")!=-1||pic.indexOf("\'")!=-1||pic.indexOf("\"")!=-1){
            $(".alert").remove();
            $("#picurl").append('<span class="alert"><font color="#FF0000">　無効な文字が含まれています</font></span>');
        }else if(!pic.match(/\.(jpg|gif|png|ico|jpeg|svg|bmp)$/i)){
            $(".alert").remove();
            $("#picurl").append('<span class="alert"><font color="#FF0000">　無効なURLです</font></span>');
        }else{

            $(".alert").remove();
            gridster.add_widget('<li class="layout_block" data-id='+i+'><A Href="'+url+'"><Img Src="'+pic+'" width=100% height=100%></a><div class="box"><div class="menu"><div class="deleteme"><a  href="JavaScript:void(0);"><img src="./img/appbar.close.png" alt="削除" width="15" height="15"></a></div></div></div></li>', 1, 1, 1, 1);
            i++;　//ID用インクリメント


            var data = {request : $('#request').val()};

            var $addurl=pic;
            var $addlink=url;
            var $ID = document.getElementById( 'name' ).getAttribute( 'foo' )
            var $url= document.getElementById( 'dataurl' ).getAttribute( 'foo' )
            var $link= document.getElementById( 'datalink' ).getAttribute( 'foo' )
            var $count= document.getElementById( 'count' ).getAttribute( 'foo' )
            var $jsonString =JSON.stringify(gridster.serialize());


            $('.layout_block').resizable({
            grid: [grid_size + (grid_margin * 2), grid_size + (grid_margin * 2)],
            animate: false,
            minWidth: grid_size,
            minHeight: grid_size,
            containment: '#layouts_grid ul',
            autoHide: true,
            stop: function(event, ui) {
                var resized = $(this);
                setTimeout(function() {
                    resizeBlock(resized);
                }, 300);
                }
            });

            $('.ui-resizable-handle').hover(function() {
                layout.disable();
            }, function() {
                layout.enable();
            });


            var $demo=document.getElementById( 'demo' ).getAttribute( 'foo' )
            if($demo==1) {
                $.ajax( {
                    type : 'POST',
                    url: 'gridstr_db.php',
                    data: { val : $jsonString ,name:$ID,add:'add',url:$url,link:$link,addurl:$addurl,addlink:$addlink,count:$count},

                    success: function( data) {
                        console.log(data);
                        // $( '#sample-text' ).html( data );
                        // $( '#sample-result' ).html( '<hr/><font color="blue">読み込みOK(IE,FireFox,SafariはOK)</font><hr/>' );
                    },
                    error: function( data ) {
                        $( '#sample-result' ).html( '<font color="red">読み込みNG(ChromeではNG)</font>' );
                    }
                } );
            }
            urlBox.val("");
            picBox.val("");
        }
    }

});

    var bgpicBox = $('#bgpics');

//オプションフォーム：適用ボタン
    $("#options-form .apply").click(function(){
        var bgpics = bgpicBox.val();
        if(!bgpics){
            $(".alert").remove();
            $("#bgurl").append('<font color="#FF0000" class="alert">　入力してください</font>');
        }else if(!bgpics.match(/\.(jpg|gif|png|ico|jpeg|svg|bmp)$/i)){
            $(".alert").remove();
            $("#bgurl").append('<span class="alert"><font color="#FF0000">　無効なURLです</font></span>');
        }else{
            $(".alert").remove();
            var $ID = document.getElementById( 'name' ).getAttribute( 'foo' )
            var $bg=bgpics;
            var $jsonString =JSON.stringify(gridster.serialize());
            var $demo=document.getElementById( 'demo' ).getAttribute( 'foo' );
            $("body").css("background-image",'url('+$bg+')');//背景変更
            if($demo==1) {
            $.ajax( {
                type : 'POST',
                url: 'gridstr_db.php',
                data: { val : $jsonString ,name:$ID,bg:$bg},

                success: function( data) {
                    console.log(data);
                    // $( '#sample-text' ).html( data );
                    // $( '#sample-result' ).html( '<hr/><font color="blue">読み込みOK(IE,FireFox,SafariはOK)</font><hr/>' );
                },
                error: function( data ) {
                    $( '#sample-result' ).html( '<font color="red">読み込みNG(ChromeではNG)</font>' );
                }
            } );
            }
            bgpicBox.val("");
        }
    });

//閉じるボタン（全てのモーダルフォームで共通）
    $(".md-close").click(function(){
        $(".alert").remove();
    });


//mouseover/outイベント。Xを表示
    $("li").live("mouseover",function(){
        $(".deleteme",this).css("opacity","0.5");
    }).live("mouseout",function(){
        $(".deleteme",this).css("opacity","0.0");
    });

//ドラッグ中リンクに飛ばない
    //ドラッグ開始時リンク無効
    var olddragstart = gridster.on_start_drag;
    gridster.on_start_drag = function(e){
            this.$player.find('a').on('click', function(e){
              e.preventDefault();
            });
        var ret = olddragstart.apply(this, arguments);
        return ret;
    };

    //クリック時にリンク有効化
    $("li.layout_block a").live("click",function(){
        $(this).off('click');
        console.log("click event off");
    });


});
