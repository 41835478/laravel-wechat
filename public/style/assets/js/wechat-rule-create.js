var host = 'http://lf.ttge.com/api/';

var app = new Vue({
  el: 'body',
  data: {
    rule_name: "",
    wechat_id: 1,
    keywords: [],
    replies: [],
    news: []
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
    delKeyword: function(index) {
      this.keywords.splice(index, 1);
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
      data.rule_name = self.rule_name;
      data.wechat_id = "1";
      data.keywords = self.keywords;
      data.replies = self.replies.map(function(item) {
        var obj = {};
        obj.message_type = item.message_type;
        if (item.content_id) {
          obj.content_id = item.content_id;
        } else {
          obj.content = item.content;
        }
        return obj;
      });
      $.ajax({
        type: "POST",
        url: '/api/create-rule',
        data: data,
        dataType: 'json',
        success: function(data){
          if(data.status == 200){
            alert('提交成功')
          }
          else{
            alert('提交失败');
          }
        }
      });
    }
  }
});