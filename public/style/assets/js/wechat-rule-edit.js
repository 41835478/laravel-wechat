var host = 'http://lf.ttge.com/api/';

var app = new Vue({
  el: 'body',
  data: {
    id:'',
    rule_name: "",
    wechat_id: 1,
    keywords: [],
    replies: [],
    news: []
  },
  created: function(){
    if(rule){
      var tmpData = rule.map(function(item) {
        if( item.message_type = "text"){
          item.content = item.content.body;          
        }
        else if(item.message_type = "news"){
          item.news_url = item.content.news_url;
          item.pic_url = item.content.pic_url;
          item.title = item.content.title;
        }
        return item;
      })      
      this.$data = $.extend({}, this.$data, rule);
    }
  },
  computed: {
    newsToAdd: function() {
      return this.news.filter(function(item) {
        return item.checked
      });
    }
  },
  methods: {
    addKeyword: function() {
      this.keywords.push({
        keyword: "",
        match_type: "2"
      });
    },
    showAddTextDialog: function() {
      $('#dialogText').modal('show');
    },
    delReply: function(index) {
      this.replies.splice(index, 1);
    },
    addText: function() {
      var text = $('#dialogText textarea').val();
      this.replies.push({
        message_type: "text",
        content: text
      });
      $('#dialogText textarea').val('');
      $('#dialogText').modal('hide');
    },
    showaddNewsDialog: function() {
      var self = this;
      $.getJSON('/api/news-lists', {
        wechat_id: '1'
      }, function(data) {
        var tmpData = data.map(function(item) {
          item.checked = false;
          return item;
        });
        self.news = tmpData;
        $('#dialogNews').modal('show');
      });
    },
    addNews: function() {
      var tmpData = this.newsToAdd.map(function(item) {
        item.message_type = "news";
        item.content_id = item.id;
        return item;
      })
      this.replies = this.replies.concat(tmpData);
      $('#dialogNews').modal('hide');
    },
    submitData: function() {
      var self = this;
      var data = {};
      data.rule_id = self.id;
      data.rule_name = self.rule_name;
      data.wechat_id = self.wechat_id;
      data.keywords = self.keywords;
      data.replies = self.replies.map(function(item) {
        var obj = {};
        obj.message_type = item.message_type;
        if (item.message_type == 'news') {
          obj.content_id = item.content_id;
        } else {
          obj.content = item.content;
        }
        return obj;
      });
      $.ajax({
        type: "POST",
        url: '/api/update-rule',
        data: data,
        dataType: 'json',
        success: function(data){
          if(data.status == 200){
            alert('修改成功')
          }
          else{
            alert('修改失败');
          }
        }
      });
    }
  }
});