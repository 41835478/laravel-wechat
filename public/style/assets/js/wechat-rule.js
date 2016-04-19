var result = [];
$('.tag-input').on('keyup', 'input', function(e){
  if(e.keyCode == 13){
    $this = $(this);
    $parent = $this.closest('.tag-input');
    var val = $.trim($this.val());
    if(val && result.indexOf(val) == -1){
      result.push(val);
      $parent.find('.keywords').append('<span>' + val + '</span>');
      $this.val('');
    }
  }
});
$('.tag-input').on('click', 'span', function(e){
  $this = $(this);
  var val = $.trim($this.text());
  var tmp = [];
  for(var i = 0; i < result.length; i++){
    if(result[i] !== val){
      tmp.push(result[i]);
    }
  }
  result = tmp;
  $this.remove();
});

//  增加 输入框

$('.m-mutiple-text').on('click', '.btn-add', function(){
  var $this = $(this);
  var $parent = $this.closest('.m-mutiple-text');
  var tpl = $('#inputText').html();
  $parent.append(tpl);
  $parent.find('.btn-add').hide();
  $parent.find('.btn-del').show();
})

// 图文消息

$('.media').on('click', function(){
  var $checkbox = $(this).find('input[type=checkbox]');
  var flag = $checkbox.prop('checked');
  $checkbox.prop('checked', !flag);
});