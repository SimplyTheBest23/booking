(function($){$(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

var feeds = [];
var num = 0;

$.ajax({
    url: baseUrl+'feeds/getlist',
    type: 'POST',
    data: 'hotel_id='+$('#hotel_id').val(),
    success: function(rdata){
        feeds = JSON.parse(rdata);
    }
});

function saveFeed(){
    var feed = feeds[num];
    feed.status =2;
    $.ajax({
        url: baseUrl+'feeds/save',
        type: 'POST',
        data: feed,
        success: function(rdata){
            console.log(rdata);
        }
    });
}

function setRead(){
    var n=num+2;
    $('.feeds-edit>aside:nth-child('+n+') div:nth-child(5)').text('Прочитаний');
    $('.feeds-edit>aside:nth-child('+n+') button').text('Переглянути');
    $('.feeds-edit>aside:nth-child('+n+') button').removeClass('btn-danger');
    $('.feeds-edit>aside:nth-child('+n+') button').addClass('btn-default');
}

$('.feeds-edit>aside>button').each(function(){
    $(this).click(function(){
        num = parseInt($(this).next().val());
        var n=num+2;
        saveFeed();
        $('#feed_name').text(feeds[num].name+' '+feeds[num].phone);
        var comment = '';
        if (feeds[num].reight>0){
            comment += '<span class="plus"></span>';
        }
        if (feeds[num].reight<0){
            comment += '<span class="minus"></span>';
        }
        if (feeds[num].reight==0){
            comment += '<span class="re"></span>';
        }
        comment += feeds[num].comment;
        $('#feed_comment').html(comment);
        setRead();
    });
});

$('#next_feed').click(function(){
    if ((num+1)<feeds.length){
        num++;
        $('#feed_name').text(feeds[num].name+' '+feeds[num].phone);
        $('#feed_comment').text(feeds[num].comment);
        saveFeed();
        setRead();
    }
    return false;
});
/*
$('.feeds-edit>aside:nth-child('+(3+1)+') div:nth-child(5)').text('Прочитаний');
$('.feeds-edit>aside:nth-child('+(3+1)+') button').text('Переглянути');
$('.feeds-edit>aside:nth-child('+(3+1)+') button').removeClass('btn-danger');
$('.feeds-edit>aside:nth-child('+(3+1)+') button').addClass('btn-default');*/

})})(jQuery)
