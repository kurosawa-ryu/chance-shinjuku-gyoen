(function($) {
var mediaupload=function($class){
    var custom_uploader;
    var $this=$class;
    var $add=$this.find('.media');
    var $delete=$this.find('.media-clear');
    var $mediaimg=$this.find('.mediaimg');
    var $value=$this.find('.value');
    $add.on('click',function(e) {
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media({
            title: "ファイルを選択",
            /* ライブラリの一覧は画像のみにする */
            library: {
            type: "image"
            },
            button: {
                text: "決定"
            },
            /* 選択できる画像は 1 つだけにする */
            multiple: false
        });
        custom_uploader.on("select", function() {
            var images = custom_uploader.state().get("selection");
            /* file の中に選択された画像の各種情報が入っている */
            images.each(function(file) {
                /* テキストフォームと表示されたサムネイル画像があればクリア */
                //$mediaimg.empty();
                $value.val("");
                $mediaimg.empty();
                /* テキストフォームに画像の ID を表示 */
                //$text.text(file.attributes.title);
                $value.val(file.id);
                /* プレビュー用に選択されたサムネイル画像を表示 */
                $mediaimg.addClass('select').append('<img src="' + file.attributes.sizes.full.url + '" alt="サムネイル画像" class="img-responsive">');
            });
        });
        custom_uploader.open();
    });
    /* クリアボタンを押した時の処理 */
    $delete.on('click',function() {
        //$text.empty();
        $value.val("");
        $mediaimg.empty().removeClass('select');
    });
}
$(".mediaupload").each(function(){
    var $this=$(this);
    mediaupload($this);
});
$('#add').on('click',function(){
    var add=$('.addto');
    var add_box=$('.addto').length;
    var sibling=$('.add_box').prev('.addto');
    var value=sibling.find('.value');
    var value_val=[];
    var clear=sibling.find('.media-clear');
    var $html;
    $html+='<div class="addto">'+"\n";
    $html+='<div style="margin-bottom:5px;">タイトル:<input type="text" class="value" name="studio_data[studio_content]['+add_box+'][title]" value=""></div>'+"\n";
    $html+='画像:<div class="mediaupload addition'+add_box+'">'+"\n";
    $html+='<input type="hidden" name="studio_data[studio_content]['+add_box+'][img]" class="value" value="">'+"\n";
    $html+='<button type="button" class="media">画像をアップロード</button>'+"\n";
    $html+='<button type="button" class="media-clear">クリア</button>'+"\n";
    $html+='<div class="mediatext" style="display:inline-block;margin-left:10px;"></div>'+"\n";
    $html+='</div>'+"\n";
    $html+='<div style="margin-top:5px;">テキスト:<textarea rows="3" style="width:100%;" class="value" name="studio_data[studio_content]['+add_box+'][text]"></textarea></div>'+"\n";
    $html+='</div>'+"\n";
    value.each(function(){
        var thisval=$(this).val();
        if($.isEmptyObject(thisval)!==true){
            value_val.push($(this).val());
        }
    });
    if($.isEmptyObject(value_val)===true){
        alert('コンテンツを入力してください。');
    }else{
        $($html).insertBefore('.add_box');
        mediaupload($(".addition"+add_box));
        if(add_box==1){
            $('#delete').show();
        }
    }
});
$('#delete').on('click',function(){
    var add_box=$('.addto').length;
    if(add_box>1){
        $(this).parent('.add_box').prev('.addto').remove();
        if(add_box==2){
            $(this).hide();
        }
    }
});
var add_box=$('.addto').length;
if(add_box==1){
    $('#delete').hide();
}
})(jQuery);
