$(function(){

    var cartModal = $('#cartModal');

    $('div.shopingwrapper a').click(function(e){
        e.preventDefault();            

        var items = new Array;
        $.ajax({
            url: $(this).attr('href'),
            success: function(data){
                if(data.totalQty == undefined || data.totalQty == 0){
                    $('#cart .modal-content').html('<a class="list-group-item">Nemate predmeta u korpi<span class="pull-right close">&times;</span></a>');
                } else {
                    var close = '<div class="modal-header">Korpa<span class="pull-right close">&times;</span></div>';
                    var total = '<div class="modal-footer">' +
                                '<p class="qty">Ukupno predmeta: <span>' + data.totalQty + '</span></p>' +
                                '<p class="prc">Ukupna cena: <span>' + data.totalPrice + '</span></p>' +
                                '</div>';
                    var btn = '<a href="/andor/public/checkout" class="btn btn-default checkout">NARUCI</a>';
                    $.each(data.items, function(k, v){
                        items += '<li class="list-group-item '+ k +'"><span class="badge pull-left">Kol: <span id="smQty-'+ k +'">' + v.qty + '</span></span>' +
                                '<a id='+ k +' href="/andor/public/reduce-one/' + k + '" class="badge reduce pull-left btn">&minus;</a><a id='+ k +' href="/andor/public/add-to-cart/'+ k +'" class="badge add pull-left btn">&plus;</a>' + 
                                v.item.name + 
                                '<a id='+ k +' href="/andor/public/reduce-all/' + k + '" class="remove pull-right">&nbsp;&nbsp;<strong> &times;</strong></a>' +
                                '<span class="label label-success pull-right">' + v.price + '</span>' +
                                '</li>';
                    })
                
                    $('#cart .modal-content').html(close + items + total + btn);
                }

                if($('#cart').css('display', 'block')){
                    $('.close').click(function(){
                        $('#cart').hide();
                    })
                }

                $('a.remove').click(function(e){
                    e.preventDefault();

                    var id = $(this).attr('id');

                    $.get($(this).attr('href'), function(data){
                        $('#shopcircle').html(data.totalQty);
                        $('#cart p.qty span').html(data.totalQty);
                        $('#cart p.prc span').html(data.totalPrice);
                        if(! data.items[parseInt(id)]) {
                            $('li.'+ id).remove();
                        }
                        
                        if(data.totalQty == 0){
                            $('#shopcircle').hide();
                            $('#cart .modal-content').html('<a class="list-group-item">Nemate predmeta u korpi<span class="pull-right close">&times;</span></a>');
                            $('span.close').click(function(){
                                $('#cart').toggle();
                            })
                        } 
                    })
                })

                $('a.reduce').click(function(e){
                    e.preventDefault();
                    var id = $(this).attr('id');

                    $.get($(this).attr('href'), function(data){
                        $('#shopcircle').html(data.totalQty);
                        $('#cart p.qty span').html(data.totalQty);
                        $('#cart p.prc span').html(data.totalPrice);
                        if(! data.items[parseInt(id)]) {
                            $('li.'+ id).remove();
                        } else {
                            $('#smQty-'+ id).html(data.items[parseInt(id)]['qty']);
                        }
                        if(data.totalQty == 0){
                            $(this).parent('li').remove();
                            $('#shopcircle').hide();
                            $('#cart .modal-content').html('<a class="list-group-item">Nemate predmeta u korpi<span class="pull-right close">&times;</span></a>');
                            $('span.close').click(function(){
                                $('#cart').toggle();
                            })
                        } 
                    })
                })

                $('a.add').click(function(e){
                    e.preventDefault();
                    var id = $(this).attr('id');
                    $('#shopcircle').show();
                    $.get($(this).attr('href'), function(data){
                        $('#shopcircle').html(data.totalQty);
                        $('#cart p.qty span').html(data.totalQty);
                        $('#cart p.prc span').html(data.totalPrice + ' din');
                        $('#smQty-'+ id).html(data.items[parseInt(id)]['qty']);
                    });
                });

                $('a.checkout').click(function(e){
                	e.preventDefault();
                	$('#cart').fadeOut();

                	$.get($(this).attr('href'), function(data){
                		$('#checkout').fadeIn();
                		$('#checkout .modal-content').html($('#chck').html());
                        $('span.close').click(function(){
                            $('#checkout').fadeOut();
                        })
                	})
                });
            }
        });         
    })

    $('a.myShoppingCart').click(function(e){
        e.preventDefault();
        $('#shopcircle').show();
        $.get($(this).attr('href'), function(data){
            $('#shopcircle').html(data.totalQty);
        });
    });
})