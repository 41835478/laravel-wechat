var ue = UE.getEditor('container', {
  toolbars:[['fullscreen', 'source', '|', 'undo', 'redo', '|',
    'bold', 'italic', 'underline']]
});
$('.add-new-rule').click(function(){
  $('#ruleModal').modal('show');
});
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

$('#ruleSave').click(function(){
  var ruleName = $('#ruleModal [name=ruleName]').val();
  var keyName = result;
  var text = $('#ruleModal textarea.text').val();
  var keywords_TPL = $('#ruleModal .keywords span');
  var keywords = [];
  keywords_TPL.each(function(){
    keywords.push($(this).text());
  });
  var reply_all = $('#ruleModal').find('[name=reply_all]').prop('checked');
  var richText = ue.getContent();
  var data = {
    name: ruleName,
    keywords: keywords,
    text: text,
    reply_all: reply_all,
    richText: richText
  }
  console.log(data);
});

$('.dialog-rule-edit').on('show.bs.modal', function (event) {
  var modal = $(this);
  var button = $(event.relatedTarget) 
  var data = button.data('rule');
  var name = data && data.name || '';
  var keywords = data && data.keywords || [];
  var text = data && data.text || '';
  var reply_all = data && data.reply_all || false;
  var richText = data && data.richText || '';
  var keywords_TPL = '';
  for(var i = 0; i < keywords.length; i++){
    keywords_TPL += '<span>' + keywords[i] + '</span>';
  }       
  modal.find('[name=ruleName]').val(name);
  modal.find('.keywords').html(keywords_TPL);
  modal.find('textarea.text').val(text);   
  modal.find('[name=reply_all]').prop('checked', reply_all);   
  ue.setContent(richText); 
});